<?php $sess = $this->session->userdata("lang"); ?>
<div class="title-box">
<a href="<?php echo base_url() ?>frontend/gallery_category" class="btn btn-default">
    <?php echo $sess=="id"?"Berkas":"All Post"; ?><span class="glyphicon glyphicon-arrow-right"></span>
</a>
<h2 class="title">Gallery</h2>
</div>
<ul class="latest-posts">
	<?php  
        echo empty($gallery)?"Data not Found":"";
        foreach( $gallery as $ra )
        {
    ?>
    <li>
      <img class="image img-thumbnail" src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $ra->picture ?>" 
        alt="" title="" width="90" height="90" data-appear-animation="rotateIn"
      >
      <div class="meta">
        <span class="time"><?php echo TglIndo($ra->modified_date) ?></span>
        <span class="time">&nbsp;
			<?php echo $sess=="id"?"Kategori":"Category"; ?>: 
            <a href="<?php echo base_url() ?>frontend/gallery/<?php echo $ra->id_gallery_category ?>/<?php echo SEO($sess=="id"?$ra->gallery_category_id:$ra->gallery_category_en) ?> ">
				<?php echo $sess=="id"?$ra->gallery_category_id:$ra->gallery_category_en; ?>
            </a>
        </span>
      </div>
      <div class="description">
        <a href="<?php echo base_url() ?>frontend/gallery/<?php echo $ra->id_gallery_category ?>/<?php echo SEO($sess=="id"?$ra->gallery_category_id:$ra->gallery_category_en) ?> ">
          <strong class="text-primary"><?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?></strong>
        </a>
        <p>
        	<?php echo $sess=="id"?PotongKata($ra->text_id,20):PotongKata($ra->text_en,20); ?>
        </p>
      </div>
    </li>
    <?php
        }
    ?>
</ul>