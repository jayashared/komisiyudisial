<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lupa Password</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assets/startbootstrap-sb-admin-2-1.0.5/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url() ?>assets/startbootstrap-sb-admin-2-1.0.5/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/startbootstrap-sb-admin-2-1.0.5/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>assets/startbootstrap-sb-admin-2-1.0.5/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-lock"></i> Lupa Password</h3>
                    </div>
                    <div class="panel-body">
                    	<?php
							$pesan = $this->session->flashdata('pesan');
                        	if( isset($pesan) and !empty($pesan) )
							{ 
								echo $this->session->flashdata('pesan'); 
							}
						?>
                        <form role="form" action="<?php echo base_url() ?>login/lupa_password_proses" method="post">
                            <fieldset>
                                <div class="form-group">
                                	<label>Masukkan alamat E-Mail anda</label>
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                	<div class="col-md-6"><button type="button" id="kembali_login" class="btn btn-lg btn-block btn-default">Kembali</button></div>
                                    <div class="col-md-6"><button type="submit" id="kirim_password" class="btn btn-lg btn-block btn-success">Kirim</button></div>
                            	</div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/startbootstrap-sb-admin-2-1.0.5/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/startbootstrap-sb-admin-2-1.0.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url() ?>assets/startbootstrap-sb-admin-2-1.0.5/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url() ?>assets/startbootstrap-sb-admin-2-1.0.5/dist/js/sb-admin-2.js"></script>
	
    <script>
		$("#kembali_login").click(function(e) {
            location.href = "<?php echo base_url() ?>login";
        });
		
		$("#kirim_password").click(function(e) {
            if( confirm("Anda Yakin mau me-reset Password ?") )
				return true;
			else
				return false;
        });
	</script>
    
</body>

</html>
