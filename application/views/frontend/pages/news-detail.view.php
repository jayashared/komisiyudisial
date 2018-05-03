<?php
	$sess = strtoupper($this->session->userdata("lang"));
	//echo $sess . "asd";
	$news = isset($news)?$news:"";
	$detail_tag = isset($detail_tag)?$detail_tag:"";
	$row = isset($news[0])?$news[0]:"";
	$title = $sess=="ID"?$row->title_id:$row->title_en;
	$picture_caption = $sess=="ID"?$row->picture_caption_id:$row->picture_caption_en;
	$text = $sess=="ID"?$row->text_id:$row->text_en; 
	$date = TglIndo($row->date);
	$picture = $row->picture;
	$count = $row->COUNT;
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
          <div class="entry-meta">
			<span class="time"><?php echo $date ?> WIB</span>
			<span class="separator">|</span>
			<span class="meta">
                Tag: 
                <?php foreach( $detail_tag as $rdt ){ ?>
	            	<a href="#"><?php echo $sess=="ID"?$rdt->news_tag_id:$rdt->news_tag_en; ?></a>, 
                <?php } ?>
            </span>
            <span class="separator">|</span>
            <span>Dibaca: <?php echo $count ?> Kali</span>
		  </div>
          <br />
		  <?php if( !empty($row->picture) ) {?>
			  <div class="col-md-12" style="border:1px solid silver; padding:5px; margin-bottom:20px; font-size:12px;">
              <a href="<?php echo base_url() ?>assets/uploads/picture/<?php echo $picture ?>" target="_blank">
                  <img src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $picture ?>" 
                  width="100%" style="max-height:500px;"
                  alt="<?php echo $title ?>" title="<?php echo $title ?>">
		  	  </a>
                  <div>
                    <?php echo $picture_caption ?>
                  </div>
              </div><br />
		  <?php } ?>
          
		  <div class="entry-content" style="text-align:justify;">
			<?php echo $text; ?>
		  </div>
		  
		</article><!-- .post -->
		<hr />
        <article>
        	<h5><?php echo $sess=="ID"?"Berita Terkait":"Linked News"; ?></h5>
            <ul>
            	<?php
                	foreach( $linked as $rl )
					{
				?>
                	<li>
						<a href="<?php echo base_url() ?>frontend/news_detail/<?php echo $rl->id_news ?>/<?php echo SEO($sess=="ID"?$rl->title_id:$rl->title_en ); ?>"><?php echo $sess=="ID"?$rl->title_id:$rl->title_en; ?></a>
                    </li>
                <?php
					}
				?>
            </h5>
        </article>
		
      </div><!-- .content -->
	  <?php
      	$this->load->view("frontend/pages/news-sidebar.view.php");
	  ?>
    </div>
  </div><!-- .container -->
</section><!-- #main -->