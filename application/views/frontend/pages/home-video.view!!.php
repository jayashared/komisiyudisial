<?php $sess = $this->session->userdata("lang"); ?>
<div class="title-box">
<a href="<?php echo base_url() ?>frontend/video" class="btn btn-default"><?php echo $sess=="id"?"Berkas":"All Post"; ?> <span class="glyphicon glyphicon-arrow-right"></span></a>
<h2 class="title"><?php echo $sess=="id"?"Video":"Video"; ?></h2>
</div>

<?php $video = isset($video)?$video:""; ?>

<ul class="latest-posts" style="display:none;">
<?php  
echo empty($video)?"Data not Found":"";
foreach( $video as $ra )
{
?>
<li>
  <div class="meta">
    <span class="time"><?php echo TglIndo($ra->modified_date) ?></span>
  </div>
  <div class="description">
    <a href="<?php echo base_url() ?>frontend/video_detail/<?php echo $ra->id_video ?>/<?php echo $sess=="id"?SEO($ra->title_id):SEO($ra->title_en); ?>">
        <strong class="text-primary"><?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?></strong>
    </a>
    <p>
        <iframe
        	src="http://www.youtube.com/embed/<?php echo $ra->embed ?>">
        </iframe>
    </p>
  </div>
</li>
<?php } ?>
</ul>

<div class="col-sm-12 col-md-6 bottom-padding overflow">
  <div class="manufactures carousel-box load overflow" data-carousel-pagination="true">
    <div class="title-box">
      <a class="next" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
          <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#fcfcfc" points="1,0.001 0,1.001 7,8 0,14.999 1,15.999 9,8 "></polygon>
        </svg>
      </a>
      <a class="prev" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
          <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#fcfcfc" points="8,15.999 9,14.999 2,8 9,1.001 8,0.001 0,8 "></polygon>
        </svg>
      </a>
      <h2 class="title">Navigation & Pagination</h2>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="row">
      <div class="carousel">
  		<?php  
		echo empty($video)?"Data not Found":"";
		foreach( $video as $ra )
		{
		?>      
        <div class="make-wrapper">
          	<a href="<?php echo base_url() ?>frontend/video_detail/<?php echo $ra->id_video ?>/<?php echo $sess=="id"?SEO($ra->title_id):SEO($ra->title_en); ?>">
                <?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?>
            </a>
            <img src="http://img.youtube.com/vi/<?php echo $ra->embed ?>/hqdefault.jpg">
        </div>
       	<?php 
		} 
		?>
      </div>
    </div>
    <div class="pagination switches"></div>
  </div><!-- .manufactures -->
</div>