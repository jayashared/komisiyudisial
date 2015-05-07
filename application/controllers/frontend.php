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
	
	public function paging($pag=array())
	{
		$config['base_url'] = $pag["url"];
		$config['total_rows'] = $pag["total_rows"];
		$config['per_page'] = $pag["per_page"]; 
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['query_string_segment'] = "page";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_link'] = 'Akhir';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_link'] = 'Awal';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['anchor_class'] = 'class="page"';
		$this->pagination->initialize($config);	
		return $this->pagination->create_links();
	}
	
	public function static_content($static_content = NULL)
	{
		$this->load->model("static_content_m");
		$where = array("static_content"=>$static_content);
		$static_content = $this->static_content_m->display($where);
		
		$data["static_content"] = $static_content;
		/* Wajib */
		$data["sitemap"] = $this->get_sitemap();
		$data["content"] = "frontend/pages/static-content.view.php";
		$this->load->view('frontend/index', $data);
		/* Wajib */
	}
	
	public function news()
	{
		try
		{
			
			$this->load->model("news_m");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 10;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->news_m->get_count();
			$url = base_url() . "frontend/news/?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$news = $this->news_m->get_list($limit, $offset);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$data["news"] = $news;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/news-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
}