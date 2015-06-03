<?php
	$sess = $this->session->userdata("lang");
	$announcement = isset($announcement)?$announcement:"";
	//print_r($announcement);
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title"><?php echo $sess=="id"?"Pengumuman":"Announcement" ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog col-sm-12 col-md-12">
        
        <div class="bottom-padding col-sm-12 col-md-12" style="text-align:justify;">
		  <ul class="latest-posts">
			<?php
        	foreach( $announcement as $row )
			{
		?>
            <li>
              <a href="<?php echo base_url() ?>frontend/announcement_detail/<?php echo $row->id_announcement ?>/<?php echo $sess=="id"?SEO($row->title_id):SEO($row->title_en); ?>">
              	<big><strong class="text-warning"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></strong></big>
              </a>
              <div class="meta">
				<span class="time"><?php echo TglOnlyIndo($row->expired_date) ?></span>
			  </div>
			  <div class="description">
                <p>
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