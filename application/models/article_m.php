<?php
class Article_m  extends CI_Model  {


	protected $table_name = "tbl_article";
	protected $primary_keys = array();

	function __construct()
    {
        parent::__construct();
    }
	
	function get_latest_article($limit = 5)
	{
		$this->db->limit($limit);
		$this->db->order_by("id_article desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
}