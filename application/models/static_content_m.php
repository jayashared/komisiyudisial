<?php
class Static_content_m  extends CI_Model  {


	protected $table_name = "tbl_static_content";
	protected $primary_keys = "id_static_content";

	function __construct()
    {
        parent::__construct();
    }
	
	function display($where)
	{
		$this->db->where($where);
		$this->db->order_by($this->primary_keys . " desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
}