<script src="<?php echo base_url() ?>assets/grocery_crud/js/jquery_plugins/jquery-validation/dist/jquery.validate.js"></script>

<br>

<?php
	$pesan = $this->session->flashdata('pesan');
	echo !empty($pesan)?$pesan:"";
?>

<div class="col-md-6">
<div class="panel panel-default">
  <div class="panel-heading">Form Ganti Password</div>
  <div class="panel-body">
    <form id="form_ganti_password" method="post" action="<?php echo base_url() ?>admin/ganti_password_proses">
      <div class="form-group">
        <label for="exampleInputEmail1">Password Lama</label>
        <input type="password" class="form-control required" id="password_lama" name="password_lama" placeholder="Password Lama">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password Baru</label>
        <input type="password" class="form-control required" id="password" name="password" placeholder="Password Baru">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Ulangi Password Baru</label>
        <input type="password" class="form-control required" id="ulangi_password" name="ulangi_password" placeholder="Ulangi Password">
      </div>
      <div align="right">
      <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
</div>

<script>
	var form1 = $('#form_ganti_password');

	form1.validate({
		onkeyup: false,
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		ignore: "",
		rules: {
			password_lama: {
			  remote: {
					url: "<?php echo base_url() ?>admin/check_password_lama",
					type: "post",
					data: {
						nip: function() {
							return $( "#password_lama" ).val();
						}
					}
				}
			},

			password: {
				minlength: 5
			},
			ulangi_password: {
				minlength: 5,
				equalTo: "#password"
			},
		},
		
		messages: {
			password_lama: {
				required: "Password Lama harus diisi.",
				remote: "Password lama salah."
			},
			password: {
				required: "Password harus diisi.",
				minlength: "Password minimal terdiri dari 5 karakter."
			},
			ulangi_password: {
				required: "Konfirmasi Password harus diisi.",
				minlength: "Password minimal terdiri dari 5 karakter.",
				equalTo: "Password tidak sama."
			}
			
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