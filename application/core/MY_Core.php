<?php
class MY_Core extends CI_Controler {
	
	public function paging($pag=array())
	{
		$ci = get_instance();
		
		$config['base_url'] = $pag["url"];
		$config['total_rows'] = $pag["total_rows"];
		$config['per_page'] = $pag["per_page"]; 
		$config['page_query_string'] = false;
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
		
		$ci->pagination->initialize($config); 
		return $ci->pagination->create_links();
	}
}