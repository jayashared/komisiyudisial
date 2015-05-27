<?php
class Laws_m  extends CI_Model  {


	protected $table_name = "view_tbl_laws";
	protected $table_category = "tbl_laws_category";
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
		$this->db->order_by("id_laws desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function get_list($limit=0, $offset=0, $id_laws_category=NULL)
	{
		$this->db->where(array("id_laws_category"=>$id_laws_category));
		$this->db->order_by("id_laws desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_detail($id_laws=NULL)
	{
		$this->db->where(array("id_laws"=>$id_laws));
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function get_count($id_laws_category=NULL)
	{
		$this->db->where(array("id_laws_category"=>$id_laws_category));
		return $this->db->count_all_results($this->table_name);
	}
	
	public function get_category($where=NULL)
	{
		if( !empty($where) )
			$this->db->where($where);
		
		if( $this->sess == "id" )
			$this->db->order_by("id_laws_category asc");
		else
			$this->db->order_by("id_laws_category asc");
			
		$query = $this->db->get($this->table_category);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	/*function get_laws_year($name=NULL)
	{
		if( !empty($name) )
			$this->db->where(array("name"=>$name));
		$this->db->order_by("laws_year desc");
		$query = $this->db->get("view_laws_year");
		return $query->result();
	}*/

}