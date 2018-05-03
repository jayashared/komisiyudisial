<?php
class Announcement_m  extends CI_Model  {


	protected $table_name = "tbl_announcement";
	protected $primary_keys = array();

	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_latest($limit = 4)
	{
		$this->db->limit($limit);
		$this->db->order_by("id_announcement desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function get_list($limit=0, $offset=0)
	{
		$this->db->order_by("id_announcement desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_detail($id_announcement=NULL)
	{
		$this->db->where(array("id_announcement"=>$id_announcement));
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function get_count()
	{
		return $this->db->count_all_results($this->table_name);
	}
		
}