<?php $sess = $this->session->userdata("lang"); ?>
<div class="title-box">
<a href="<?php echo base_url() ?>frontend/announcement" class="btn btn-default">
    <?php echo $sess=="id"?"Berkas":"All Post"; ?>
<span class="glyphicon glyphicon-arrow-right"></span></a>
<h2 class="title"><?php echo $sess=="id"?"Pengumuman":"Announcement"; ?></h2>
</div>
<?php $announcement = isset($announcement)?$announcement:""; ?>
<ul class="latest-posts">
<?php  
    echo empty($announcement)?"Data not Found":"";
    foreach( $announcement as $ra )
    {
?>
<li>
  <div class="meta">
    <span class="time"><?php echo $sess=="id"?TglIndo($ra->expired_date):TglIndo($ra->expired_date); ?></span>
  </div>
  <div class="description">
    <a href="<?php echo base_url() ?>frontend/announcement_detail/<?php echo $ra->id_announcement ?>/<?php echo $sess=="id"?SEO($ra->title_id):SEO($ra->title_en); ?>">
        <strong class="text-primary"><?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?></strong>
    </a>
    <p>
        <?php echo $sess=="id"?PotongKata($ra->text_id, 20):PotongKata($ra->text_en, 20); ?>
    </p>
  </div>
</li>
<?php
    }
?>
</ul>