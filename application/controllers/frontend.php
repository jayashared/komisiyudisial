<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends CI_Controller {
	
	var $data = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$sitemap = $this->data_sitemap();
		$data = $sitemap;
		$this->data = $data;
		
		// Session For Language
		$this->session->set_userdata('lang', 'id');
	}
	
	public function index()
	{
		$this->load->model("news_m");
		$this->load->model("agenda_m");
		$this->load->model("article_m");
		$this->load->model("procurement_m");
		$this->load->model("pers_release_m");
		
		$data["news"] = $this->news_m->get_latest_news();
		$data["agenda"] = $this->agenda_m->get_latest_agenda();
		$data["article"] = $this->article_m->get_latest_article();
		$data["procurement"] = $this->procurement_m->get_latest_procurement();
		$data["pers_release"] = $this->pers_release_m->get_latest_pers_release();
		$data["sitemap"] = $this->get_sitemap();
		$data["content"] = "frontend/pages/home.view.php";
		$this->load->view('frontend/index', $data);
	}
	
	public function data_sitemap()
	{
		$this->load->model("sitemap_m");
		$sitemap = $this->sitemap_m->get_frontend_sitemap(array("sitemap_level"=>"2"));
		foreach( $sitemap as $row )
		{
			$id_parent = $row->id_sitemap;
			$where = array("id_parent"=>$id_parent, "sitemap_level"=>"3");
			$row->sub_sitemap = $this->sitemap_m->get_frontend_sitemap($where);
		}
		return $sitemap;
	}
	
	public function get_sitemap()
	{
		return $this->data;
	}
	
}