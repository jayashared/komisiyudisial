<?php
class Publication_m  extends CI_Model  {


	protected $table_name = "view_tbl_publication";
	protected $table_category = "tbl_publication_category";
	protected $primary_keys = array();
	var $sess = "";
	
	function __construct()
    {
        parent::__construct();
    	$this->sess = $this->session->userdata("lang");
	}
	
	function get_latest($limit = 5)
	{
		$this->db->limit($limit);
		$this->db->order_by("id_publication desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function get_list($limit=0, $offset=0, $name=NULL, $publication_year=NULL)
	{
		if( !empty($publication_year) )
			$this->db->where(array("publication_year"=>$publication_year));
		$this->db->where(array("name"=>$name));
		$this->db->order_by("publication_date desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_detail($id_publication=NULL)
	{
		$this->db->where(array("id_publication"=>$id_publication));
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function get_count($name=NULL, $publication_year=NULL)
	{
		if( !empty($publication_year) )
			$this->db->where(array("publication_year"=>$publication_year));
		$this->db->where(array("name"=>$name));
		return $this->db->count_all_results($this->table_name);
	}
	
	public function get_category($where=NULL)
	{
		if( !empty($where) )
			$this->db->where($where);
		
		if( $this->sess == "id" )
			$this->db->order_by("id_publication_category asc");
		else
			$this->db->order_by("id_publication_category asc");
			
		$query = $this->db->get($this->table_category);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_publication_year($name=NULL)
	{
		if( !empty($name) )
			$this->db->where(array("name"=>$name));
		$this->db->order_by("publication_year desc");
		$query = $this->db->get("view_publication_year");
		return $query->result();
	}

}