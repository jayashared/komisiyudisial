<style>
	#latest-news-title{ margin-bottom:0px;  }
</style>
<?php
	$rec = isset($news)?$news:"";
	$sess = $this->session->userdata("lang");
?>

<div class="carousel banner-set load">
  <div class="container">
    <div class="title-box" id="latest-news-title">
        <h2 class="title"><?php echo $sess=="id"?"Berita Terkini":"Latest News"; ?></h2>
  	</div>
    <div class="banners">
      <?php
      	foreach( $rec as $row )
		{
	  ?>
      <a href="<?php echo base_url() ?>frontend/news_detail/<?php echo $row->id_news ?>/<?php echo $sess=="id"?SEO($row->title_id):SEO($row->title_en); ?>" class="banner">
		<img src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $row->picture ?>" width="253" height="158" alt="">
        <h2 class="title"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></h2>
		<div class="description">
        	<?php echo PotongKata($sess=="id"?$row->text_id:$row->text_en, 50); ?>
        </div>
      </a>
      <?php } ?>
    </div><!-- .banners -->
	<div class="clearfix"></div>
  </div>
  <div class="nav-box">
    <div class="container">
      <a class="prev" href="#"><span class="glyphicon glyphicon-arrow-left"></span></a>
      <div class="pagination switches"></div>
      <a class="next" href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>	
    </div>
  </div>
</div><!-- .banner-set -->