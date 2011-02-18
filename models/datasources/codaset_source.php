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
class CodasetSource extends DataSource {

	/**
	 * Array containing the names of components this component uses. Component names
	 * should not contain the "Component" portion of the classname.
	 *
	 * @var array
	 * @access public
	 */
	var $config = array();
	
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
		'milestones',
		'tickets',
		'blogs',
		'wiki',
		'ssh_keys',
		'email_aliases',
		'logged_time',
	);
	
	var $socket;
	var $baseUri = 'https://api.codaset.com';
	var $format = 'json'; // json | xml
	
	function __construct($config) {
		App::import('Core', 'HttpSocket');
		$this->socket = new HttpSocket();
		if (isset($config['base_uri']))
			$this->baseUri = $config['base_uri'];
		parent::__construct($config);
	}

	function describe($model) {
	 	return $this->_schema['projects'];
	}
	
	function listSources() {
		return array();
	}
	
	/**
	 * Sends HttpSocket requests. Builds your uri and formats the response too.
	 *
	 * @param string $uri 
	 * @param array $options
	 *		method: get, post, delete, put
	 *		data: either in string form: "param1=foo&param2=bar" or as a keyed array: array('param1' => 'foo', 'param2' => 'bar')
	 * @return array $response
	 * @author Dean Sofer
	 */
	function _request($uri, $options = array()) {
		$options = array_merge(array(
			'method' => 'get',
			'data' => array(),
		), $options);
		$response = $this->socket->{$options['method']}($this->baseUri . $uri . '.' . $this->format, $options['data']);
		if ($this->format == 'json') {
			$response = json_decode($response);
		}
		return $response;
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
	
	function update($model, $fields = array(), $values = array()) {
	}
	
	function delete($model, $id = null) {
	}
}