<?php
/**
 * Codaset DataSource
 * 
 * [Short Description]
 *
 * @package default
 * @author Dean Sofer
 * @version $Id$
 * @copyright 
 **/
class Codaset extends ApisSource {
	
	var $_schema = array(
		'projects' => array(
			'title' => array(
				'type' => 'string',
				'null' => false,
				'key' => 'primary',
				'length' => 255,
			),
			'description' => array(
				'type' => 'text',
				'null' => false,
			),
			'state' => array(
				'type' => 'string',
				'null' => true,
				'length' => 15
			),
			'created_at',
			'updated_at',
			'last_pushed_at',
			'fork_count' => array(
				'type' => 'integer',
				'null' => true,
				'length' => 11,
			),
			'ticket_count' => array(
				'type' => 'integer',
				'null' => true,
				'length' => 11,
			),
			'default_branch' => array(
				'type' => 'string',
				'null' => true,
				'length' => 15
			),
			'externally_forked_from' => array(
				'type' => 'string',
				'null' => true,
				'length' => 255,
			),
			'bookmark_count' => array(
				'type' => 'integer',
				'null' => true,
				'length' => 11,
			),
			'url' => array(
				'type' => 'string',
				'null' => false,
				'key' => 'primary',
				'length' => 255,
			),
			'forked_from' => array(
				'type' => 'string',
				'null' => true,
				'length' => 255,
			),
			'disk_usage' => array(
				'type' => 'integer',
				'null' => true,
				'length' => 11,
			),
			'slug' => array(
				'type' => 'string',
				'null' => false,
				'key' => 'primary',
				'length' => 255,
			),
		),
		'milestones' => array(),
		'tickets' => array(),
		'blogs' => array(),
		'wiki' => array(),
		'ssh_keys' => array(),
		'email_aliases' => array(),
		'logged_time' => array(),
	);
	
	/**
     * The http client options
     * @var array
     */
    public $options = array(
        'protocol'   			=> 'https',
        'format'     			=> 'json',
        'user_agent' 			=> 'cakephp codaset datasource',
        'http_port'  			=> 80,
        'timeout'    			=> 10,
        'login'      			=> null,
        'token'      			=> null,
		'param_separator'		=> '/',
		'key_value_separator'	=> null,
    );
	
    protected $url = ':protocol://api.codaset.com/:path.:format';
	
	
	/**
	 * Create functions
	 *
	 * Not sure how to specify WHAT it is you want to create yet...
	 *
	 * View the API for a list of required/permitted fields
	 *
	 * @param object $model 
	 * @param array $fields 
	 * @param array $values 
	 * @return void
	 * @author Dean Sofer
	 */
	function create($model, $fields = array(), $values = array()) {
		
		// TODO: Requires OAUTH2 Authentication first
		$uri = '/' . $data['username'];
		$options['method'] = 'post';
		$options['data'] = array_combine($fields, $values);
		
		return $this->_request($uri, $options);
	}
	
	/**
	 * Use $Model->find('all') for all queries
	 *
	 * Used Options:
	 *	conditions: username, project
	 *	fields: wiki, tickets, milestones, blog, projects, collaborations, followers, followings, friends, bookmarks
	 *		Use Strings Only, Example: 'fields' => 'projects'
	 *
	 * @param object $model 
	 * @param array $queryData 
	 * @return array $response
	 * @author Dean Sofer
	 */
	function read($model, $queryData = array()) {
		$uri = '';
		if (!empty($queryData['conditions']['username']))
			$uri .= '/' . $queryData['conditions']['username'];
		if (!empty($queryData['conditions']['project']))
			$uri .= '/' . $queryData['conditions']['project'];
		if (!empty($queryData['fields']))
			$uri .= '/' . $queryData['fields'];
		return $this->_request($uri);
	}
    
	/**
	 * Authenticates the user with Codaset using OAuth2
	 * http://api.codaset.com/docs/oauth
	 *
	 * @return void
	 * @author Dean Sofer
	 */
	function authenticate() {
		
	}
}