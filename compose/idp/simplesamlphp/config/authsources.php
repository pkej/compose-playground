<?php

$config = array(

    // This is a authentication source which handles admin authentication.
    'admin' => array(
        // The default is to use core:AdminPassword, but it can be replaced with
        // any authentication source.

        'core:AdminPassword',
    ),


/*
    'owncloud-test-adfs' => array(
        'saml:SP',
        'idp' => 'https://localhost:58443/adfs/services/trust',
        'privatekey' => 'saml.pem',
        'certificate' => 'saml.crt',
    ),*/

    /*
    'example-sql' => array(
        'sqlauth:SQL',
        'dsn' => 'pgsql:host=sql.example.org;port=5432;dbname=simplesaml',
        'username' => 'simplesaml',
        'password' => 'secretpassword',
        'query' => 'SELECT uid, givenName, email, eduPersonPrincipalName FROM users WHERE uid = :username AND password = SHA2(CONCAT((SELECT salt FROM users WHERE uid = :username), :password),256);',
    ),
    */

    /*
    'example-static' => array(
        'exampleauth:Static',
        'uid' => array('testuser'),
        'eduPersonAffiliation' => array('member', 'employee'),
        'cn' => array('Test User'),
    ),
    */


    'basicauth' => array(
		'exampleauth:UserPass',

        // Give the user an option to save their username for future login attempts
        // And when enabled, what should the default be, to save the username or not
        //'remember.username.enabled' => FALSE,
        //'remember.username.checked' => FALSE,

        'student:studentpass' => array(
            'uid' => array('student'),
            'eduPersonAffiliation' => array('member', 'student'),
            'quota' => array('100G')
        ),
		'display:display' => array(
			'uid' => array('display'),
			'eduPersonAffiliation' => array('member', 'student'),
			'quota' => array('100G'),
			'displayName' => array('Dis Play')
		),
		'email:email' => array(
			'uid' => array('email'),
			'eduPersonAffiliation' => array('member', 'student'),
			'quota' => array('100G'),
			'email' => array('email@owncloud.com')
		),
		'all:all' => array(
			'uid' => array('all'),
			'eduPersonAffiliation' => array('member', 'student'),
			'quota' => array('100G'),
			'email' => array('all@owncloud.com'),
			'displayName' => array('All Fields')
		),
        'employee:employeepass' => array(
            'uid' => array('employee'),
            'eduPersonAffiliation' => array('member', 'employee'),
        ),
    ),


    /*
    'crypto-hash' => array(
        'authcrypt:Hash',
        // hashed version of 'verysecret', made with bin/pwgen.php
        'professor:{SSHA256}P6FDTEEIY2EnER9a6P2GwHhI5JDrwBgjQ913oVQjBngmCtrNBUMowA==' => array(
            'uid' => array('prof_a'),
            'eduPersonAffiliation' => array('member', 'employee', 'board'),
        ),
    ),
    */

    /*
    'htpasswd' => array(
        'authcrypt:Htpasswd',
        'htpasswd_file' => '/var/www/foo.edu/legacy_app/.htpasswd',
        'static_attributes' => array(
            'eduPersonAffiliation' => array('member', 'employee'),
            'Organization' => array('University of Foo'),
        ),
    ),
    */

    /*
    // This authentication source serves as an example of integration with an
    // external authentication engine. Take a look at the comment in the beginning
    // of modules/exampleauth/lib/Auth/Source/External.php for a description of
    // how to adjust it to your own site.
    'example-external' => array(
        'exampleauth:External',
    ),
    */

    /*
    'yubikey' => array(
        'authYubiKey:YubiKey',
         'id' => '000',
        // 'key' => '012345678',
    ),
    */

    /*
    'openid' => array(
        'openid:OpenIDConsumer',
        'attributes.required' => array('nickname'),
        'attributes.optional' => array('fullname', 'email',),
        // 'sreg.validate' => FALSE,
        'attributes.ax_required' => array('http://axschema.org/namePerson/friendly'),
        'attributes.ax_optional' => array('http://axschema.org/namePerson','http://axschema.org/contact/email'),
        // Prefer HTTP redirect over POST
        // 'prefer_http_redirect' => FALSE,
    ),
    */

    /*
    // Example of an authsource that authenticates against Google.
    // See: http://code.google.com/apis/accounts/docs/OpenID.html
    'google' => array(
        'openid:OpenIDConsumer',
        // Googles OpenID endpoint.
        'target' => 'https://www.google.com/accounts/o8/id',
        // Custom realm
        // 'realm' => 'http://*.example.org',
        // Attributes that google can supply.
        'attributes.ax_required' => array(
            //'http://axschema.org/namePerson/first',
            //'http://axschema.org/namePerson/last',
            //'http://axschema.org/contact/email',
            //'http://axschema.org/contact/country/home',
            //'http://axschema.org/pref/language',
        ),
        // custom extension arguments
        'extension.args' => array(
            //'http://specs.openid.net/extensions/ui/1.0' => array(
            //	'mode' => 'popup',
            //	'icon' => 'true',
            //),
        ),
    ),
    */

    /*
    'papi' => array(
        'authpapi:PAPI',
    ),
    */


    /*
    'facebook' => array(
        'authfacebook:Facebook',
        // Register your Facebook application on http://www.facebook.com/developers
        // App ID or API key (requests with App ID should be faster; https://github.com/facebook/php-sdk/issues/214)
        'api_key' => 'xxxxxxxxxxxxxxxx',
        // App Secret
        'secret' => 'xxxxxxxxxxxxxxxx',
        // which additional data permissions to request from user
        // see http://developers.facebook.com/docs/authentication/permissions/ for the full list
        // 'req_perms' => 'email,user_birthday',
    ),
    */

    /*
    // LinkedIn OAuth Authentication API.
    // Register your application to get an API key here:
    //  https://www.linkedin.com/secure/developer
    'linkedin' => array(
        'authlinkedin:LinkedIn',
        'key' => 'xxxxxxxxxxxxxxxx',
        'secret' => 'xxxxxxxxxxxxxxxx',
    ),
    */

    /*
    // Twitter OAuth Authentication API.
    // Register your application to get an API key here:
    //  http://twitter.com/oauth_clients
    'twitter' => array(
        'authtwitter:Twitter',
        'key' => 'xxxxxxxxxxxxxxxx',
        'secret' => 'xxxxxxxxxxxxxxxx',

        // Forces the user to enter their credentials to ensure the correct users account is authorized.
        // Details: https://dev.twitter.com/docs/api/1/get/oauth/authenticate
        'force_login' => FALSE,
    ),
    */

    /*
    // MySpace OAuth Authentication API.
    // Register your application to get an API key here:
    //  http://developer.myspace.com/
    'myspace' => array(
        'authmyspace:MySpace',
        'key' => 'xxxxxxxxxxxxxxxx',
        'secret' => 'xxxxxxxxxxxxxxxx',
    ),
    */

    /*
    // Windows Live ID Authentication API.
    // Register your application to get an API key here:
    //  https://manage.dev.live.com
    'windowslive' => array(
        'authwindowslive:LiveID',
        'key' => 'xxxxxxxxxxxxxxxx',
        'secret' => 'xxxxxxxxxxxxxxxx',
    ),
    */


    // Example of a LDAP authentication source.
    'openldap' => array(
        'ldap:LDAP',

        // Give the user an option to save their username for future login attempts
        // And when enabled, what should the default be, to save the username or not
        //'remember.username.enabled' => FALSE,
        //'remember.username.checked' => FALSE,

        // The hostname of the LDAP server.
        'hostname' => 'openldap',

        // Whether SSL/TLS should be used when contacting the LDAP server.
        'enable_tls' => FALSE,

        // Whether debug output from the LDAP library should be enabled.
        // Default is FALSE.
        'debug' => FALSE,

        // The timeout for accessing the LDAP server, in seconds.
        // The default is 0, which means no timeout.
        'timeout' => 0,

        // Set whether to follow referrals. AD Controllers may require FALSE to function.
        'referrals' => TRUE,

        // Which attributes should be retrieved from the LDAP server.
        // This can be an array of attribute names, or NULL, in which case
        // all attributes are fetched.
        'attributes' => NULL,

        // The pattern which should be used to create the users DN given the username.
        // %username% in this pattern will be replaced with the users username.
        //
        // This option is not used if the search.enable option is set to TRUE.
        'dnpattern' => 'uid=%username%,ou=people,dc=owncloudqa,dc=com',

        // As an alternative to specifying a pattern for the users DN, it is possible to
        // search for the username in a set of attributes. This is enabled by this option.
        'search.enable' => FALSE,

        // The DN which will be used as a base for the search.
        // This can be a single string, in which case only that DN is searched, or an
        // array of strings, in which case they will be searched in the order given.
        'search.base' => 'dc=owncloudqa,dc=com',

        // The attribute(s) the username should match against.
        //
        // This is an array with one or more attribute names. Any of the attributes in
        // the array may match the value the username.
        'search.attributes' => array('uid', 'mail'),

        // The username & password the simpleSAMLphp should bind to before searching. If
        // this is left as NULL, no bind will be performed before searching.
        'search.username' => 'admin',
        'search.password' => 'owncloud123',

        // If the directory uses privilege separation,
        // the authenticated user may not be able to retrieve
        // all required attribures, a privileged entity is required
        // to get them. This is enabled with this option.
        'priv.read' => FALSE,

        // The DN & password the simpleSAMLphp should bind to before
        // retrieving attributes. These options are required if
        // 'priv.read' is set to TRUE.
        'priv.username' => NULL,
        'priv.password' => NULL,

    ),

    /*
    // Example of an LDAPMulti authentication source.
    'example-ldapmulti' => array(
        'ldap:LDAPMulti',

        // Give the user an option to save their username for future login attempts
        // And when enabled, what should the default be, to save the username or not
        //'remember.username.enabled' => FALSE,
        //'remember.username.checked' => FALSE,

        // The way the organization as part of the username should be handled.
        // Three possible values:
        // - 'none':   No handling of the organization. Allows '@' to be part
        //             of the username.
        // - 'allow':  Will allow users to type 'username@organization'.
        // - 'force':  Force users to type 'username@organization'. The dropdown
        //             list will be hidden.
        //
        // The default is 'none'.
        'username_organization_method' => 'none',

        // Whether the organization should be included as part of the username
        // when authenticating. If this is set to TRUE, the username will be on
        // the form <username>@<organization identifier>. If this is FALSE, the
        // username will be used as the user enters it.
        //
        // The default is FALSE.
        'include_organization_in_username' => FALSE,

        // A list of available LDAP servers.
        //
        // The index is an identifier for the organization/group. When
        // 'username_organization_method' is set to something other than 'none',
        // the organization-part of the username is matched against the index.
        //
        // The value of each element is an array in the same format as an LDAP
        // authentication source.
        'employees' => array(
            // A short name/description for this group. Will be shown in a dropdown list
            // when the user logs on.
            //
            // This option can be a string or an array with language => text mappings.
            'description' => 'Employees',

            // The rest of the options are the same as those available for
            // the LDAP authentication source.
            'hostname' => 'ldap.employees.example.org',
            'dnpattern' => 'uid=%username%,ou=employees,dc=example,dc=org',
        ),

        'students' => array(
            'description' => 'Students',

            'hostname' => 'ldap.students.example.org',
            'dnpattern' => 'uid=%username%,ou=students,dc=example,dc=org',
        ),

    ),
    */

);
