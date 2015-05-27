<?php $sess = $this->session->userdata("lang"); ?>
<div class="title-box">
<a href="<?php echo base_url() ?>frontend/pers_release" class="btn btn-default"><?php echo $sess=="id"?"Berkas":"All Post"; ?>  <span class="glyphicon glyphicon-arrow-right"></span></a>
<h2 class="title"><?php echo $sess=="id"?"Siaran Pers":"Pers Release"; ?></h2>
</div>

<?php $pers_release = isset($pers_release)?$pers_release:""; ?>

<ul class="latest-posts">
<?php  
    echo empty($pers_release)?"Data not Found":"";
    //print_r($pers_release);
    foreach( $pers_release as $ra )
    {
  ?>
    <li>
      <div class="meta">
        <span class="time"><?php echo TglIndo($ra->modified_date) ?></span>
      </div>
      <div class="description">
        <a href="<?php echo base_url() ?>frontend/pers_release_detail/<?php echo $ra->id_pers_release ?>/<?php echo $sess=="id"?SEO($ra->title_id):SEO($ra->title_en); ?>">
            <strong class="text-primary"><?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?></strong>
        </a>
        <p>
            <?php echo $sess=="id"?PotongKata($ra->text_id, 20):PotongKata($ra->text_en, 20); ?>
        </p>
      </div>
    </li>
  <?php } ?>
</ul>