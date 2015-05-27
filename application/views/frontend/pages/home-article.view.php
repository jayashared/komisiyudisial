<?php $sess = $this->session->userdata("lang"); ?>
<div class="title-box">
<a href="<?php echo base_url() ?>frontend/article" class="btn btn-default">
	 <?php echo $sess=="id"?"Berkas":"All Post"; ?>
<span class="glyphicon glyphicon-arrow-right"></span></a>
<h2 class="title"><?php echo $sess=="id"?"Artikel":"Article"; ?></h2>
</div>
<?php
$article = isset($article)?$article:"";
echo empty($article)?"Data not Found":"";
?>
<ul class="latest-posts">
<?php
    foreach( $article as $ra )
    {
?>
<li>
  <div class="meta">
    <span class="time"><?php echo TglIndo($ra->modified_date) ?></span>
  </div>
  <div class="description">
    <a href="<?php echo base_url() ?>frontend/article_detail/<?php echo $ra->id_article ?>/<?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?>">
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