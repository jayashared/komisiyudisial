<?php
	$sess = $this->session->userdata("lang");
	$news = isset($news)?$news:"";
	$detail_tag = isset($detail_tag)?$detail_tag:"";
	$row = isset($news[0])?$news[0]:"";
	$title = $sess=="id"?$row->title_id:$row->title_en;
	$picture_caption = $sess=="id"?$row->picture_caption_id:$row->picture_caption_en;
	$text = $sess=="id"?$row->text_id:$row->text_en;
	$date = TglOnlyIndo($row->date);
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
			  <div class="col-md-6">
              <a href="<?php echo base_url() ?>assets/uploads/picture/<?php echo $picture ?>" target="_blank">
                  <img class="img-responsive img-thumbnail" src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $picture ?>" 
                  alt="<?php echo $title ?>" title="<?php echo $title ?>">
		  	  </a>
              <div class="col-md-12 bg-primary">
              	<center><?php echo $picture_caption ?></center>
              </div>
              </div>
		  <?php } ?>
		  <div class="entry-content" style="text-align:justify;">
			<?php echo $text; ?>
		  </div>
		  <footer class="entry-meta">
			<span class="time"><?php echo $date ?></span>
			<span class="separator">|</span>
			<span class="meta">
                Tag: 
                <?php foreach( $detail_tag as $rdt ){ ?>
	            	<a href="#"><?php echo $sess=="ID"?$rdt->news_tag_id:$rdt->news_tag_en; ?></a>, 
                <?php } ?>
            </span>

		  </footer>
		</article><!-- .post -->
	
		
      </div><!-- .content -->
	  <?php
      	$this->load->view("frontend/pages/news-sidebar.view.php");
	  ?>
    </div>
  </div><!-- .container -->
</section><!-- #main -->