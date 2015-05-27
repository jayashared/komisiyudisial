<?php
	$sess = $this->session->userdata("lang");
	$video = isset($video)?$video:"";
	//print_r($video);
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title"><?php echo $sess=="id"?"Video":"Video" ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog col-sm-12 col-md-12">
        
        <div class="bottom-padding col-sm-12 col-md-12" style="text-align:justify;">
		  <ul class="latest-posts">
			<?php
        	foreach( $video as $row )
			{
		?>
            <li>
              <a href="<?php echo base_url() ?>frontend/video_detail/<?php echo $row->id_video ?>/<?php echo $sess=="id"?SEO($row->title_id):SEO($row->title_en); ?>">
              	<big><strong class="text-primary"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></strong></big>
              </a>
              <div class="meta">
				<span class="time"><?php echo $sess=="id"?"Tanggal Posting":"Posting Date" ?>: <?php echo TglOnlyIndo($row->modified_date) ?></span>
			  </div>
			  <div class="description">
                <p>
                	<div class="col-md-3">
                        <iframe width="100%"
                            src="http://www.youtube.com/embed/<?php echo $row->embed ?>">
                        </iframe>
                    </div>
                	<?php echo PotongKata($sess=="id"?$row->text_id:$row->text_id, 50); ?>
                </p>
			  </div>
			</li>
            <?php
			}
		?>
		  </ul>
        </div>
          
		<div class="pagination-box">
		  <ul class="pagination">
			<?php echo isset($paging)?$paging:""; ?>
		  </ul>

		</div><!-- .pagination-box -->
      </div><!-- .content -->
    </div>
  </div><!-- .container -->
</section><!-- #main -->