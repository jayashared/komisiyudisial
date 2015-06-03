<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Securimages extends CI_Controller {
	
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function securimages_show()
	{
		$this->securimages_lib->securimages_show();
	}
	
	public function securimages_play()
	{
		$this->securimages_lib->securimages_play();
	}
	
	// The form processor PHP code
	function check_captha()
	{
		$ct_captcha = $this->input->get("ct_captcha");
		if($this->securimages_lib->check_captha($ct_captcha))
		{
			echo "true";
		}
		else
		{
			echo "false";
		}
	}
	
}