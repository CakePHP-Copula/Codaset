<?php
/**
 * A Codaset API Method Map
 *
 * Refer to the apis plugin for how to build a method map
 * https://github.com/ProLoser/CakePHP-Api-Datasources
 *
 */
$config['Apis']['Codaset']['hosts'] = array(
	'oauth' => 'api.codaset.com/authorization',
	'rest' => 'api.codaset.com',
);
// http://developer.github.com/v3/oauth/
$config['Apis']['Codaset']['oauth'] = array(
	'version' => '2.0',
	'authorize' => 'new', // Example URI: https://github.com/login/oauth/authorize
	'request' => 'token', //client_id={$this->config['login']}&redirect_uri
	'access' => 'access_token', 
	'login' => 'authenticate', // Like authorize, just auto-redirects
	'logout' => 'invalidateToken', 
);
$config['Apis']['Codaset']['read'] = array(
	// field
	'projects' => array(
		':username/:project' => array(
			'username',
			'project',
		),
		':username/projects' => array(
			'username',
		),
		'projects' => array(),
	),
	'collaborations' => array(
		':username/collaborations' => array(
			'username',
		),
	),
	'followers' => array(
		':username/followers' => array(
			'username',
		),
	),
	'followings' => array(
		':username/followings' => array(
			'username',
		),
	),
	'friends' => array(
		':username/friends' => array(
			'username',
		),
	),
	'bookmarks' => array(
		':username/bookmarks' => array(
			'username',
		),
	),
	'blog' => array(
		':username/:project/blog' => array(
			'username',
			'project',
			'optional' => array(
				'page',
				'count',
			),
		),
	),
);

$config['Apis']['Codaset']['create'] = array(
);

$config['Apis']['Codaset']['update'] = array(
);

$config['Apis']['Codaset']['delete'] = array(
);