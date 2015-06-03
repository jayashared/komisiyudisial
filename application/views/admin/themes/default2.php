<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" HREF="<?php echo base_url() ?>assets/images/icon.png">
    <meta name="author" content="">
    <title><?php echo isset($title)?$title:"Halaman Administrator" ?></title>
    <?php $this->load->view("admin/include/css.view2.php") ?>
    <?php $this->load->view("admin/include/js.view2.php") ?>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php $this->load->view("admin/include/navbar-header.view.php") ?>

            <?php $this->load->view("admin/include/navbar-toplink.view.php") ?>

            <?php $this->load->view("admin/include/sidebar.view.php") ?>
        </nav>
		
        <div id="page-wrapper">
            <div class="row">
            	<div>
					<?php $this->load->view($konten) ?>
        		</div>
                
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>


