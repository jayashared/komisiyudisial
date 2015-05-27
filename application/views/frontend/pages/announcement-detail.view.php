<?php
	$sess = $this->session->userdata("lang");
	$announcement = isset($announcement)?$announcement:"";
	$detail_tag = isset($detail_tag)?$detail_tag:"";
	$row = isset($announcement[0])?$announcement[0]:"";
	$title = $sess=="id"?$row->title_id:$row->title_en;
	$text = $sess=="id"?$row->text_id:$row->text_en;
	$date = TglOnlyIndo($row->expired_date);
	$file = isset($row->file)?$row->file:"";
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h3 class="title"><?php echo $title; ?></h3>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog blog-post col-sm-12 col-md-12">
		<article class="post">
		  <div class="entry-content" style="text-align:justify;">
			<?php echo $text; ?>
		  </div>
		  <footer class="entry-meta">
			<span class="time"><?php echo $date ?></span> | 
            <span class="time">
            <?php if( !empty($file) ){ ?>
            	<a href="<?php echo base_url() ?>assets/uploads/files/<?php echo $file ?>" target="_blank">
					<i class="fa fa-download"></i> <?php echo $sess=="id"?"Unduh":"Download" ?>
                </a>
            <?php } ?>
            </span>
		  </footer>
		</article><!-- .post -->
	
		
      </div><!-- .content -->
    </div>
  </div><!-- .container -->
</section><!-- #main -->