<?php
class Information_system_m  extends CI_Model  {


	protected $table_name = "tbl_information_system";
	protected $primary_keys = "id_information_system";
	var $sess = "";

	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_list()
	{
		if( $this->sess == "id" )
			$this->db->order_by( "title_id desc");
		else
			$this->db->order_by( "title_en desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
}