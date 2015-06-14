<?php
class Sitemap_m  extends CI_Model  {


	protected $table_name = "view_tbl_sitemap";
	protected $primary_keys = array();

	function __construct()
    {
        parent::__construct();
    }
	
	function get_admin_sitemap($where)
	{
		!empty($where)?$this->db->where($where):"";
		$this->db->like("sitemap_code", "02.", "after");
		$this->db->order_by("title_id");
		$query = $this->db->get("view_tbl_sitemap");		
		//echo $this->db->last_query(); exit;
		return $query->result();
	}
	
	function get_frontend_sitemap($where)
	{
		!empty($where)?$this->db->where($where):"";
		$this->db->like("sitemap_code", "01.", "after");
		$this->db->order_by("sort_no");
		$query = $this->db->get("view_tbl_sitemap");		
		return $query->result();
	}
	
	function get_frontend_footer_sitemap($where)
	{
		!empty($where)?$this->db->where($where):"";
		$this->db->like("sitemap_code", "03.", "after");
		$this->db->order_by("sort_no");
		$query = $this->db->get("view_tbl_sitemap");		
		return $query->result();
	}
}