<?php
	$sess = $this->session->userdata("lang");
	$video = isset($video)?$video:"";
	$detail_tag = isset($detail_tag)?$detail_tag:"";
	$row = isset($video[0])?$video[0]:"";
	$title = $sess=="id"?$row->title_id:$row->title_en;
	$text = $sess=="id"?$row->text_id:$row->text_en;
	$date = TglOnlyIndo($row->modified_date);
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
			<div class="col-md-6">
                <iframe width="100%" height="300"
                    src="http://www.youtube.com/embed/<?php echo $row->embed ?>">
                </iframe>
            </div>
			<?php echo $text; ?>
		  </div>
		  <footer class="entry-meta">
			<span class="time"><?php echo $sess=="id"?"Tanggal Posting":"Posting Date" ?>: <?php echo $date ?></span>
		  </footer>
		</article><!-- .post -->
	
		
      </div><!-- .content -->
    </div>
  </div><!-- .container -->
</section><!-- #main -->