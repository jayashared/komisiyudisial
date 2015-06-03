<script src="<?php echo base_url() ?>assets/grocery_crud/js/jquery_plugins/jquery-validation/dist/jquery.validate.js"></script>
<style>
	.form-control { margin-bottom:10px !important; border-radius:0px; box-shadow:none; }
</style>
<?php
	$sess = $this->session->userdata("lang");
	$contact_us = isset($contact_us[0])?$contact_us[0]:"";
	$contact_us = $sess=="id"?$contact_us->text_id:$contact_us->text_id;
?>

<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title"><?php echo $sess=="id"?"Kontak Kami":"Contact Us"; ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog blog-post col-sm-11 col-xs-11 col-md-11">
		<article class="post">
		  <div class="entry-content">
          		
                <?php echo $contact_us; ?>
                
                <hr />
                
                <?php 
					$pesan = $this->session->flashdata('message');
					echo isset($pesan)?$pesan:"";
				?>
                
                <p>
            	<span class="text-danger">
                	<?php echo $sess=="id"?"Hubungi kami secara online dengan mengisi form dibawah ini:":"Contact us online by filling out the form below:"; ?>
                </span>
            	</p>
                
                <form class="form-horizontal" id="contact_us_form" method="post" action="<?php echo base_url() ?>frontend/contact_us_process">
                  <div class="form-group">
                    <label for="name" class="col-md-2"><?php echo $sess=="id"?"Nama":"Name"; ?></label>
                    <div class="col-md-10">
                      <input type="text" class="form-control required" id="name" name="name" placeholder="<?php echo $sess=="id"?"Nama":"Name"; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-md-2"><?php echo $sess=="id"?"Surel":"Email"; ?></label>
                    <div class="col-md-10">
                      <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $sess=="id"?"Surel":"Email"; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-md-2"><?php echo $sess=="id"?"Subjek":"Subject"; ?></label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" id="subject" name="subject" placeholder="<?php echo $sess=="id"?"Subjek":"Subject"; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-md-2"><?php echo $sess=="id"?"Pesan":"Message"; ?></label>
                    <div class="col-md-10">
                      <textarea name="message" class="form-control"></textarea>
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="col-md-2"><?php echo $sess=="id"?"Kode":"Code"; ?></label>
                    <div class="col-md-10 com-sm-10">
                        
                        <img id="siimage" class="img-thumbnail" 
                            src="<?php echo base_url() ?>securimages/securimages_show?sid=<?php echo md5(uniqid()) ?>" 
                            alt="CAPTCHA Image" align="left" 
                        />
                       
                        &nbsp;
                        <a tabindex="-1" style="border-style: none;" href="#" 
                            title="Refresh Image" 
                            onclick="document.getElementById('siimage').src = 
                        '<?php echo base_url() ?>securimages/securimages_show?sid=' + Math.random(); this.blur(); return false"
                        >
                            <img 
                                src="<?php echo base_url() ?>assets/securimage/images/refresh.png" 
                                alt="Reload Image" title="Refresh Captha" height="32" width="32" onclick="this.blur()" align="bottom" border="0" 
                            />
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-3">
                        <input type="text" name="ct_captcha" class="form-control required" placeholder="<?php echo $sess=="id"?"Inputkan Kode diatas":"Input the Code Above"; ?>" size="12" maxlength="8" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-md-10">
                      <button type="submit" class="btn btn-default"><?php echo $sess=="id"?"Kirim":"Send"; ?></button>
                    </div>
                </div>
                </form>
            
            
		  </div>
		</article><!-- .post -->
		
      </div><!-- .content -->
	  
    </div>
  </div><!-- .container -->
</section><!-- #main -->

<script>
	var form1 = $('#contact_us_form');

	form1.validate({
		onkeyup: false,
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		ignore: "",
		rules: {
			ct_captcha: {
			  required: true,
			  remote: "<?php echo base_url() ?>securimages/check_captha"
			},
			email: {
				required: true,
				email: true
			},
			name: {
				required: true
			},
			subject: {
				required: true
			},
		},
		
		messages: {
			/*id_wilayah: {
				required: "Wilayah harus diisi."
			},
			nip: {
				required: "NIP harus diisi.",
				maxlength: "NIP harus terdiri dari 18 karakter.",
			  	minlength: "NIP harus terdiri dari 18 karakter.",
				remote: "NIP sudah terdaftar sebelumnya."
			},
			no_sk_jabfung: {
				required: "No. SK Jabfung harus diisi."
			},
			email: {
				required: "Email harus diisi.",
				remote: "Email sudah terdaftar sebelumnya."
			},
			password: {
				required: "Password harus diisi.",
				minlength: "Password minimal terdiri dari 5 karakter."
			},
			repassword: {
				required: "Konfirmasi Password harus diisi.",
				minlength: "Password minimal terdiri dari 5 karakter.",
				equalTo: "Password tidak sama."
			},
			ct_captcha: {
				required: "Kode harus diisi.",
				remote: "Kode tidak sesuai."
			}*/
			
		},

		invalidHandler: function (event, validator) { //display error alert on form submit
		},

		highlight: function (element) { // hightlight error inputs
			$(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},

		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},

		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},

		submitHandler: function (form) {
			form.submit();
		}
	});
	
</script>