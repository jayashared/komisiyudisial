<?php
class Article_m  extends CI_Model  {


	protected $table_name = "tbl_article";
	protected $primary_keys = array();
	var $sess = "";


	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_latest_article($limit = 4)
	{
		$this->db->limit($limit);
		$this->db->order_by("id_article desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function get_list($limit=0, $offset=0)
	{
		$this->db->order_by("id_article desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_detail($id_article=NULL)
	{
		$this->db->where(array("id_article"=>$id_article));
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function get_count()
	{
		return $this->db->count_all_results($this->table_name);
	}
	
}