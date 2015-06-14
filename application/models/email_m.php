<?php
class Email_m  extends CI_Model  {

	var $table = "tbl_email_konfigurasi";

	function __construct()
    {
        parent::__construct();
    }
	
	function get_config()
	{
		$this->db->limit(1);
		$query = $this->db->get('tbl_email_configuration');
		return $query->result();
	}
}