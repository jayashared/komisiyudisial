<?php
class Gallery_m  extends CI_Model  {


	protected $table_name = "tbl_gallery";
	protected $primary_keys = "id_gallery";
	var $sess = "";

	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_latest($limit=5)
	{
		$this->db->order_by( "id_gallery desc");
			
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function get_list($limit=0, $offset=0)
	{
		$this->db->order_by("id_gallery desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_detail($id_gallery=NULL)
	{
		$this->db->where(array("id_gallery"=>$id_gallery));
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function get_count()
	{
		return $this->db->count_all_results($this->table_name);
	}
	
}