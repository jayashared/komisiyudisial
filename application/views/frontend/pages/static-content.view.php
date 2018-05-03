<?php
	$sess = $this->session->userdata("lang");
	$static_content = isset($static_content[0])?$static_content[0]:"";
	$title_id = isset($static_content->title_id)?$static_content->title_id:"";
	$title_en = isset($static_content->title_en)?$static_content->title_en:"";
	
	$text_id = isset($static_content->text_id)?$static_content->text_id:"";
	$text_en = isset($static_content->text_en)?$static_content->text_en:"";
?>

<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title"><?php echo $sess=="id"?$title_id:$title_en; ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog blog-post col-sm-9 col-md-9">
		<article class="post">
		  <div class="entry-content">
          	<?php echo $sess=="id"?$text_id:$text_en; ?>
		  </div>
		</article><!-- .post -->
      </div><!-- .content -->
      
      <?php $this->load->view("frontend/pages/static-content-sidebar.view.php") ?>
	  
    </div>
  </div><!-- .container -->
</section><!-- #main -->
