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
	 * Stores the queryData so that the tokens can be substituted just before requesting
	 *
	 * @param string $model 
	 * @param string $queryData 
	 * @return mixed $data
	 * @author Dean Sofer
	 */
	public function read(&$model, $queryData = array()) {
		$this->tokens = $queryData['conditions'];
		return parent::read($model, $queryData);
	}
}