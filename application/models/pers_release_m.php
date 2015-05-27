<?php
class Pers_release_m  extends CI_Model  {


	protected $table_name = "tbl_pers_release";
	protected $primary_keys = "id_pers_release";
	var $sess = "";

	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_latest_Pers_release($limit = 5)
	{
		$this->db->limit($limit);
		$this->db->order_by( $this->primary_keys . " desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function get_list($limit=0, $offset=0)
	{
		$this->db->order_by("id_pers_release desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_detail($id_pers_release=NULL)
	{
		$this->db->where(array("id_pers_release"=>$id_pers_release));
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function get_count()
	{
		return $this->db->count_all_results($this->table_name);
	}
	
}