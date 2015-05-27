<?php
	$sess = $this->session->userdata("lang");
	$laws = isset($laws)?$laws:"";
	$category_name = isset($category_name)?$category_name:"";
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="laws"><?php echo $sess=="id"?$category_name[0]->laws_category_id:$category_name[0]->laws_category_en ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog col-sm-12 col-md-12">
        
        <div class="bottom-padding col-sm-12 col-md-12" style="text-align:justify;">
		  <ul class="latest-posts">
			<?php
        	foreach( $laws as $row )
			{
		?>
            <li>
              <a href="<?php echo base_url() ?>assets/uploads/files/<?php echo $row->files ?>" target="_blank" title="<?php echo $sess=="id"?"Klik disini untuk download":"Click here to download" ?>">
              	<i class="fa fa-download"></i> <?php echo $sess=="id"?$row->laws_id:$row->laws_en; ?>
              </a> 
			</li>
            <?php
			}
		?>
		  </ul>
        </div>
          
		<div class="pagination-box">
		  <ul class="pagination">
			<?php echo isset($paging)?$paging:""; ?>
		  </ul>

		</div><!-- .pagination-box -->
      </div><!-- .content -->

    </div>
  </div><!-- .container -->
</section><!-- #main -->