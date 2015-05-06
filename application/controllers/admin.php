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
			$crud->set_field_upload('picture','assets/uploads/picture');
			
			$crud->required_fields('date', 'title_id', 'title_en', 'text_id', 'text_en');
			
			$crud->add_fields('date', 'title_id', 'title_en', 'text_id', 'text_en', 'picture', 'modified_by', 'modified_date');
			$crud->edit_fields('date', 'title_id', 'title_en', 'text_id', 'text_en', 'picture', 'modified_by', 'modified_date');
			$crud->display_as('date','Tanggal')
				 ->display_as('title_id','Judul (Indonesia)')
				 ->display_as('title_en','Judul (English)')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('picture','Gambar (jpg, png)')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('title_id', 'title_en', 'text_id', 'text_en');
			
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
			$crud->columns('expired_date', 'title_id', 'text_id', 'modified_by');
			
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
			
			$crud->add_fields('id_parent', 'sitemap_code', 'name', 'description', 'title_id', 'title_en', 'url', 'css_class', 'css_id', 'icon', 'sort_no', 'modified_by', 'modified_date');
			$crud->edit_fields('id_parent', 'sitemap_code', 'name', 'description', 'title_id', 'title_en', 'url', 'css_class', 'css_id', 'icon', 'sort_no', 'modified_by', 'modified_date');
			$crud->columns('sitemap_code', 'title_id', 'text_id', 'modified_by');
			
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
			$crud->columns('title_id', 'text_id', 'embed', 'modified_by');
			
			$crud->display_as('title_id', 'Judul (Bahasa)')
				 ->display_as('title_en', 'Judul (English)')
				 ->display_as('text_id', 'Deskripsi (Bahasa)')
				 ->display_as('text_en', 'Deskripsi (English')
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
			//	$crud->set_relation('laws_id','tbl_laws','embed');
			//}
			
			$crud->required_fields('laws_id', 'laws_en');
			
			$crud->add_fields('laws_id', 'laws_en', 'modified_by', 'modified_date');
			$crud->edit_fields('laws_id', 'laws_en', 'modified_by', 'modified_date');
			$crud->columns('laws_id', 'laws_en', 'modified_by');
			
			$crud->display_as('laws_id', 'Judul (Bahasa)')
				 ->display_as('laws_en', 'Judul (English)')
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
			
			$crud->set_relation('midified_by', 'tbl_user', 'email');
			
			//if($state == 'edit' or $state == 'add')
			//{
			//	$crud->set_relation('laws_id','tbl_laws','embed');
			//}
			
			
			$crud->set_field_upload('cover','assets/uploads/picture');			
			$crud->set_field_upload('file','assets/uploads/files');
			
			$crud->required_fields('publication_date', 'title_id','title_en');
			
			$crud->add_fields('publication_date', 'title_id', 'title_en', 'text_id', 'text_en', 'cover', 'file', 'midified_by', 'modified_date');
			$crud->edit_fields('publication_date', 'title_id', 'title_en', 'text_id', 'text_en', 'cover', 'file', 'midified_by', 'modified_date');
			$crud->columns('publication_date', 'title_id', 'title_en', 'midified_by');
			
			$crud->display_as('publication_date', 'Tanggal Publikasi')
				 ->display_as('title_id', 'Judul (Bahasa)')
				 ->display_as('title_en', 'Judul (English)')
				 ->display_as('midified_by', 'Input / Edit Tanggal')
				 ;
				 
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('midified_by','readonly');
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
			$crud->set_relation('midified_by','tbl_user','email');
			
			$crud->set_field_upload('file','assets/uploads/files');
			
			$crud->required_fields('title_id','title_en');
			
			$crud->add_fields('title_id', 'title_en', 'text_id', 'tent_en', 'file', 'midified_by', 'modified_date');
			$crud->edit_fields('title_id', 'title_en', 'text_id', 'tent_en', 'file', 'midified_by', 'modified_date');
			
			$crud->display_as('title_id','Judul (Indonesia)')
				 ->display_as('title_en','Judul (English)')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ;
			$crud->columns('title_id', 'title_en','modified_by');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('midified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_pers_release','desc');
			$crud->unset_read();
			
			$persrelease = $this->get_sitemap();
			
			$output = $crud->render($persrelease);
			$this->load->view('admin/themes/default', $output);
			
		}catch(execption $e)
		{
			show_error($e->getMessage().''.$e->getTraceAsString());
		}
	}
	
}