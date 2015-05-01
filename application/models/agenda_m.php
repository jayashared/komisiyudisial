<?php
class Agenda_m  extends CI_Model  {


	protected $table_name = "tbl_agenda";
	protected $primary_keys = array();

	function __construct()
    {
        parent::__construct();
    }
	
	function get_latest_agenda($limit = 5)
	{
		$this->db->limit($limit);
		$this->db->order_by("id_agenda desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
}