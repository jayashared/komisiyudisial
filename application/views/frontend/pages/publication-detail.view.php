<?php
	$sess = $this->session->userdata("lang");
	$data = isset($publication)?$publication:"";
	//print_r($data);exit;
	$row = isset($data[0])?$data[0]:"";
	$category = $sess=="id"?$row->category_id:$row->category_en;
	$title = $sess=="id"?$row->title_id:$row->title_en;
	$text = $sess=="id"?$row->text_id:$row->text_en;
	$publication_date = TglOnlyIndo($row->publication_date);
	$expired_date = TglOnlyIndo($row->expired_date);
	$file = isset($row->file)?$row->file:"";
	$cover = isset($row->cover)?$row->cover:"";
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
		<procurement class="post">
		  <div class="entry-content" style="text-align:justify;">
			<div>
            			<img src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $cover ?>" class="img" style="float:left; margin-right:10px; max-width:500px;max-height:500px;" />
			</div>
			<?php echo strip_tags($text); ?>
<div style="clear:both;"></div>

		  </div>
		  <footer class="entry-meta">
			<span class="time"><?php echo $publication_date ?> - <?php echo $expired_date ?></span> | 
            <span class="meta">
				<?php echo $sess=="id"?"Kategori":"Categori"; ?>: 
                <?php echo $category; ?>
            </span> | 
            <span class="time">
            <?php if( !empty($file) ){ ?>
            	<a href="<?php echo base_url() ?>assets/uploads/files/<?php echo $file ?>" target="_blank">
					<i class="fa fa-download"></i> <?php echo $sess=="id"?"Unduh":"Download" ?>
                </a>
            <?php } ?>
            </span>
		  </footer>
		</procurement><!-- .post -->
	
		
      </div><!-- .content -->
    </div>
  </div><!-- .container -->
</section><!-- #main -->