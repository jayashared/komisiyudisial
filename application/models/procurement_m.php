<?php
class Procurement_m  extends CI_Model  {


	protected $table_name = "tbl_procurement";
	protected $primary_keys = "id_procurement";

	function __construct()
    {
        parent::__construct();
    }
	
	function get_latest_procurement($limit = 5)
	{
		$this->db->limit($limit);
		$this->db->order_by( $this->primary_keys . " desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
}