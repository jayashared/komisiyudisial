<?php $sess = $this->session->userdata("lang"); ?>
<div class="title-box">
<a href="<?php echo base_url() ?>frontend/video" class="btn btn-default"><?php echo $sess=="id"?"Berkas":"All Post"; ?> <span class="glyphicon glyphicon-arrow-right"></span></a>
<h2 class="title"><?php echo $sess=="id"?"Video":"Video"; ?></h2>
</div>

<?php $video = isset($video)?$video:""; ?>

<ul class="latest-posts">
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
        <iframe width="100%" height="150"
        src="http://www.youtube.com/embed/<?php echo $ra->embed ?>">
        </iframe>
    </p>
  </div>
</li>
<?php } ?>
</ul>