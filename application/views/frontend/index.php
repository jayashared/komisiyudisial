<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
    
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-568a13693e97b3ef" async="async"></script>
    
</body>
</html>

