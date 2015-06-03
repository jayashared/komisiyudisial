<?php
	$sess = $this->session->userdata("lang");
	$slider = isset($slider)?$slider:"";
	$detail_tag = isset($detail_tag)?$detail_tag:"";
	$row = isset($slider[0])?$slider[0]:"";
	$title = $sess=="id"?$row->title_id:$row->title_en;
	$text = $sess=="id"?$row->text_id:$row->text_en;
	$date = TglOnlyIndo($row->modified_date);
	$picture = $row->picture;
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h3 class="title"><?php echo $title; ?></h3>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog blog-post col-sm-9 col-md-9">
		<article class="post">
          <?php if( !empty($row->picture) ) {?>
			  <div class="col-md-6 col-sm-12 col-xs-12">
                  <a href="<?php echo base_url() ?>assets/uploads/picture/<?php echo $picture ?>" target="_blank">
                      <img class="img-responsive img-thumbnail" src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $picture ?>" 
                      alt="<?php echo $title ?>" title="<?php echo $title ?>">
                  </a>
              </div>
		  <?php } ?>
		  <div class="entry-content" style="text-align:justify;">
			<?php echo $text; ?>
		  </div>
		</article><!-- .post -->
	
		
      </div><!-- .content -->

    </div>
  </div><!-- .container -->
</section><!-- #main -->