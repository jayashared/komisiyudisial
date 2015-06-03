<?php
class Slider_m  extends CI_Model  {


	protected $table_name = "tbl_slider";
	protected $primary_keys = "id_slider";

	function __construct()
    {
        parent::__construct();
    }
	
	function get_latest($limit = 5)
	{
		$this->db->limit($limit);
		$this->db->order_by( $this->primary_keys . " desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function get_detail($id_slider=NULL)
	{
		$this->db->where( array("id_slider"=>$id_slider));
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
}