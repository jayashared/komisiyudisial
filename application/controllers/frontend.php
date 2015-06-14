<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends CI_Controller {
	
	var $data = array();
	var $data_footer = array();
	var $data_newsticker = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$sitemap = $this->data_sitemap();
		$sitemap_footer = $this->data_sitemap_footer();
		
		$data = $sitemap;
		$this->data = $data;
		$this->data_footer = $sitemap_footer;
		$this->data_newsticker = $this->data_newsticker();
		
		
		// Session For Language
		$def_lang = $this->session->userdata('lang');
		if( empty($def_lang) )
		$this->session->set_userdata('lang', 'id');
	}
	
	public function set_lang($lang="ID")
	{
		$curl = $this->input->get("curl");
		$this->session->set_userdata('lang', strtolower($lang));
		redirect($curl);
	}
	
	public function index()
	{
		$this->load->model("news_m");
		$this->load->model("agenda_m");
		$this->load->model("announcement_m");
		$this->load->model("article_m");
		$this->load->model("video_m");
		$this->load->model("procurement_m");
		$this->load->model("pers_release_m");
		$this->load->model("slider_m");
		$this->load->model("link_m");
		$this->load->model("information_system_m");
		$this->load->model("polling_m");
		$this->load->model("gallery_m");
		
		
		$polling = $this->polling_m->get_category();
		foreach( $polling as $row )
		{
			$id_polling_category = $row->id_polling_category;
			$row->option = $this->polling_m->get_list(array("id_polling_category"=>$id_polling_category));
		}
		
		$data["news"] = $this->news_m->get_latest_news();
		$data["agenda"] = $this->agenda_m->get_latest_agenda();
		$data["announcement"] = $this->announcement_m->get_latest();
		$data["article"] = $this->article_m->get_latest_article();
		$data["video"] = $this->video_m->get_latest();
		$data["procurement"] = $this->procurement_m->get_latest_procurement();
		$data["pers_release"] = $this->pers_release_m->get_latest_pers_release();
		$data["slider"] = $this->slider_m->get_latest();
		$data["link"] = $this->link_m->get_list();
		$data["information_system"] = $this->information_system_m->get_list();
		$data["polling"] = $polling;
		$data["gallery"] = $this->gallery_m->get_latest();
		
		//echo "<pre>";
		//print_r($this->get_sitemap()); exit;
		
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
	
	public function data_sitemap_footer()
	{
		$this->load->model("sitemap_m");
		$sitemap = $this->sitemap_m->get_frontend_footer_sitemap(array("sitemap_level"=>"2"));
		foreach( $sitemap as $row )
		{
			$id_parent = $row->id_sitemap;
			$where = array("id_parent"=>$id_parent, "sitemap_level"=>"3");
			$row->sub_sitemap = $this->sitemap_m->get_frontend_footer_sitemap($where);
		}
		return $sitemap;
	}
	
	public function data_newsticker()
	{
		$this->load->model("global_m");
		
		$data = $this->global_m->get_newsticker_list();
		return $data;
	}
	
	public function get_sitemap()
	{
		$array_sitemap = $this->data;
		$array_footer = $this->data_footer;
		$array_newsticker = $this->data_newsticker;
		$data = array("sitemap"=>$array_sitemap, "footer"=>$array_footer, "newsticker"=>$array_newsticker);
		return $data;
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
	
	public function news($id_news_category=NULL, $id_news_tag=NULL)
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
			$total_row =  $this->news_m->get_count($id_news_category, $id_news_tag);
			$url = base_url() . "frontend/news/" . $id_news_category . "/" . $id_news_tag . "?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$news = $this->news_m->get_list($limit, $offset, $id_news_category, $id_news_tag);
			
			foreach( $news as $row )
			{
				$id_news_category = $row->id_news_category;
				$id_news = $row->id_news;
				$row->category = $this->news_m->get_category(array("id_news_category"=>$id_news_category));
				$row->tags = $this->news_m->get_detail_tags($id_news);
			}
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$category = $this->news_m->get_category();
			$tag = $this->news_m->get_tags();

			
			$data["news"] = $news;
			$data["category"] = $category;
			$data["tag"] = $tag;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/news-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function news_detail($id_news=NULL)
	{
		try
		{
			
			$this->load->model("news_m");
			
			$news = $this->news_m->get_detail($id_news);
			$category = $this->news_m->get_category();
			$tag = $this->news_m->get_tags();
			$detail_tag = $this->news_m->get_detail_tags($id_news);
						
			$data["news"] = $news;
			$data["category"] = $category;
			$data["tag"] = $tag;
			$data["detail_tag"] = $detail_tag;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/news-detail.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function announcement()
	{
		try
		{
			
			$this->load->model("announcement_m");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 10;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->announcement_m->get_count();
			$url = base_url() . "frontend/announcement/?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$announcement = $this->announcement_m->get_list($limit, $offset);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$data["announcement"] = $announcement;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/announcement-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function announcement_detail($id_announcement=NULL)
	{
		try
		{
			
			$this->load->model("announcement_m");
			
			$announcement = $this->announcement_m->get_detail($id_announcement);
						
			$data["announcement"] = $announcement;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/announcement-detail.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function video()
	{
		try
		{
			
			$this->load->model("video_m");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 10;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->video_m->get_count();
			$url = base_url() . "frontend/video/?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$video = $this->video_m->get_list($limit, $offset);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$data["video"] = $video;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/video-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function video_detail($id_video=NULL)
	{
		try
		{
			
			$this->load->model("video_m");
			
			$video = $this->video_m->get_detail($id_video);
						
			$data["video"] = $video;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/video-detail.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function gallery()
	{
		try
		{
			
			$this->load->model("gallery_m");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 50;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->gallery_m->get_count();
			$url = base_url() . "frontend/gallery/?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$gallery = $this->gallery_m->get_list($limit, $offset);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$data["gallery"] = $gallery;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/gallery-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function gallery_detail($id_gallery=NULL)
	{
		try
		{
			
			$this->load->model("gallery_m");
			
			$gallery = $this->gallery_m->get_detail($id_gallery);
						
			$data["gallery"] = $gallery;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/gallery-detail.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function article()
	{
		try
		{
			
			$this->load->model("article_m");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 10;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->article_m->get_count();
			$url = base_url() . "frontend/article/?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$article = $this->article_m->get_list($limit, $offset);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$data["article"] = $article;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/article-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function article_detail($id_article=NULL)
	{
		try
		{
			
			$this->load->model("article_m");
			
			$article = $this->article_m->get_detail($id_article);
						
			$data["article"] = $article;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/article-detail.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function agenda()
	{
		try
		{
			
			$this->load->model("agenda_m");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 10;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->agenda_m->get_count();
			$url = base_url() . "frontend/agenda/?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$agenda = $this->agenda_m->get_list($limit, $offset);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$data["agenda"] = $agenda;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/agenda-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function agenda_detail($id_agenda=NULL)
	{
		try
		{
			
			$this->load->model("agenda_m");
			
			$agenda = $this->agenda_m->get_detail($id_agenda);
						
			$data["agenda"] = $agenda;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/agenda-detail.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function procurement()
	{
		try
		{
			
			$this->load->model("procurement_m");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 10;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->procurement_m->get_count();
			$url = base_url() . "frontend/procurement/?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$procurement = $this->procurement_m->get_list($limit, $offset);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$data["procurement"] = $procurement;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/procurement-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function procurement_detail($id_procurement=NULL)
	{
		try
		{
			
			$this->load->model("procurement_m");
			
			$procurement = $this->procurement_m->get_detail($id_procurement);
						
			$data["procurement"] = $procurement;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/procurement-detail.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function pers_release()
	{
		try
		{
			
			$this->load->model("pers_release_m");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 10;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->pers_release_m->get_count();
			$url = base_url() . "frontend/pers_release/?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$pers_release = $this->pers_release_m->get_list($limit, $offset);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$data["pers_release"] = $pers_release;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/pers_release-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function pers_release_detail($id_pers_release=NULL)
	{
		try
		{
			
			$this->load->model("pers_release_m");
			
			$pers_release = $this->pers_release_m->get_detail($id_pers_release);
						
			$data["pers_release"] = $pers_release;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/pers_release-detail.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function publication($name=NULL, $publication_year=NULL)
	{
		try
		{
			
			$this->load->model("publication_m");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 10;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->publication_m->get_count($name, $publication_year);
			$url = base_url() . "frontend/publication/" . $name . "/" . $publication_year . "?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$publication = $this->publication_m->get_list($limit, $offset, $name, $publication_year);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$category = $this->publication_m->get_category();
			$category_name = $this->publication_m->get_category(array("name"=>$name));
			$publication_year = $this->publication_m->get_publication_year($name);
			
			$data["publication"] = $publication;
			$data["publication_year"] = $publication_year;
			$data["category"] = $category;
			$data["category_name"] = isset($category_name)?$category_name:"";
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/publication-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function laws($id_laws_category=NULL)
	{
		try
		{
			
			$this->load->model("laws_m");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 10;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->laws_m->get_count($id_laws_category);
			$url = base_url() . "frontend/laws/" . $id_laws_category . "?paging=true";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$laws = $this->laws_m->get_list($limit, $offset, $id_laws_category);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$category_name = $this->laws_m->get_category(array("id_laws_category"=>$id_laws_category));
			
			$data["laws"] = $laws;
			$data["category_name"] = isset($category_name)?$category_name:"";
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/laws-list.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function constitution()
	{
		$this->laws(1);
	}
	
	public function regulation()
	{
		$this->laws(2);
	}
	
	public function polling_result()
	{
		try
		{	
			$this->load->model("polling_m");
		
			$polling = $this->polling_m->get_category();
			foreach( $polling as $row )
			{
				$id_polling_category = $row->id_polling_category;
				$option = $this->polling_m->get_list(array("id_polling_category"=>$id_polling_category));
				$row->option = $option;
				foreach( $row->option as $r )
				{
					$id_polling = $r->id_polling;
					$result = $this->polling_m->get_result($id_polling);
					$r->result = $result;
				}
			}			
			$data["polling"] = $polling;		
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/polling-result.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function vote_process()
	{
		$this->load->model("polling_m");
		
		$id_polling = $this->input->post("id_polling");
		$d = $this->session->all_userdata();
		$data = array(
			"session_id"=>$d["session_id"],
			"ip_address"=>$d["ip_address"],
			"user_agent"=>$d["user_agent"],
			"id_polling"=>$id_polling
		);
		if( !empty($id_polling) )
			$result = $this->polling_m->insert_vote($data);		
		
		redirect( "frontend/polling_result" );
	}
	
	public function searching_process()
	{
		try
		{
			$this->load->model("global_m");
			$query = $this->input->get("query");
			
			$page = $this->input->get("page");
			$page = !empty($page)?$page:1;
			$limit = 10;
			
			if(isset($page) and !empty($page)):
				$offset = ($page * $limit) - $limit;
			else:
				$offset = 0;
			endif;
			
			// Paging
			$total_row =  $this->global_m->get_search_result_count($query);
			$url = base_url() . "frontend/searching_process/?paging=true&query=" . $query . "";
			$data_paging = array(
				"url"=>$url,
				"total_rows"=>$total_row,
				"per_page"=>$limit,
				"halaman"=>$page
			);
			
			$search = $this->global_m->get_search_result($limit, $offset, $query);
			
			//print_r($search);
			
			$data["paging"] = $this->paging($data_paging);
			$data["page"] = $page;
			
			$data["search"] = $search;
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/search-result.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
		
	}
	
	public function contact_us()
	{
		try
		{	
			$this->load->model("static_content_m");
			$where = array("static_content"=>"contact_us");
			$r = $this->static_content_m->display($where);
			
			
			$data["contact_us"] = $r;
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/contact-us.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function contact_us_process()
	{
		try
		{	
			$this->load->model("global_m");
			$sess = $this->session->userdata("lang");
			
			$name = $this->input->post("name");
			$email = $this->input->post("email");
			$subject = $this->input->post("subject");
			$message = $this->input->post("message");
			
			$ct_captcha = $this->input->post("ct_captcha");
			
			if( empty($name) or empty($email) or empty($subject) or empty($message) )
			{
				echo "Form not Complete. Action denied."; exit;
			}
			
			if(!$this->securimages_lib->check_captha($ct_captcha) or empty($ct_captcha))
			{
				echo "Access Denied. Do not Try to do this action."; exit;
			}
			//exit;
			$data = array(
				"name"=>$name,
				"email"=>$email,
				"subject"=>$subject,
				"message"=>$message
			);
			
			$resul = $this->global_m->insert_contact_us($data);
			if( $resul )
			{
				if( $sess == "id" )
				{
					$m = '
						<div class="col-md-12 bg-primary">
							<b>Berhasil</b> Pesan anda akan dibalas secepatnya.
						</div>
					';
				}
				else
				{
					$m = '
						<div class="col-md-12 bg-warning">
							<b>Success</b> Your message will be Replied soon.
						</div>
					';
				}
			}
			else
			{
				if( $sess == "id" )
				{
					$m = '
						<div class="col-md-12 bg-primary">
							<b>Gagal</b> Silahkan kirim email ke kyri@komisiyudisial.go.id
						</div>
					';
				}
				else
				{
					$m = '
						<div class="col-md-12 bg-warning">
							<b>Failed</b> Please send email to kyri@komisiyudisial.go.id
						</div>
					';
				}
			}
			
			$this->session->set_flashdata('message', $m);
			
			redirect("frontend/contact_us");
				
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
	public function slider_detail($id_slider=NULL)
	{
		try
		{
			
			$this->load->model("slider_m");
			
			$slider = $this->slider_m->get_detail($id_slider);
						
			$data["slider"] = $slider;
			
			/* Wajib */
			$data["sitemap"] = $this->get_sitemap();
			$data["content"] = "frontend/pages/slider-detail.view.php";
			$this->load->view('frontend/index', $data);
			/* Wajib */
		} catch(Exception $e){
			echo "Terjadi Kesalahan. Hubungi Administrator";
		}
	}
	
}