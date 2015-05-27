<?php
class Video_m  extends CI_Model  {


	protected $table_name = "tbl_video";
	protected $primary_keys = array();

	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_latest($limit = 10)
	{
		$this->db->limit($limit);
		$this->db->order_by("id_video desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function get_list($limit=0, $offset=0)
	{
		$this->db->order_by("id_video desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_detail($id_video=NULL)
	{
		$this->db->where(array("id_video"=>$id_video));
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function get_count()
	{
		return $this->db->count_all_results($this->table_name);
	}
	
}