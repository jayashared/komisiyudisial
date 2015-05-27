<?php
	$sess = $this->session->userdata("lang");
	$agenda = isset($agenda)?$agenda:"";
	$detail_tag = isset($detail_tag)?$detail_tag:"";
	$row = isset($agenda[0])?$agenda[0]:"";
	$title = $sess=="id"?$row->title_id:$row->title_en;
	$text = $sess=="id"?$row->text_id:$row->text_en;
	$date = $sess=="id"?$row->time_id:$row->time_en;
	$post_date = TglIndo($row->modified_date);
	$address = $sess=="id"?$row->address_id:$row->address_en;
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
		<agenda class="post">
		  <div class="entry-content" style="text-align:justify;">
			<p>
			<?php echo $text; ?>
		  	</p>
            <p>
            	<?php echo $date ?>
            	<?php echo $address ?>
            </p>
          </div>
		  <footer class="entry-meta">
			<span class="time"><?php echo $sess=="id"?"Tanggal Posting: ":"Posting Date: " ?> <?php echo $post_date ?></span>
		  </footer>
		</agenda><!-- .post -->
	
		
      </div><!-- .content -->
    </div>
  </div><!-- .container -->
</section><!-- #main -->