<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_m');
	}
	
	public function index()
	{
		$this->load->view("login/default.php");
	}
	
	public function proses()
	{
		$email = $this->input->post("email");
		$password = $this->input->post("password");

		$where = array(
			"email"=>$email,
			"password"=>hash('sha256', $password)
		);
		
		$result = $this->user_m->select($where);

		if( $result ):				
			$sess_array = array(
				 'id_user' => $result[0]->id_user,
				 'email' => $result[0]->email,
				 'user_kategori'=>$result[0]->user_kategori,
				 'is_logged' => true
			);
		
			$this->session->set_userdata('log_in', $sess_array);
			redirect("admin/news");
		else:
			$message = '<div class="alert alert-danger" role="alert"><strong>Gagal!</strong> Email dan Password Tidak sesuai</div>';
			$this->session->set_flashdata('pesan', $message);
			redirect("login");
		endif;
	}
	
	public function logout()
	{
		$this->session->unset_userdata('log_in');
		redirect("login", 'refresh');
	}
	
}