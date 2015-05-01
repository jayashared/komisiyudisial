<?php
class News_m  extends CI_Model  {


	protected $table_name = "tbl_news";
	protected $primary_keys = array();

	function __construct()
    {
        parent::__construct();
    }
	
	function get_latest_news($limit = 5)
	{
		$this->db->limit($limit);
		$this->db->order_by("id_news desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
}