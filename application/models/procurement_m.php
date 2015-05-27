<?php
class Procurement_m  extends CI_Model  {


	protected $table_name = "tbl_procurement";
	protected $primary_keys = "id_procurement";
	var $sess = "";

	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_latest_procurement($limit = 5)
	{
		$this->db->limit($limit);
		$this->db->order_by( $this->primary_keys . " desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function get_list($limit=0, $offset=0)
	{
		$this->db->order_by("id_procurement desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_detail($id_procurement=NULL)
	{
		$this->db->where(array("id_procurement"=>$id_procurement));
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function get_count()
	{
		return $this->db->count_all_results($this->table_name);
	}
	
}