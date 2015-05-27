<?php $sess = $this->session->userdata("lang"); ?>
<div class="title-box">
<a href="<?php echo base_url() ?>frontend/agenda" class="btn btn-default">
    <?php echo $sess=="id"?"Berkas":"All Post"; ?>
<span class="glyphicon glyphicon-arrow-right"></span></a>
<h2 class="title"><?php echo $sess=="id"?"Agenda":"Agenda"; ?></h2>
</div>
<?php $agenda = isset($agenda)?$agenda:""; ?>
<ul class="latest-posts">
<?php  
    echo empty($agenda)?"Data not Found":"";
    foreach( $agenda as $ra )
    {
?>
<li>
  <div class="meta">
    <span><?php echo $sess=="id"?trim(strip_tags($ra->address_id)):trim(strip_tags($ra->address_en)); ?></span>, 
    <span class="time"><?php echo $sess=="id"?$ra->time_id:$ra->time_en; ?></span>
  </div>
  <div class="description">
    <a href="<?php echo base_url() ?>frontend/agenda_detail/<?php echo $ra->id_agenda ?>/<?php echo $sess=="id"?SEO($ra->title_id):SEO($ra->title_en); ?>">
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