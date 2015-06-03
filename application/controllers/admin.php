<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	var $data = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$timezone = @date_default_timezone_get();
        if (!isset($timezone) || $timezone == '') {
            $timezone = @ini_get('date.timezone');
        }
        if (!isset($timezone) || $timezone == '') {
            $timezone = 'UTC';
        }
        date_default_timezone_set($timezone); 
		
		$member_in = $this->_is_member_in();

		if( empty($member_in) )
		{
			$message = '<div class="alert alert-danger" role="alert"><strong>Peringatan!</strong> Akses ditolak </div>';
			$this->session->set_flashdata('pesan', $message);
			redirect("login");
		}
		
		$sitemap = $this->data_sitemap();
		$data = array(
			"sitemap"=>$sitemap
		);
		
		$this->data = $data;
	}
	
	public function _is_member_in()
	{
		return $this->session->userdata("log_in");
	}
	
	function get_change_by_callback($post_array) {
		$member_in = $this->_is_member_in();
		
		$post_array['modified_by'] = $member_in["id_user"];
		return $post_array;
	}
	
	public function format_date_callback($date)
	{
		
		if(!empty($date))
		{
			$arr_date_time = explode(" ", $date);
			$arr_date = explode("-", $arr_date_time[0]);
			$time = isset($arr_date_time[1])?$arr_date_time[1]:"";
			$date = $arr_date[2] . "/" . $arr_date[1] . "/" . $arr_date[0] . " " . $time; 
		}
		else
		{
			$date = "";
		}
		return $date;
	}
	
	public function data_sitemap()
	{
		$this->load->model("sitemap_m");
		$sitemap = $this->sitemap_m->get_admin_sitemap(array("sitemap_level"=>"2"));
		foreach( $sitemap as $row )
		{
			$id_parent = $row->id_sitemap;
			$where = array("id_parent"=>$id_parent, "sitemap_level"=>"3");
			$row->sub_sitemap = $this->sitemap_m->get_admin_sitemap($where);
		}
		return $sitemap;
	}
	
	public function get_sitemap()
	{
		return $this->data;
	}

	public function index()
	{
		$this->news();
	}
	
	public function news()
	{	
		
		try{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_news');
			$crud->set_subject('Berita');
			
			$crud->set_relation('modified_by','tbl_user','email');
			$crud->set_relation('id_news_category','tbl_news_category','news_category_id');
			
			$crud->set_relation_n_n('tag', 'tbl_news_tag_trans', 'tbl_news_tag', 'id_news', 'id_news_tag','news_tag_id');
			
			$crud->set_field_upload('picture','assets/uploads/picture');
			
			$crud->required_fields('date', 'title_id', 'title_en', 'text_id', 'text_en');
			
			$crud->add_fields('date', 'id_news_category', 'title_id', 'title_en', 'text_id', 'text_en', 'picture', 'picture_caption_id', 'picture_caption_en','tag', 'modified_by', 'modified_date');
			$crud->edit_fields('date', 'id_news_category', 'title_id', 'title_en', 'text_id', 'text_en', 'picture', 'picture_caption_id', 'picture_caption_en','tag', 'modified_by', 'modified_date');
			
			$crud->display_as('date','Tanggal')
				 ->display_as('title_id','Judul (Indonesia)')
				 ->display_as('title_en','Judul (English)')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('picture','Gambar (jpg, png)')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ->display_as('id_news_category', 'Kategori')
				 ->display_as('tag', ' Tag ')
				 
				 ;
			$crud->columns('id_news_category', 'title_id', 'title_en', 'text_id', 'text_en');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_news','desc');
			$crud->unset_read();
			
			$sitemap = $this->get_sitemap();
			
			$output = $crud->render($sitemap);
			$this->load->view('admin/themes/default', $output);

		} catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function news_category()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_news_category');
			$crud->set_subject('News Category');
			
			$crud->set_relation('modified_by','tbl_user','email');

			$crud->required_fields('news_category_id', 'news_category_en');
			
			$crud->add_fields('news_category_id', 'news_category_en', 'modified_by', 'modified_date');
			$crud->edit_fields('news_category_id', 'news_category_en', 'modified_by', 'modified_date');
			$crud->columns('news_category_id', 'news_category_en', 'modified_by');
			
			$crud->display_as('news_category_id', 'Kategori (Bahasa)')
				 ->display_as('news_category_en', 'Kategori (English)')
				 ->display_as('modified_by', 'Input / Edit Tanggal')
				 ;

			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			$crud->unset_read();
			$crud->order_by('id_news_category','desc');
			
			$news_category = $this->get_sitemap();
			
			$output = $crud->render($news_category);
			
			$this->load->view('admin/themes/default', $output);
		}catch(Exception $e)
		{
			show_error($e-getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function news_tag()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_news_tag');
			$crud->set_subject('News Tag');
			
			$crud->set_relation('modified_by','tbl_user','email');

			$crud->required_fields('news_tag_id', 'news_tag_en');
			
			$crud->add_fields('news_tag_id', 'news_tag_en', 'modified_by', 'modified_date');
			$crud->edit_fields('news_tag_id', 'news_tag_en', 'modified_by', 'modified_date');
			$crud->columns('news_tag_id', 'news_tag_en', 'modified_by');
			
			$crud->display_as('news_tag_id', 'Tag (Bahasa)')
				 ->display_as('news_tag_en', 'Tag (English)')
				 ->display_as('modified_by', 'Input / Edit Tanggal')
				 ;

			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			$crud->unset_read();
			$crud->order_by('id_news_tag','desc');
			
			$news_tag = $this->get_sitemap();
			
			$output = $crud->render($news_tag);
			
			$this->load->view('admin/themes/default', $output);
		}catch(Exception $e)
		{
			show_error($e-getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function announcement()
	{
		try{
			
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_announcement');
			$crud->set_subject('Pengumuman');
			
			$crud->set_relation('modified_by','tbl_user','email');
			
			$crud->set_field_upload('file','assets/uploads/files');
			
			$crud->required_fields('title_id', 'title_en', 'expired_date');
			
			$crud->add_fields('expired_date', 'title_id', 'title_en', 'text_id', 'text_en', 'file', 'modified_by', 'modified_date');
			$crud->edit_fields('expired_date', 'title_id', 'title_en', 'text_id', 'text_en', 'file', 'modified_by', 'modified_date');
			$crud->columns('expired_date', 'title_id', 'text_id', 'modified_by');
			
			$crud->display_as('title_id', 'Judul (Bahasa)')
				 ->display_as('title_en', 'Judul (English)')
				 ->display_as('text_id', 'Isi (Bahasa)')
				 ->display_as('text_en', 'Isi (English)')
				 ->display_as('file', 'Berkas')
				 ->display_as('expired_date', 'Tanggal Kadarluarsa')
				 ->display_as('modified_by', 'Input / Edit Tanggal')
				 ;

			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			$crud->unset_read();
			$crud->order_by('id_announcement','desc');
			
			$sitemap = $this->get_sitemap();
			
			$output = $crud->render($sitemap);
			
			$this->load->view('admin/themes/default', $output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function konten_statis()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('tbl_konten_statis');
			$crud->set_subject('Konten Statis');
			$crud->set_field_upload('gambar','assets/uploads/gambar');
			$crud->required_fields('judul', 'deskripsi');
			$crud->fields('judul', 'deskripsi', 'gambar');
			$crud->columns('judul', 'deskripsi');
			//$crud->change_field_type('judul', 'readonly');
			$crud->order_by('id_konten_statis','desc');
			$output = $crud->render();
			$this->load->view('admin/themes/default', $output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function agenda()
	{
		try{
			
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_agenda');
			$crud->set_subject('Agenda');
			
			$crud->set_relation('modified_by','tbl_user','email');

			$crud->required_fields('title_id', 'title_en');
			
			$crud->add_fields('title_id', 'title_en', 'text_id', 'text_en', 'address_id', 'address_en', 'time_id', 'time_en', 'contact_person', 'modified_by', 'modified_date');
			$crud->edit_fields('title_id', 'title_en', 'text_id', 'text_en', 'address_id', 'address_en', 'time_id', 'time_en', 'contact_person', 'modified_by', 'modified_date');
			$crud->columns('expired_date', 'title_id', 'text_id', 'modified_by');
			
			$crud->display_as('title_id', 'Judul (Bahasa)')
				 ->display_as('title_en', 'Judul (English)')
				 ->display_as('text_id', 'Isi (Bahasa)')
				 ->display_as('text_en', 'Isi (English)')
				 ->display_as('address_id', 'Alamat (Bahasa)')
				 ->display_as('address_en', 'Alamat (English)')
				 ->display_as('time_id', 'Waktu (Bahasa)')
				 ->display_as('time_en', 'Waktu (English)')
				 ->display_as('contact_person', 'Kontak')
				 ->display_as('modified_by', 'Input / Edit Tanggal')
				 ;

			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			$crud->unset_read();
			$crud->order_by('id_agenda','desc');
			
			$sitemap = $this->get_sitemap();
			
			$output = $crud->render($sitemap);
			
			$this->load->view('admin/themes/default', $output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function link()
	{
		try{
			
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_link');
			$crud->set_subject('Link');
			
			$crud->set_relation('modified_by', 'tbl_user', 'email');

			$crud->required_fields('title_id', 'title_en');
			
			$crud->add_fields('title_id', 'title_en', 'text_id', 'text_en', 'url', 'modified_by', 'modified_date');
			$crud->edit_fields('title_id', 'title_en', 'text_id', 'text_en', 'url', 'modified_by', 'modified_date');
			$crud->columns('title_id', 'title_en', 'modified_by');
			
			$crud->display_as('title_id', 'Judul (Bahasa)')
				 ->display_as('title_en', 'Judul (English)')
				 ->display_as('text_id', 'Isi (Bahasa)')
				 ->display_as('text_en', 'Isi (English)')
				 ->display_as('modified_by', 'Input / Edit Tanggal')
				 ;

			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			$crud->unset_read();
			$crud->order_by('id_link','desc');
			
			$sitemap = $this->get_sitemap();
			
			$output = $crud->render($sitemap);
			
			$this->load->view('admin/themes/default', $output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function sitemap()
	{
		try{
			
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_sitemap');
			$crud->set_subject('Sitemap');
			
			$state = $crud->getState();
			
			$crud->set_relation('modified_by', 'tbl_user', 'email');
			
			if($state == 'edit' or $state == 'add')
			{
				$crud->set_relation('id_parent','tbl_sitemap','description');
			}
			
			$crud->required_fields('name', 'description', 'title_id', 'title_en', 'url');
			$crud->unique_fields('sitemap_code','name');
			
			$crud->add_fields('id_parent', 'sitemap_code', 'name', 'description', 'title_id', 'title_en', 'url', 'sort_no', 'modified_by', 'modified_date');
			$crud->edit_fields('id_parent', 'sitemap_code', 'name', 'description', 'title_id', 'title_en', 'url', 'sort_no', 'modified_by', 'modified_date');
			$crud->columns('sitemap_code', 'title_id', 'url', 'modified_by');
			
			$crud->display_as('title_id', 'Judul (Bahasa)')
				 ->display_as('title_en', 'Judul (English)')
				 ->display_as('description', 'Deskripsi')
				 ->display_as('sitemap_code', 'Kode Sitemap')
				 ->display_as('sort_no', 'No Urut')
				 ->display_as('name', 'Nama')
				 ->display_as('modified_by', 'Input / Edit Tanggal')
				 ;

			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			$crud->unset_read();
			if($crud->state = "list")
			$crud->order_by('sitemap_code','asc');
			
			$sitemap = $this->get_sitemap();
			
			$output = $crud->render($sitemap);
			
			$this->load->view('admin/themes/default', $output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function video()
	{
		try{
		
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_video');
			$crud->set_subject('Video');
			
			$state = $crud->getState();
			
			$crud->set_relation('modified_by', 'tbl_user', 'email');
			
			//if($state == 'edit' or $state == 'add')
			//{
			//	$crud->set_relation('title_id','tbl_video','embed');
			//}
			
			$crud->required_fields('title_id', 'title_en', 'embed');
			$crud->unique_fields('title_id','embed');
			
			$crud->add_fields('title_id', 'title_en', 'text_id', 'text_en', 'embed', 'modified_by', 'modified_date');
			$crud->edit_fields('title_id', 'title_en', 'text_id', 'text_en', 'embed', 'modified_by', 'modified_date');
			$crud->columns('title_id', 'text_id', 'modified_by');
			
			$crud->display_as('title_id', 'Judul (Bahasa)')
				 ->display_as('title_en', 'Judul (English)')
				 ->display_as('text_id', 'Isi (Bahasa)')
				 ->display_as('text_en', 'Isi (English')
				 ->display_as('Embed', 'Link')
				 ->display_as('modified_by', 'Input / Edit Tanggal')
				 ;
				 
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			$crud->unset_read();
			if($crud->state = "list")
			$crud->order_by('id_video','desc');
			
			$video = $this->get_sitemap();
			
			$output = $crud->render($video);
			
			$this->load->view('admin/themes/default', $output);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function artikel()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_article');
			$crud->set_subject('Artikel');
			$crud->set_relation('modified_by','tbl_user','email');
			$crud->set_field_upload('file','assets/uploads/files');
			
			$crud->required_fields('title_id', 'title_en', 'text_id', 'text_en');
			
			$crud->add_fields('title_id', 'title_en', 'text_id', 'text_en', 'file', 'modified_by', 'modified_date');
			$crud->edit_fields('title_id', 'title_en', 'text_id', 'text_en', 'file', 'modified_by', 'modified_date');
			$crud->display_as('title_id','Judul (Indonesia)')
				 ->display_as('title_en','Judul (English)')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('file','Berkas')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('title_id', 'title_en', 'text_id', 'text_en','modified_by');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_article','desc');
			$crud->unset_read();
			
			$artikel = $this->get_sitemap();
			
			$output = $crud->render($artikel);
			$this->load->view('admin/themes/default', $output);

		}catch(Execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function KategoriHukum()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_laws_category');
			$crud->set_subject('Kategori Hukum');
			$crud->set_relation('modified_by','tbl_user','email');
			
			$crud->required_fields('laws_category_id');
			
			$crud->add_fields('laws_category_id', 'laws_category_en', 'modified_by', 'modified_date');
			$crud->edit_fields('laws_category_id', 'laws_category_en', 'modified_by', 'modified_date');
			$crud->display_as('laws_category_id','Kategori Hukum (Indonesia)')
				 ->display_as('laws_category_en','Kategori Hukum (English)')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('laws_category_id', 'laws_category_en','modified_by');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_laws_category','desc');
			$crud->unset_read();
			
			$kategori = $this->get_sitemap();
			
			$output = $crud->render($kategori);
			$this->load->view('admin/themes/default', $output);

			
		}catch(Execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	public function Hukum()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_laws');
			$crud->set_subject('Hukum');
			
			$state = $crud->getState();
			
			$crud->set_relation('modified_by', 'tbl_user', 'email');
			
			//if($state == 'edit' or $state == 'add')
			//{
				$crud->set_relation('id_laws_category','tbl_laws_category','laws_category_id');
			//}
			
			$crud->required_fields('laws_id', 'laws_en');
			
			$crud->set_field_upload('files','assets/uploads/files');
			
			$crud->add_fields('id_laws_category', 'laws_id', 'laws_en', 'files',  'modified_by', 'modified_date');
			$crud->edit_fields('id_laws_category', 'laws_id', 'laws_en', 'files',  'modified_by', 'modified_date');
			$crud->columns('id_laws_category', 'laws_id', 'laws_en', 'modified_by');
			
			
			
			$crud->display_as('laws_id', 'Judul (Bahasa)')
				 ->display_as('laws_en', 'Judul (English)')
				 ->display_as('files','Berkas')
				 ->display_as('id_laws_category', 'Kategori')
				 ->display_as('modified_by', 'Input / Edit Tanggal')
				 ;
				 
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			$crud->unset_read();
			if($crud->state = "list")
			$crud->order_by('id_laws','desc');
			
			$hukum = $this->get_sitemap();
			
			$output = $crud->render($hukum);
			$this->load->view('admin/themes/default', $output);
		}catch(Execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	
	public function Publikasi()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_publication');
			$crud->set_subject('Publikasi');
			
			$state = $crud->getState();
			
			$crud->set_relation('modified_by', 'tbl_user', 'email');
			
			$crud->set_relation('id_publication_category','tbl_publication_category','title_id');
				
			
			$crud->set_field_upload('cover','assets/uploads/picture');			
			$crud->set_field_upload('file','assets/uploads/files');
			
			$crud->required_fields('id_publication_category', 'publication_date', 'expired_date', 'title_id','title_en');
			
			$crud->add_fields('id_publication_category', 'title_id', 'title_en', 'text_id', 'text_en', 'cover', 'file', 'publication_date', 'expired_date', 'modified_by', 'modified_date');
			$crud->edit_fields('id_publication_category', 'title_id', 'title_en', 'text_id', 'text_en', 'cover', 'file', 'publication_date', 'expired_date',  'modified_by', 'modified_date');
			$crud->columns('id_publication_category','publication_date', 'title_id', 'title_en', 'modified_by');
			
			$crud->display_as('publication_date', 'Tanggal Publikasi')
				 ->display_as('title_id', 'Judul (Bahasa)')
				 ->display_as('title_en', 'Judul (English)')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('cover', 'Cover')
				 ->display_as('file', 'Berkas')
				 ->display_as('expired_date', 'Tanggal Kadarluarsa')
				 ->display_as('id_publication_category', 'Kategori')
				 ->display_as('modified_by', 'Input / Edit')
				 ;
				 
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			$crud->unset_read();
			if($crud->state = "list")
			$crud->order_by('id_publication','desc');
			
			$publikasi = $this->get_sitemap();
			
			$output = $crud->render($publikasi);
			
			$this->load->view('admin/themes/default', $output);
		}catch(Execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function lelang()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_procurement');
			$crud->set_subject('Lelang');
			$crud->set_relation('midified_by','tbl_user','email');
			
			$crud->set_field_upload('file','assets/uploads/files');
			
			$crud->required_fields('title_id','title_en');
			
			$crud->add_fields('title_id', 'title_en', 'text_id', 'text_en', 'file', 'midified_by', 'modified_date');
			$crud->edit_fields('title_id', 'title_en', 'text_id', 'text_en', 'file', 'midified_by', 'modified_date');
			
			$crud->display_as('title_id','Judul (Indonesia)')
				 ->display_as('title_en','Judul (English)')
				 ->display_as('midified_by', 'Input / Edit oleh')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('file','Berkas')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('title_id', 'title_en','modified_by');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('midified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_procurement','desc');
			$crud->unset_read();
			
			$lelang = $this->get_sitemap();
			
			$output = $crud->render($lelang);
			$this->load->view('admin/themes/default', $output);

		}catch(Execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function KontenStatis()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_static_content');
			$crud->set_subject('Konten Statis');
			$crud->set_relation('modified_by','tbl_user','email');
			
			$crud->required_fields('title_id','title_en');
			
			$crud->add_fields('static_content', 'title_id', 'title_en', 'text_id', 'text_en', 'modified_by', 'modified_date');
			$crud->edit_fields('static_content', 'title_id', 'title_en', 'text_id', 'text_en', 'modified_by', 'modified_date');
			
			$crud->display_as('static_content','Konten Statis')
				 ->display_as('title_id','Judul (Indonesia)')
				 ->display_as('title_en','Judul (English)')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('static_content', 'title_id', 'title_en','modified_by');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_static_content','desc');
			$crud->unset_read();
			
			$kontenstatis = $this->get_sitemap();
			
			$output = $crud->render($kontenstatis);
			$this->load->view('admin/themes/default', $output);
		}catch(execption $e)
		{
			show_error($e->getMessage().''.$e->getTraceAsString());
		}
		
	}
	
	public function PersRelease()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_pers_release');
			$crud->set_subject('Pers Release');
			$crud->set_relation('modified_by','tbl_user','email');
			
			$crud->set_field_upload('file','assets/uploads/files');
			
			$crud->required_fields('title_id','title_en');
			
			$crud->add_fields('title_id', 'title_en', 'text_id', 'text_en', 'file', 'modified_by', 'modified_date');
			$crud->edit_fields('title_id', 'title_en', 'text_id', 'text_en', 'file', 'modified_by', 'modified_date');
			
			$crud->display_as('title_id','Judul (Indonesia)')
				 ->display_as('title_en','Judul (English)')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('file','Berkas')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('title_id', 'title_en', 'modified_by');
			
			$crud->callback_before_update(array($this, 'get_change_by_callback'));
			$crud->callback_before_insert(array($this, 'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_pers_release','desc');
			$crud->unset_read();
			
			$persrelease = $this->get_sitemap();
			
			$output = $crud->render($persrelease);
			$this->load->view('admin/themes/default', $output);
			
		}catch(execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function slider()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_slider');
			$crud->set_subject('Slider');
			$crud->set_relation('modified_by','tbl_user','email');
			
			$crud->required_fields('picture', 'title_id','title_en');
			
			$crud->set_field_upload('picture', 'assets/uploads/picture');
			
			$crud->add_fields('picture', 'title_id', 'title_en', 'text_id', 'text_en', 'modified_by', 'modified_date');
			$crud->edit_fields('picture', 'title_id', 'title_en', 'text_id', 'text_en', 'modified_by', 'modified_date');
			
			$crud->display_as('title_id','Judul (Indonesia)')
				 ->display_as('title_en','Judul (English)')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('title_id', 'title_en','modified_by');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_slider','desc');
			$crud->unset_read();
			
			$slider = $this->get_sitemap();
			
			$output = $crud->render($slider);
			$this->load->view('admin/themes/default', $output);
			
		}catch(execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function informationsystem()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_information_system');
			$crud->set_subject('Information System');
			$crud->set_relation('modified_by','tbl_user','email');
			
			$crud->required_fields('title_id','title_en','url');
			
			$crud->add_fields('title_id', 'title_en', 'text_id', 'text_en', 'url', 'modified_by', 'modified_date');
			$crud->edit_fields('title_id', 'title_en', 'text_id', 'text_en', 'url', 'modified_by', 'modified_date');
			
			$crud->display_as('title_id','Judul (Indonesia)')
				 ->display_as('title_en','Judul (English)')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('url','Link')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('title_id', 'title_en', 'url', 'modified_by');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_information_system','desc');
			$crud->unset_read();
			
			$informationsystem = $this->get_sitemap();
			
			$output = $crud->render($informationsystem);
			$this->load->view('admin/themes/default', $output);
		}catch(execption $e)
		{	
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function CategoryPolling()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_polling_category');
			$crud->set_subject('Polling Category');
			$crud->set_relation('modified_by','tbl_user','email');
			
			$crud->required_fields('cateory_id','cateory_en','is_active');
			
			$crud->add_fields('cateory_id', 'cateory_en', 'is_active', 'modified_by', 'modified_date');
			$crud->edit_fields('cateory_id', 'cateory_en', 'is_active', 'modified_by', 'modified_date');
			
			$crud->display_as('cateory_id','Kategori (Indonesia)')
				 ->display_as('cateory_en','Kategori (English)')
				 ->display_as('is_active','Is Active')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('cateory_id', 'cateory_en', 'is_active', 'modified_by');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_polling_category','desc');
			$crud->unset_read();
			
			$kategoryPolling = $this->get_sitemap();
			
			$output = $crud->render($kategoryPolling);
			$this->load->view('admin/themes/default', $output);
			
		}catch(execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function polling()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_polling');
			$crud->set_subject('Polling');
			
			$crud->set_relation('modified_by','tbl_user','email');			
			
			$crud->required_fields('id_polling_category','polling_id','polling_en');
			
			
			$state = $crud->getState();
						
			//if($state == 'edit' or $state == 'add')
			//{
				$crud->set_relation('id_polling_category','tbl_polling_category','cateory_id',array('is_active' => 'Y'));
			//}
			
			$crud->add_fields('id_polling_category','polling_id','polling_en', 'modified_by', 'modified_date');
			$crud->edit_fields('id_polling_category','polling_id','polling_en', 'modified_by', 'modified_date');
			
			$crud->display_as('id_polling_category','Kategori')
				 ->display_as('polling_id','Polling (Indonesia)')
				 ->display_as('polling_en','Polling (English)')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('id_polling_category','polling_id', 'polling_en', 'modified_by');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_polling_category','desc');
			$crud->unset_read();
			
			$kategoryPolling = $this->get_sitemap();
			
			$output = $crud->render($kategoryPolling);
			$this->load->view('admin/themes/default', $output);
			
		}catch(execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function ResultPolling()
	{
		try
		{
			
		}catch(execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	public function Gallery()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_gallery');
			$crud->set_subject('Gallery');
			$crud->set_relation('modified_by','tbl_user','email');
			
			$crud->required_fields('picture', 'title_id','title_en');
			
			$crud->set_field_upload('picture', 'assets/uploads/picture');
			
			$crud->add_fields('picture', 'title_id', 'title_en','text_id', 'text_en', 'modified_by', 'midified_date');
			$crud->edit_fields('picture', 'title_id', 'title_en','text_id', 'text_en', 'modified_by', 'midified_date');
			
			$crud->display_as('picture','Gambar')
				 ->display_as('title_id','Judul (Bahasa)')
				 ->display_as('title_en','Judul (English')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('midified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('title_id', 'title_en', 'is_active', 'modified_by');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('midified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('midified_date','readonly');
			
			$crud->order_by('id_gallery','desc');
			$crud->unset_read();
			
			$gallery = $this->get_sitemap();
			
			$output = $crud->render($gallery);
			$this->load->view('admin/themes/default', $output);
		}catch(execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function encrypt_password($post_array) {
		//$this->load->library('encrypt');
		
		$password=$post_array['password'];
		
		//Encrypt password only if is not empty. Else don't change the password to an empty field
		if(!empty($password))
		{
			//$key = '03121986';
			//$post_array['password'] = $this->encrypt->encode($password, $key);
		
			$post_array['password']=hash('sha256', $password);
		}
		else
		{
			unset($post_array['password']);
		}
	 
	  //return $this->db->update('tbl_user',$post_array,array('id_user' => $primary_key));
	    return $post_array;
	}
 
	function set_password_input_to_empty() {
		return "<input type='password' name='password' value='' />";
	}
	
	
	public function user()
	{
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_user');
			$crud->set_subject('Pengguna');
						
			$crud->required_fields('username','email','password');
			
			$crud->change_field_type('password','password');
			
			$crud->add_fields('username','email','password');
			$crud->edit_fields('username','email','password');
			
			$crud->display_as('username','Username')
				 ->display_as('email','Email')
				 ;
			$crud->columns('username', 'email');
			
			$crud->callback_edit_field('password',array($this,'set_password_input_to_empty'));
			$crud->callback_add_field('password',array($this,'set_password_input_to_empty'));
		 
			$crud->callback_before_insert(array($this,'encrypt_password'));
			$crud->callback_before_update(array($this,'encrypt_password'));
			
			$crud->order_by('id_user','desc');
			$crud->unset_read();
			
			$user = $this->get_sitemap();
			
			$output = $crud->render($user);
			$this->load->view('admin/themes/default', $output);
			
		}catch(execption $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function ganti_password()
	{
		try{
			$konten = "admin/pages/ganti-password-form.view.php";
			$data["konten"] = $konten;
			//print_r($this->get_sitemap());
			$data["sitemap"] = $this->get_sitemap();
			$this->load->view("admin/themes/default2.php", $data);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function get_user_login() {
		$member_in = $this->_is_member_in();
		return $member_in["id_user"];
	}
	
	public function check_password_lama()
	{
		try{
			$this->load->model("user_m");
			$password = $this->input->post("password_lama");
			$id_user = $this->get_user_login();
			
			$where = array(
				"id_user"=>$id_user,
				"password"=>hash('sha256', $password)
			);
			
			if($this->user_m->check_password_exist($where))
			{
				echo "true";
			}
			else
			{
				echo "false";
			}
		}catch(Exception $e){
			echo "false";
		}
	}
	
	public function ganti_password_proses()
	{
		try{
			$this->load->model("user_m");
			
			
			$password = $this->input->post("password");
			$id_user = $this->get_user_login();
			
			$data = array("password"=>hash('sha256', $password));
			$where = array("id_user"=>$id_user);
			
			$result = $this->user_m->update_user($data, $where);
			
			if( $result )
			{
				$pesan = "<b>Berhasil!</b> Proses pendaftaran berhasil. Silahkan menunggu proses verifikasi 
						oleh Administrator kami paling lambat 7 x 24 Jam";
				$this->session->set_flashdata('pesan', $this->get_alert("success", $pesan));
			}
			else
			{
				$pesan = "<b>Gagal!</b> Proses pendaftaran gagal. Silahkan mencoba kembali atau hubungi Administrator kami";
				$this->session->set_flashdata('pesan', $this->get_alert("fail"));
			}
			
			redirect("admin/ganti_password");
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function get_alert($info)
	{
		if( $info == "success" )
		return '<div class="alert alert-success" role="alert"><b>Berhasil!</b> Data telah tersimpan</div>';
		else
		return '<div class="alert alert-danger" role="alert"><b>Gagal!</b> Data tidak tersimpan</div>';
	}
	
}