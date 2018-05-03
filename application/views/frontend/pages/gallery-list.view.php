<?php
	$sess = $this->session->userdata("lang");
	$gallery = isset($gallery)?$gallery:"";
	//print_r($gallery);
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title"><?php echo $sess=="id"?"Galeri":"Gallery" ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12">
		<div id="gallery-modern" class="row">
		  
          <?php 
			$i=1;
		  	foreach( $gallery as $row )
			{
		  ?>
        
	<div class=" col-sm-3 col-md-3">
			<a class="gallery-images" rel="fancybox" data-caption="<?php echo $sess=="id"?$row->title_id:$row->title_en; ?>" 
			href="<?php echo base_url() ?>assets/uploads/picture/<?php echo $row->picture ?>" title="<?php echo $sess=="id"?$row->title_id:$row->title_id; ?><br><?php echo $sess=="id"?$row->text_id:$row->text_id; ?>">
			  <img class="tai" src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $row->picture ?>" width="270" height="197" alt="">
			  <span class="bg-images"><i class="fa fa-search"></i></span>
			</a>
		  	<p class="description">
            	<strong><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></strong><br />
		<?php echo $sess=="id"?$row->text_id:$row->text_en; ?>
            </p>
          </div>
	<?php
		if($i % 4 == 0){
			echo '<div style="clear:both;"></div><hr>';
		}
	?>  
	<!-- .images-box -->
          
		  <?php
				$i++;
			}
		  ?>
          
		</div>
		<div class="row">
		  <div class="col-sm-12 col-md-12">
			<div class="pagination-box">
			  <ul class="pagination">
				<?php echo isset($paging)?$paging:""; ?>
			  </ul>
			  
			</div><!-- .pagination-box -->
		  </div>
		</div>
      </div><!-- .content -->
    </div>
  </div><!-- .container -->
</section><!-- #main -->

<style>
	.tai { height:197px !important; }
</style>