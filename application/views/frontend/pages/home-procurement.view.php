<?php $sess = $this->session->userdata("lang"); ?>
<div class="title-box">
<a href="<?php echo base_url() ?>frontend/procurement" class="btn btn-default"><?php echo $sess=="id"?"Berkas":"All Post"; ?> <span class="glyphicon glyphicon-arrow-right"></span></a>
<h2 class="title"><?php echo $sess=="id"?"Informasi Lelang":"Procurement"; ?></h2>
</div>

<?php $procurement = isset($procurement)?$procurement:""; ?>

<ul class="latest-posts">
<?php  
echo empty($procurement)?"Data not Found":"";
foreach( $procurement as $ra )
{
?>
<li>
  <div class="meta">
    <span class="time"><?php echo TglIndo($ra->modified_date) ?></span>
  </div>
  <div class="description">
    <a href="<?php echo base_url() ?>frontend/procurement_detail/<?php echo $ra->id_procurement ?>/<?php echo $sess=="id"?SEO($ra->title_id):SEO($ra->title_en); ?>">
        <strong class="text-primary"><?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?></strong>
    </a>
    <p>
        <?php echo $sess=="id"?PotongKata($ra->text_id, 20):PotongKata($ra->text_en, 20); ?>
    </p>
  </div>
</li>
<?php } ?>
</ul>