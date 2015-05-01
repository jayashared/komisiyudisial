<?php
class Pers_release_m  extends CI_Model  {


	protected $table_name = "tbl_pers_release";
	protected $primary_keys = "id_pers_release";

	function __construct()
    {
        parent::__construct();
    }
	
	function get_latest_Pers_release($limit = 5)
	{
		$this->db->limit($limit);
		$this->db->order_by( $this->primary_keys . " desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
}