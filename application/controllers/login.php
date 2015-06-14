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
			redirect("admin");
		else:
			$message = '<div class="alert alert-danger" role="alert"><strong>Gagal!</strong> Email dan Password Tidak sesuai</div>';
			$this->session->set_flashdata('pesan', $message);
			redirect("login");
		endif;
	}
	
	public function lupa_password()
	{
		$this->load->view("login/forget-password-form.view.php");
	}
	
	public function get_email_config()
	{
		$this->load->library('email');
		$this->load->model("email_m");
		// Kirim Email
		// Configuration
		
		$dc = $this->email_m->get_config();
		$r = isset( $dc[0] )?$dc[0]:"";
		
		if( isset($r->protocol) and !empty($r->protocol))
			$config['protocol'] = $r->protocol;
		if( isset($r->mailpath) and !empty($r->mailpath))
			$config['mailpath'] = $r->mailpath;
		if( isset($r->charset) and !empty($r->charset))
			$config['charset'] = $r->charset;
		if( isset($r->wordwrap) and !empty($r->wordwrap))
			$config['wordwrap'] = strtoupper($r->wordwrap)=="TRUE"?TRUE:FALSE;
		if( isset($r->useragent) and !empty($r->useragent))
			$config['useragent'] = $r->useragent;
		if( isset($r->smtp_host) and !empty($r->smtp_host))	
			$config['smtp_host'] = $r->smtp_host;
		if( isset($r->smtp_user) and !empty($r->smtp_user))
			$config['smtp_user'] = $r->smtp_user;
		if( isset($r->smtp_pass) and !empty($r->smtp_pass))
			$config['smtp_pass'] = $r->smtp_pass;
		if( isset($r->smtp_port) and !empty($r->smtp_port))
			$config['smtp_port'] = 465;
		if( isset($r->smtp_timeout) and !empty($r->smtp_timeout))
			$config['smtp_timeout'] = $r->smtp_timeout;
		if( isset($r->wrapchars) and !empty($r->wrapchars))
			$config['wrapchars'] = $r->wrapchars;
		if( isset($r->mailtype) and !empty($r->mailtype))
			$config['mailtype'] = $r->mailtype;
		if( isset($r->validate) and !empty($r->validate))
			$config['validate'] = strtoupper($r->wordwrap)=="TRUE"?TRUE:FALSE;
		if( isset($r->priority) and !empty($r->priority))
			$config['priority'] = $r->priority;
		if( isset($r->crlf) and !empty($r->crlf))
			$config['crlf'] = "\r\n";
		if( isset($r->newline) and !empty($r->newline))
			$config['newline'] = "\r\n";
		if( isset($r->bcc_batch_mode) and !empty($r->bcc_batch_mode))
			$config['bcc_batch_mode'] = strtoupper($r->bcc_batch_mode)=="TRUE"?TRUE:FALSE;
		if( isset($r->bcc_batch_size) and !empty($r->bcc_batch_size))
			$config['bcc_batch_size'] = $r->bcc_batch_size;
			
		return $config;
	}
	
	public function lupa_password_proses()
	{
		$this->load->helper('string');
		$this->load->library('email');
		$this->load->model('email_m');
		$this->load->model('user_m');
		
		$email = $this->input->post("email");
		
		$where = array("email"=>$email);
		$r = $this->user_m->select($where);
		//print_r($r);
		if( $r )
		{
			$rand = random_string('alnum', 10);
			$password = hash('sha256', $rand);
			$dp = array("password"=>$password);
			
			$result = $this->user_m->update_user($dp, $where);
			
			if( $result )
			{
				$to = $email;
				$dc = $this->email_m->get_config();
				$r = isset( $dc[0] )?$dc[0]:"";
				$message =  $r->format_lupa_password;
				$message = str_replace('{password}', $rand, $message);
				
				$this->email->initialize( $this->get_email_config() );
				
				if( isset($to) and !empty($to) )
				{
					$this->email->from($r->smtp_user, $r->name);
					$this->email->to($to);
					$this->email->subject("Lupa Password");
					$this->email->message($message);
					
					if( $this->email->send() )
					{
						$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password telah dikirim. 
						Silahkan Login dan ganti Password anda sesuai yang anda inginkan.</div>');
					}
					else
					{
						$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password gagal dikirim</div>');
					}
				}
			}
		}
		
		
		redirect("login/lupa_password");
			
	}
	
	public function logout()
	{
		$this->session->unset_userdata('log_in');
		redirect("login", 'refresh');
	}
	
}