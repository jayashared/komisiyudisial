<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend extends CI_Controller {

    var $data = array();
    var $data_footer = array();
    var $data_newsticker = array();

    public function __construct() {
        parent::__construct();

        $sitemap = $this->data_sitemap();
        $sitemap_footer = $this->data_sitemap_footer();

        $data = $sitemap;
        $this->data = $data;
        $this->data_footer = $sitemap_footer;
        $this->data_newsticker = $this->data_newsticker();


        // Session For Language
        $def_lang = $this->session->userdata('lang');
        if (empty($def_lang))
            $this->session->set_userdata('lang', 'id');
    }

    public function set_lang($lang = "ID") {
        $curl = $this->input->get("curl");
        $this->session->set_userdata('lang', strtolower($lang));
        redirect($curl);
    }

    public function index() {
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
        foreach ($polling as $row) {
            $id_polling_category = $row->id_polling_category;
            $row->option = $this->polling_m->get_list(array("id_polling_category" => $id_polling_category));
        }

        $data["news"] = $this->news_m->get_latest_news(10);
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

    public function data_sitemap() {
        $this->load->model("sitemap_m");
        $sitemap = $this->sitemap_m->get_frontend_sitemap(array("sitemap_level" => "2"));
        foreach ($sitemap as $row) {
            $id_parent = $row->id_sitemap;
            $where = array("id_parent" => $id_parent, "sitemap_level" => "3");
            $row->sub_sitemap = $this->sitemap_m->get_frontend_sitemap($where);
        }
        return $sitemap;
    }

    public function data_sitemap_footer() {
        $this->load->model("sitemap_m");
        $sitemap = $this->sitemap_m->get_frontend_footer_sitemap(array("sitemap_level" => "2"));
        foreach ($sitemap as $row) {
            $id_parent = $row->id_sitemap;
            $where = array("id_parent" => $id_parent, "sitemap_level" => "3");
            $row->sub_sitemap = $this->sitemap_m->get_frontend_footer_sitemap($where);
        }
        return $sitemap;
    }

    public function data_newsticker() {
        $this->load->model("global_m");

        $data = $this->global_m->get_newsticker_list();
        return $data;
    }

    public function get_sitemap() {
        $array_sitemap = $this->data;
        $array_footer = $this->data_footer;
        $array_newsticker = $this->data_newsticker;
        $data = array("sitemap" => $array_sitemap, "footer" => $array_footer, "newsticker" => $array_newsticker);
        return $data;
    }

    public function paging($pag = array()) {
        $config['base_url'] = $pag["url"];
        $config['total_rows'] = $pag["total_rows"];
        $config['per_page'] = $pag["per_page"];
        $config['page_query_string'] = false;
        $config['use_page_numbers'] = true;
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
        $config["uri_segment"] = $pag["uri_segment"];
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function static_content($static_content = NULL, $parent = NULL) {
        $sess = $this->session->userdata("lang");
        $this->load->model("static_content_m");
        $this->load->model("sitemap_m");

        $submenu = $this->sitemap_m->get_detail(array("name" => $parent));
        foreach ($submenu as $row) {
            $id_parent = $row->id_sitemap;
            $row->sub = $this->sitemap_m->get_detail(array("id_parent" => $id_parent));
        }


        $where = array("static_content" => $static_content);
        $static_content = $this->static_content_m->display($where);

        $data["static_content"] = $static_content;
        $data["submenu"] = $submenu;
        /* Wajib */
        $title = $sess == "id" ? $static_content[0]->title_id : $static_content[0]->title_en;
        $data["title"] = $title;
        $data["sitemap"] = $this->get_sitemap();
        $data["content"] = "frontend/pages/static-content.view.php";
        $this->load->view('frontend/index', $data);
        /* Wajib */
    }

    public function news($id_news_category = 0, $id_news_tag = 0) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("news_m");

            $page = $this->uri->segment(5);
            $page = !empty($page) ? $page : 1;
            $limit = 10;

            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;

            // Paging
            $total_row = $this->news_m->get_count($id_news_category, $id_news_tag);
            $url = base_url() . "frontend/news/" . $id_news_category . "/" . $id_news_tag;
            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 5
            );

            $news = $this->news_m->get_list($limit, $offset, $id_news_category, $id_news_tag);

            foreach ($news as $row) {
                $id_news_category = $row->id_news_category;
                $id_news = $row->id_news;
                $row->category = $this->news_m->get_category(array("id_news_category" => $id_news_category));
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
            $title = $sess == "id" ? "Berita" : "News";
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/news-list.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function news_detail($id_news = NULL) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("news_m");

            $news = $this->news_m->get_detail($id_news);
            $category = $this->news_m->get_category();
            $tag = $this->news_m->get_tags();
            $detail_tag = $this->news_m->get_detail_tags($id_news);
            $linked = $this->news_m->linked_news($id_news);
            //print_r($news); 
            /* update count */
            $count = $news[0]->COUNT;
            $update = $this->news_m->update(array("count" => $count + 1), array("id_news" => $id_news));
            //echo $update . "asd" . $id_news; exit;	
            /* end update count */

            $data["news"] = $news;
            $data["category"] = $category;
            $data["tag"] = $tag;
            $data["detail_tag"] = $detail_tag;
            $data["linked"] = $linked;

            /* Wajib */
            $title = $sess == "id" ? $news[0]->title_id : $news[0]->title_en;
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/news-detail.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function announcement() {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("announcement_m");

            $page = $this->uri->segment(3);
            $page = !empty($page) ? $page : 1;
            $limit = 10;

            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;

            // Paging
            $total_row = $this->announcement_m->get_count();
            $url = base_url() . "frontend/announcement";
            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 3
            );

            $announcement = $this->announcement_m->get_list($limit, $offset);

            $data["paging"] = $this->paging($data_paging);
            $data["page"] = $page;

            $data["announcement"] = $announcement;

            /* Wajib */
            $title = $sess == "id" ? "Pengumuman" : "Announcement";
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/announcement-list.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function announcement_detail($id_announcement = NULL) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("announcement_m");

            $announcement = $this->announcement_m->get_detail($id_announcement);

            $data["announcement"] = $announcement;

            /* Wajib */
            $title = $sess == "id" ? $announcement[0]->title_id : $announcement[0]->title_en;
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/announcement-detail.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function video() {
        try {

            $this->load->model("video_m");

            $page = $this->uri->segment(3);
            $page = !empty($page) ? $page : 1;
            $limit = 10;

            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;

            // Paging
            $total_row = $this->video_m->get_count();
            $url = base_url() . "frontend/video";
            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 3
            );

            $video = $this->video_m->get_list($limit, $offset);

            $data["paging"] = $this->paging($data_paging);
            $data["page"] = $page;

            $data["video"] = $video;

            /* Wajib */
            $data["title"] = "Video";
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/video-list.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function video_detail($id_video = NULL) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("video_m");

            $video = $this->video_m->get_detail($id_video);

            $data["video"] = $video;

            /* Wajib */
            $title = $sess == "id" ? $video[0]->title_id : $video[0]->title_en;
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/video-detail.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function gallery($id_gallery_category = NULL) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("gallery_m");

            $page = $this->uri->segment(3);
            $page = !empty($page) ? $page : 1;
            $limit = 50;

            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;

            $where = array(
                "id_gallery_category" => $id_gallery_category
            );

            // Paging
            $total_row = $this->gallery_m->get_count($where);
            $url = base_url() . "frontend/gallery";
            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 3
            );

            $gallery = $this->gallery_m->get_list($limit, $offset, $where);

            $data["paging"] = $this->paging($data_paging);
            $data["page"] = $page;

            $data["gallery"] = $gallery;

            /* Wajib */
            $title = $sess == "id" ? "Gallery" : "Gallery";
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/gallery-list.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function gallery_category($id_gallery = NULL) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("gallery_m");

            $gallery = $this->gallery_m->gallery_category();

            $data["gallery"] = $gallery;

            /* Wajib */
            $title = $sess == "id" ? "Gallery" : "Gallery";
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/gallery-category.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function gallery_detail($id_gallery = NULL) {
        try {

            $this->load->model("gallery_m");

            $gallery = $this->gallery_m->get_detail($id_gallery);

            $data["gallery"] = $gallery;

            /* Wajib */
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/gallery-detail.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function article() {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("article_m");

            $page = $this->uri->segment(3);
            $page = !empty($page) ? $page : 1;
            $limit = 10;

            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;

            // Paging
            $total_row = $this->article_m->get_count();
            $url = base_url() . "frontend/article";
            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 3
            );

            $article = $this->article_m->get_list($limit, $offset);

            $data["paging"] = $this->paging($data_paging);
            $data["page"] = $page;

            $data["article"] = $article;

            /* Wajib */
            $title = $sess == "id" ? "Artikel" : "Article";
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/article-list.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function article_detail($id_article = NULL) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("article_m");

            $article = $this->article_m->get_detail($id_article);

            $data["article"] = $article;

            /* Wajib */
            $title = $sess == "id" ? $article[0]->title_id : $article[0]->title_en;
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/article-detail.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function agenda() {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("agenda_m");

            $page = $this->uri->segment(3);
            $page = !empty($page) ? $page : 1;
            $limit = 10;

            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;

            // Paging
            $total_row = $this->agenda_m->get_count();
            $url = base_url() . "frontend/agenda";
            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 3
            );

            $agenda = $this->agenda_m->get_list($limit, $offset);

            $data["paging"] = $this->paging($data_paging);
            $data["page"] = $page;

            $data["agenda"] = $agenda;

            /* Wajib */
            $title = $sess == "id" ? "Agenda" : "Agenda";
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/agenda-list.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function agenda_detail($id_agenda = NULL) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("agenda_m");

            $agenda = $this->agenda_m->get_detail($id_agenda);

            $data["agenda"] = $agenda;

            /* Wajib */
            $title = $sess == "id" ? $agenda[0]->title_id : $agenda[0]->title_en;
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/agenda-detail.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function procurement() {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("procurement_m");

            $page = $this->uri->segment(3);
            $page = !empty($page) ? $page : 1;
            $limit = 10;

            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;

            // Paging
            $total_row = $this->procurement_m->get_count();
            $url = base_url() . "frontend/procurement";
            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 3
            );

            $procurement = $this->procurement_m->get_list($limit, $offset);

            $data["paging"] = $this->paging($data_paging);
            $data["page"] = $page;

            $data["procurement"] = $procurement;

            /* Wajib */
            $title = $sess == "id" ? "Informasi Lelang" : "Procurement";
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/procurement-list.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function procurement_detail($id_procurement = NULL) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("procurement_m");

            $procurement = $this->procurement_m->get_detail($id_procurement);

            $data["procurement"] = $procurement;

            /* Wajib */
            $title = $sess == "id" ? $procurement[0]->title_id : $procurement[0]->title_en;
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/procurement-detail.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function pers_release() {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("pers_release_m");

            $page = $this->uri->segment(3);
            $page = !empty($page) ? $page : 1;
            $limit = 10;

            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;

            // Paging
            $total_row = $this->pers_release_m->get_count();
            $url = base_url() . "frontend/pers_release";
            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 3
            );

            $pers_release = $this->pers_release_m->get_list($limit, $offset);

            $data["paging"] = $this->paging($data_paging);
            $data["page"] = $page;

            $data["pers_release"] = $pers_release;

            /* Wajib */
            $title = $sess == "id" ? "Siaran Pers" : "Pers Release";
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/pers_release-list.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function pers_release_detail($id_pers_release = NULL) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("pers_release_m");

            $pers_release = $this->pers_release_m->get_detail($id_pers_release);

            $data["pers_release"] = $pers_release;

            /* Wajib */
            $title = $sess == "id" ? $pers_release[0]->title_id : $pers_release[0]->title_en;
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/pers_release-detail.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function publication($name = 0, $publication_year = 0) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("publication_m");

            $page = $this->uri->segment(5);
            $page = !empty($page) ? $page : 1;
            $limit = 10;

            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;

            // Paging
            $total_row = $this->publication_m->get_count($name, $publication_year);
            $url = base_url() . "frontend/publication/" . $name . "/" . $publication_year;
            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 5
            );

            $publication = $this->publication_m->get_list($limit, $offset, $name, $publication_year);

            $data["paging"] = $this->paging($data_paging);
            $data["page"] = $page;

            $category = $this->publication_m->get_category();
            $category_name = $this->publication_m->get_category(array("name" => $name));
            $publication_year = $this->publication_m->get_publication_year($name);
            //print_r($category_name);
            $data["publication"] = $publication;
            $data["publication_year"] = $publication_year;
            $data["category"] = $category;
            $data["category_name"] = isset($category_name) ? $category_name : "";
            /* Wajib */
            $title = $sess == "id" ? $category_name[0]->title_id : $category_name[0]->title_en;
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/publication-list.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function publication_detail($id_publication = NULL) {
        try {
            $this->load->model("publication_m");

            $publication = $this->publication_m->get_detail($id_publication);
            //print_r($publication);exit;
            $data["publication"] = $publication;
            /* Wajib */
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/publication-detail.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function laws($id_laws_category = NULL) {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("laws_m");

            $page = $this->uri->segment(4);
            $page = !empty($page) ? $page : 1;
            $limit = 10;

            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;

            // Paging
            $total_row = $this->laws_m->get_count($id_laws_category);
            $url = base_url() . "frontend/laws/" . $id_laws_category;
            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 4
            );

            $laws = $this->laws_m->get_list($limit, $offset, $id_laws_category);

            $data["paging"] = $this->paging($data_paging);
            $data["page"] = $page;

            $category_name = $this->laws_m->get_category(array("id_laws_category" => $id_laws_category));
            //print_r($category_name);
            $data["laws"] = $laws;
            $data["category_name"] = isset($category_name) ? $category_name : "";
            /* Wajib */
            $title = $sess == "id" ? $category_name[0]->laws_category_id : $category_name[0]->laws_category_en;
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/laws-list.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function constitution() {
        $this->laws(1);
    }

    public function regulation() {
        $this->laws(2);
    }

    public function polling_result() {
        try {
            $this->load->model("polling_m");
            $id_polling_category = "";
            $polling = $this->polling_m->get_category();
            foreach ($polling as $row) {
                $id_polling_category = $row->id_polling_category;
                $option = $this->polling_m->get_list(array("id_polling_category" => $id_polling_category));
                $row->option = $option;
                foreach ($row->option as $r) {
                    $id_polling = $r->id_polling;
                    $result = $this->polling_m->get_result($id_polling);
                    $r->result = isset($result[0]->total_semua) ? $result[0]->total_semua : 0;
                    $r->jumlah = isset($result[0]->jumlah) ? $result[0]->jumlah : 0;
                }
            }
            $data["total_polling"] = $this->polling_m->get_polling_total_per_kategori($id_polling_category);
            $data["polling"] = $polling;
            /* Wajib */
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/polling-result.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    // ss
    public function vote_process() {
        $this->load->model("polling_m");

        $id_polling = $this->input->post("id_polling");
        $d = $this->session->all_userdata();

        $computerid = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_PORT'] . $_SERVER['REMOTE_ADDR'];

        $dc = $this->polling_m->get_data_by_id($id_polling);
        $id_polling_category = $dc[0]->id_polling_category;

        $c = $this->polling_m->check_polling_result($computerid, $id_polling_category);

        $data = array(
            "session_id" => $d["session_id"],
            "ip_address" => $d["ip_address"],
            "user_agent" => $d["user_agent"],
            "id_polling" => $id_polling,
            "computerid" => $computerid
        );


        if (!empty($id_polling) and ! $c) {
            $result = $this->polling_m->insert_vote($data);
            $m = array('alert-success', "Terima Kasih Telah melakukan Polling.");
        } else {
            $m = array('alert-danger', "Anda telah melakukan Polling untuk Kategori ini.");
        }

        $this->session->set_flashdata('message', $m);
        redirect("frontend/polling_result");
    }

    public function searching_process() {
        try {
            $this->load->model("global_m");
            $query = $this->input->post("query");

            if ( !empty($query) )
            {
                $this->session->unset_userdata('query');
                // use the term from POST and set it to session
                $query = $this->input->post('query');
                
                $this->session->set_userdata('query', $query);
            }
            elseif ($this->session->userdata('query'))
            {
                // if term is not in POST use existing term from session
                $query = $this->session->userdata('query');
            }
            
            $page = $this->uri->segment(3);
            $page = !empty($page) ? $page : 1;
            $limit = 10;
            
            if (isset($page) and ! empty($page)):
                $offset = ($page * $limit) - $limit;
            else:
                $offset = 0;
            endif;
            //echo $query;
            // Paging
            $total_row = $this->global_m->get_search_result_count($query);
            $url = base_url() . "frontend/searching_process/";

            $data_paging = array(
                "url" => $url,
                "total_rows" => $total_row,
                "per_page" => $limit,
                "halaman" => $page,
                "uri_segment" => 3
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
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function contact_us() {
        try {
            $sess = $this->session->userdata("lang");
            $this->load->model("static_content_m");
            $where = array("static_content" => "contact_us");
            $r = $this->static_content_m->display($where);


            $data["contact_us"] = $r;
            /* Wajib */
            $title = $sess == "id" ? "Kontak Kami" : "Contact Us";
            $data["title"] = $title;
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/contact-us.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    function contact_us_send_email($email) {
        $this->load->library('email');
        $this->load->model('global_m');
        $this->load->model('email_m');

        $dc = $this->email_m->get_config();
        $r = isset($dc[0]) ? $dc[0] : "";

        $config = $this->get_email_config();

        if (!empty($config))
            $this->email->initialize($config);

        if (isset($email) and ! empty($email)) {
            $this->email->from($r->smtp_user, $r->name);
            $this->email->to($email);
            $this->email->subject('Komisi Yudisial');
            $message = "Terima Kasih telah menghubungi Komisi Yudisial. Permintaan anda akan kami proses paling lambat 7x24 Jam.";
            $this->email->message($message);

            if ($this->email->send()) {
                return true;
            } else {
                //echo $this->email->print_debugger();
                return false;
            }
        }
    }

    public function contact_us_process() {
        try {
            $this->load->model("global_m");
            $sess = $this->session->userdata("lang");

            $name = $this->input->post("name");
            $email = $this->input->post("email");
            $subject = $this->input->post("subject");
            $message = $this->input->post("message");

            $ct_captcha = $this->input->post("ct_captcha");

            $computerid = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_PORT'] . $_SERVER['REMOTE_ADDR'];

            $c = $this->global_m->check_contact_us_computerid($computerid);

            if ($c) {
                log_message('Perhatian', 'Anda hanya boleh menghubungi kami satu kali dalam satu hari. Terima Kasih.');
                show_error("Anda hanya boleh menghubungi kami satu kali dalam satu hari. Terima Kasih.");
            }

            //$e = $this->contact_us_send_email($email);

            /* if( !$e ){
              show_error("Your email invalid: ".$email." . Please Try Again.");
              } */

            if (empty($name) or empty($email) or empty($subject) or empty($message)) {
                show_error("Form not Complete. Action denied.");
            }

            if ($this->securimages_lib->check_captha($ct_captcha) or ! empty($ct_captcha)) {
                //echo "true";
            } else {
                show_error("Access Denied for " . $computerid . ". Do not Try to do this action.");
            }
            //exit;
            $data = array(
                "name" => $name,
                "email" => $email,
                "subject" => $subject,
                "message" => $message,
                "computerid" => $computerid
            );

            $resul = $this->global_m->insert_contact_us($data);
            if ($resul) {
                if ($sess == "id") {
                    $m = '
						<div class="col-md-12 bg-primary">
							<b>Berhasil</b> Pesan anda akan dibalas secepatnya.
						</div>
					';
                } else {
                    $m = '
						<div class="col-md-12 bg-warning">
							<b>Success</b> Your message will be Replied soon.
						</div>
					';
                }
            } else {
                if ($sess == "id") {
                    $m = '
						<div class="col-md-12 bg-primary">
							<b>Gagal</b> Silahkan kirim email ke kyri@komisiyudisial.go.id
						</div>
					';
                } else {
                    $m = '
						<div class="col-md-12 bg-warning">
							<b>Failed</b> Please send email to kyri@komisiyudisial.go.id
						</div>
					';
                }
            }

            $this->session->set_flashdata('message', $m);

            redirect("frontend/contact_us");
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function slider_detail($id_slider = NULL) {
        try {

            $this->load->model("slider_m");

            $slider = $this->slider_m->get_detail($id_slider);

            $data["slider"] = $slider;

            /* Wajib */
            $data["sitemap"] = $this->get_sitemap();
            $data["content"] = "frontend/pages/slider-detail.view.php";
            $this->load->view('frontend/index', $data);
            /* Wajib */
        } catch (Exception $e) {
            echo "Terjadi Kesalahan. Hubungi Administrator";
        }
    }

    public function get_email_config() {
        $this->load->library('email');
        $this->load->model("email_m");
        // Kirim Email
        // Configuration

        $dc = $this->email_m->get_config();
        $r = isset($dc[0]) ? $dc[0] : "";

        $config = array();

        if (isset($r->protocol) and ! empty($r->protocol))
            $config['protocol'] = $r->protocol;
        if (isset($r->mailpath) and ! empty($r->mailpath))
            $config['mailpath'] = $r->mailpath;
        if (isset($r->smtp_crypto) and ! empty($r->smtp_crypto))
            $config['smtp_crypto'] = $r->smtp_crypto;
        if (isset($r->charset) and ! empty($r->charset))
            $config['charset'] = $r->charset;
        if (isset($r->wordwrap) and ! empty($r->wordwrap))
            $config['wordwrap'] = strtoupper($r->wordwrap) == "TRUE" ? TRUE : FALSE;
        if (isset($r->useragent) and ! empty($r->useragent))
            $config['useragent'] = $r->useragent;
        if (isset($r->smtp_host) and ! empty($r->smtp_host))
            $config['smtp_host'] = $r->smtp_host;
        if (isset($r->smtp_user) and ! empty($r->smtp_user))
            $config['smtp_user'] = $r->smtp_user;
        if (isset($r->smtp_pass) and ! empty($r->smtp_pass))
            $config['smtp_pass'] = $r->smtp_pass;
        if (isset($r->smtp_port) and ! empty($r->smtp_port))
            $config['smtp_port'] = 465;
        if (isset($r->smtp_timeout) and ! empty($r->smtp_timeout))
            $config['smtp_timeout'] = $r->smtp_timeout;
        if (isset($r->wrapchars) and ! empty($r->wrapchars))
            $config['wrapchars'] = $r->wrapchars;
        if (isset($r->mailtype) and ! empty($r->mailtype))
            $config['mailtype'] = $r->mailtype;
        if (isset($r->validate) and ! empty($r->validate))
            $config['validate'] = strtoupper($r->wordwrap) == "TRUE" ? TRUE : FALSE;
        if (isset($r->priority) and ! empty($r->priority))
            $config['priority'] = $r->priority;
        if (isset($r->crlf) and ! empty($r->crlf))
            $config['crlf'] = "\r\n";
        if (isset($r->newline) and ! empty($r->newline))
            $config['newline'] = "\r\n";
        if (isset($r->bcc_batch_mode) and ! empty($r->bcc_batch_mode))
            $config['bcc_batch_mode'] = strtoupper($r->bcc_batch_mode) == "TRUE" ? TRUE : FALSE;
        if (isset($r->bcc_batch_size) and ! empty($r->bcc_batch_size))
            $config['bcc_batch_size'] = $r->bcc_batch_size;

        return $config;
    }

}
