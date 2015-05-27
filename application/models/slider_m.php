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
	
}