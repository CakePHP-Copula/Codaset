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
		'tweets' => array(
			'id' => array(
				'type' => 'integer',
				'null' => true,
				'key' => 'primary',
				'length' => 11,
			),
			'text' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'status' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
		)
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
	 	return $this->_schema['tweets'];
	}
	
	function listSources() {
		return array();
	}
	
	function request($params) {
		$response = $this->socket->get($this->baseUri . $params . '.' . $this->format);
		if ($this->format == 'json') {
			$response = json_decode($response, true);
		}
		return $response;
	}
	
	function create($model, $fields = array(), $values = array()) {
	}
	
	/**
	 * Use $Model->find('all') for all queries
	 *
	 * Used Options:
	 *	conditions: username, project
	 *	fields: wiki, tickets, milestones, blog, projects, collaborations, followers, followings, friends, bookmarks
	 *		Use Strings Only, Example: 'fields' => 'projects'
	 *
	 * @param string $model 
	 * @param string $queryData 
	 * @return void
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
			
		return $this->request($uri);
	}
	
	function update($model, $fields = array(), $values = array()) {
	}
	
	function delete($model, $id = null) {
	}
}