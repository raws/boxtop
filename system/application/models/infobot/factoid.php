<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Factoid extends Model {
	function __construct() {
		parent::Model();
		
		define('FACTOID_TABLE', 'infobot_factoids');
		define('DEFINITIONS_TABLE', 'infobot_definitions');
	}
	
	function autocomplete_search($query) {
		$query = $this->db->select('name')->from(FACTOID_TABLE)->
			like('name', $query, 'after')->order_by('name')->limit(15)->get();
		return $query->result();
	}
	
	function search($query) {
		$query = $this->db->select('id, name')->like('name', $query)->
			order_by('name')->get(FACTOID_TABLE);
		return $query;
	}
	
	function get($key, $fetch_definitions = TRUE) {
		$query = null;
		$field = is_numeric($key) ? 'id' : 'name';
		
		$query = $this->db->get_where(FACTOID_TABLE, array($field => $key), 1);
		
		if ($query->num_rows() <= 0)
			return FALSE;
		
		$factoid = array();
		$factoid['id'] = $query->row()->id;
		$factoid['name'] = $query->row()->name;
		
		if ($fetch_definitions) {
			$definitions = $this->db->get_where(DEFINITIONS_TABLE, array('factoid_id' => $factoid['id']));
			$factoid['definitions'] = $definitions->result();
		}
		
		return $factoid;
	}
	
	function update_definitions($id, $definitions) {
		$this->db->trans_start();
		$this->db->delete(DEFINITIONS_TABLE, array('factoid_id' => $id));
		foreach ($definitions as $definition) {
			$data = array(
				'factoid_id' => $id,
				'body' => str_replace("\n", '\n', $definition),
				'verb' => 'is' );
			$this->db->insert(DEFINITIONS_TABLE, $data);
		}
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
}