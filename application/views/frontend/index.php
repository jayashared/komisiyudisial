<!doctype html>
<html>
<head>
  
  <?php $this->load->view("frontend/template/meta.view.php") ?>
  <?php $this->load->view("frontend/template/js.view.php") ?>
  <?php $this->load->view("frontend/template/css.view.php") ?>
  
</head>
<body id="boxed-bg" class="boxed fixed-header">
	
    <div class="row">
    	<div class="" style="border:0px solid red;  margin-bottom:10px; padding-right:20px; z-index:100000000">
        	<!-- Single button -->
            <div class="btn-group" style="margin-left:20px;">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-tasks"></i> Informasi Publik <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu" style="z-index:1000;">
                <li><a href="#">Informasi Publik</a></li>
                <li><a href="#">Informasi SCHA</a></li>
                <li><a href="#">Informasi Pengawasan Perilaku Hakim</a></li>
                <li><a href="#">Laporan Keuangan dan Perencanaan</a></li>
                <li><a href="#">Hasil Penelitian Komisi Yudisial</a></li>
              </ul>
            </div>
            
            
            <div style="float:right;">
                <span class="label label-warning">ID</span>
                <span class="label label-warning">EN</span>
        	</div>
        	
        </div>
        
        
    </div>
    
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