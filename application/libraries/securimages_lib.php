<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/securimage/securimage.php';

class Securimages_lib {
	public function securimages_show()
	{
		
		$img = new Securimage();

	// You can customize the image by making changes below, some examples are included - remove the "//" to uncomment
	
	//$img->ttf_file        = './Quiff.ttf';
	//$img->captcha_type    = Securimage::SI_CAPTCHA_MATHEMATIC; // show a simple math problem instead of text
	//$img->case_sensitive  = true;                              // true to use case sensitve codes - not recommended
	//$img->image_height    = 90;                                // height in pixels of the image
	//$img->image_width     = $img->image_height * M_E;          // a good formula for image size based on the height
	//$img->perturbation    = .75;                               // 1.0 = high distortion, higher numbers = more distortion
	//$img->image_bg_color  = new Securimage_Color("#0099CC");   // image background color
	//$img->text_color      = new Securimage_Color("#EAEAEA");   // captcha text color
	//$img->num_lines       = 8;                                 // how many lines to draw over the image
	//$img->line_color      = new Securimage_Color("#0000CC");   // color of lines over the image
	//$img->image_type      = SI_IMAGE_JPEG;                     // render as a jpeg image
	//$img->signature_color = new Securimage_Color(rand(0, 64),
	//                                             rand(64, 128),
	//                                             rand(128, 255));  // random signature color
	
	// see securimage.php for more options that can be set
	
	// set namespace if supplied to script via HTTP GET
	if (!empty($_GET['namespace'])) $img->setNamespace($_GET['namespace']);
	
	
	$img->show();  // outputs the image and content headers to the browser
	// alternate use:
	// $img->show('/path/to/background_image.jpg');

	}
	
	public function securimages_play()
	{
		$options = array(
			'use_database'    => true,
			'database_name'   => '',
			'database_user'   => '',
			'database_driver' => Securimage::SI_DRIVER_MYSQL
		);
		
		$img = new Securimage();
		
		// Other audio settings
		//$img->audio_use_sox   = true;
		//$img->audio_use_noise = true;
		//$img->degrade_audio   = false;
		//$img->sox_binary_path = 'sox';
		
		// To use an alternate language, uncomment the following and download the files from phpcaptcha.org
		// $img->audio_path = $img->securimage_path . '/audio/es/';
		
		// If you have more than one captcha on a page, one must use a custom namespace
		// $img->namespace = 'form2';
		
		// set namespace if supplied to script via HTTP GET
		if (!empty($_GET['namespace'])) $img->setNamespace($_GET['namespace']);
		
		return $img->outputAudioFile();
	}
	
	function check_captha($captcha="")
	{
		$securimage = new Securimage();
		if ($securimage->check($captcha) == false) {
			return false;
		}
		else
		{
			return true;
		}
	}

}