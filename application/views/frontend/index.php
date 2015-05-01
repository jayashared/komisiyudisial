<!doctype html>
<html>
<head>
  
  <?php $this->load->view("frontend/template/meta.view.php") ?>
  <?php $this->load->view("frontend/template/js.view.php") ?>
  <?php $this->load->view("frontend/template/css.view.php") ?>
  
</head>
<body id="boxed-bg" class="boxed fixed-header">
    <div class="page-box">
        <div class="page-box-content">
            <!--header-->
            <?php $this->load->view("frontend/template/header.view.php") ?>
            <!--header-->
            
            <?php
                if( isset($content) and !empty($content) )
                {
                    $this->load->view($content);		
                }
                else
                {
                    $this->load->view("frontend/pages/home.view.php") ;
                }
                
            ?>
        </div><!-- .page-box-content -->
    </div><!-- .page-box -->
    <?php $this->load->view("frontend/template/footer.view.php") ; ?>
    <div class="clearfix"></div>
</body>
</html>