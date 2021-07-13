#! /bin/bash
#
# Generates a sharding cluster of REDIS_CLUSTER_NODES (default: 3) nodes.
# Using REDIS_CLUSTER_PASS (default: random string) and REDIS_CLUSTER_MASTER_PASS (same as REDIS_CLUSTER_PASS)
# listening on REDIS_CLUSTER_PORT_BASE and subsequent ports...
#
# References:
# - https://github.com/owncloud/core/pull/38917#issuecomment-873907609
# - https://mohewedy.medium.com/redis-cluster-configurations-by-example-5480a178e884
# - https://www.youtube.com/watch?v=GEg7s3i6Jak
# - https://github.com/marcel-dempers/docker-development-youtube-series/tree/master/storage/redis/clustering
#
# Limitations:
# - No Highavailability.
# - The cluster becomes inaccessible when the master node dies.
# - No persistence
# - nuber of nodes is hard configured to 3.

test -z "$REDIS_CLUSTER_PASS"        && REDIS_CLUSTER_PASS="$(tr -dc 'a-z0-9' < /dev/urandom | head -c 32)"
test -z "$REDIS_CLUSTER_MASTER_PASS" && REDIS_CLUSTER_MASTER_PASS="$REDIS_CLUSTER_PASS"
test -z "$REDIS_CLUSTER_PORT_BASE"   && REDIS_CLUSTER_PORT_BASE=7000


source lib/make_machine.sh -u redis-cl-$(date +%Y%m%d) -p screen,redis-server "$@"

INIT_SCRIPT << EOF
set -x
echo never > /sys/kernel/mm/transparent_hugepage/enabled
sysctl vm.overcommit_memory=1
for i in 0 1 2; do
 p=\$(($REDIS_CLUSTER_PORT_BASE + i))
 mkdir -p node_\$p
 cat << EOCONF > node_\$p/redis.conf
 port \$p
 cluster-enabled yes
 cluster-config-file cluster.conf
 cluster-node-timeout 5000
 appendonly yes
 requirepass $REDIS_CLUSTER_PASS
 masterauth  $REDIS_CLUSTER_MASTER_PASS
EOCONF
 cd node_\$p
   redis-server redis.conf &
   sleep 3
 cd ..
done
 sleep 3
 export REDISCLI_AUTH=$REDIS_CLUSTER_PASS
 echo yes | redis-cli --cluster create "127.0.0.1:$REDIS_CLUSTER_PORT_BASE" "127.0.0.1:$((REDIS_CLUSTER_PORT_BASE+1))" "127.0.0.1:$((REDIS_CLUSTER_PORT_BASE+2))"
 sleep 5
 redis-cli -c -p $REDIS_CLUSTER_PORT_BASE set y 100
 redis-cli -c -p $REDIS_CLUSTER_PORT_BASE set z 200
 redis-cli -c -p $REDIS_CLUSTER_PORT_BASE get y
 redis-cli -c -p $REDIS_CLUSTER_PORT_BASE get z
 cat <<EOM
 # The 3 nodes redis cluster is ready at $IPADDR:$REDIS_CLUSTER_PORT_BASE
 # Add this to your owncloud/config/redis_cl.php to use the cluster:
\\\$CONFIG = array (
 'redis.cluster' => [
	'seeds' => [ // provide some/all of the cluster servers to bootstrap discovery, port required
	  '$IPADDR:$REDIS_CLUSTER_PORT_BASE',
	  '$IPADDR:$((REDIS_CLUSTER_PORT_BASE+1))'
	  '$IPADDR:$((REDIS_CLUSTER_PORT_BASE+2))'
	],
	'timeout' => 0.0,
	'read_timeout' => 0.0,
	'failover_mode' => \\RedisCluster::FAILOVER_DISTRIBUTE,
	'password' => '$REDIS_CLUSTER_PASS',
  ]
);
EOM
EOF
