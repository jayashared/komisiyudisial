<?php
class Gallery_m  extends CI_Model  {


	protected $table_name = "tbl_gallery";
	protected $table_category_name = "tbl_gallery_category";
	protected $primary_keys = "id_gallery";
	protected $view_name = "view_gallery";
	
	var $sess = "";

	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_latest($limit=4)
	{
		$this->db->limit($limit);
		$this->db->order_by( "id_gallery desc");
		$query = $this->db->get($this->view_name);		
		return $query->result();
	}
	
	function get_list($limit=0, $offset=0, $where=NULL)
	{
		if(!empty( $where ))
			$this->db->where($where);
		$this->db->order_by("id_gallery desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get($this->view_name);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_detail($id_gallery=NULL)
	{
		$this->db->where(array("id_gallery"=>$id_gallery));
		$query = $this->db->get($this->view_name);
		return $query->result();
	}
	
	function get_count($where=NULL)
	{
		if(!empty( $where ))
			$this->db->where($where);
		return $this->db->count_all_results($this->table_name);
	}
	
	function gallery_category()
	{
		$this->db->order_by("id_gallery_category desc");
		$query = $this->db->get($this->table_category_name);
		return $query->result();
	}
}