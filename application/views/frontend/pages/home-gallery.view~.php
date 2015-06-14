<?php 
	$sess = $this->session->userdata("lang"); 
	$gallery = isset($gallery)?$gallery:"";
?>

<div class="container">
    <div class="title-box">
        <a href="<?php echo base_url() ?>frontend/gallery" class="btn btn-default">
            <?php echo $sess=="id"?"Berkas":"All Post"; ?>
        <span class="glyphicon glyphicon-arrow-right"></span></a>
        <h2 class="title"><?php echo $sess=="id"?"Gallery":"Gallery"; ?></h2>
    </div>
</div>

<div class="banner-set banner-set-mini banner-set-no-pagination load bottom-padding">
<div class="container">
  <div class="banners">
	<?php  
	echo empty($gallery)?"Data not Found":"";
	foreach( $gallery as $ra )
	{
	?>    
    <a href="<?php echo base_url() ?>frontend/gallery" class="banner">
      <img src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $ra->picture ?>" 
          width="127" 
          height="79" alt="<?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?>" 
          title="<?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?>"    
      >
      <h2 class="title" title="<?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?>">
	  <?php echo $sess=="id"?PotongKata($ra->title_id,5):PotongKata($ra->title_en,5); ?>
      </h2>
    </a>
    <?php 
	} 
	?>
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