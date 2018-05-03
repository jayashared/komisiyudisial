<?php
	$sess = $this->session->userdata("lang");
	$gallery = isset($gallery)?$gallery:"";
	//print_r($gallery);
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title"><?php echo $sess=="id"?"Kategori Galeri":"Gallery Category" ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12">
		<div id="gallery-modern" class="row">
		  <ul>
          <?php 
		  	foreach( $gallery as $row )
			{
		  ?>
          		<li> 
					<a href="<?php echo base_url() ?>frontend/gallery/<?php echo $row->id_gallery_category ?>/<?php echo SEO($sess=="id"?$row->gallery_category_id:$row->gallery_category_en) ?> ">
						<?php echo $sess=="id"?$row->gallery_category_id:$row->gallery_category_en ?> 
                    </a>
                </li>
		  <?php
			}
		  ?>
          </ul>
		</div>
		
      </div><!-- .content -->
    </div>
  </div><!-- .container -->
</section><!-- #main -->

<style>
	.tai { height:197px !important; }
</style>