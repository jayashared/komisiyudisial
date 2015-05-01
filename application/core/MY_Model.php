<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
	
	var $table = NULL;
	var $order_by = NULL;
	var $where = NULL;
	
	public function set_table($table="")
	{
		$this->table = $table;
	}
	
	public function get_data($config = NULL)
	{
		if( isset($config["limit"]) and isset($config["offset"]) )
		{
			$this->db->limit($config["offset"], $config["limit"]);			
		}
		if( isset($config["limit"]) )
		{
			$this->db->limit($config["limit"]);
		}
		if( isset($config["like"]) )
		{
			$this->db->like($config["like"]['title'], $config["like"]['match'], $config["like"]['position']);
		}
		if( isset($config["order_by"]) )
		{
			$this->db->order_by($config["order_by"]);
		}
		if( isset($config["where"]) )
		{
			$thisdb->where($config["where"]);
		}
		
		$query = $this->db->get($this->table);
		return $query->result();
	}
	
	public function count_all()
	{
		return $this->db->count_all_results($this->table);
	}
}