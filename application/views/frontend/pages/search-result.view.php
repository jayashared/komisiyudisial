<?php
	$sess = $this->session->userdata("lang");
	$search = isset($search)?$search:"";
	//print_r($search);
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title"><?php echo $sess=="id"?"Hasil Pencarian":"Search Result" ?>: <?= $this->session->userdata('query'); ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog col-sm-12 col-md-12">
        
        <div class="bottom-padding col-sm-12 col-md-12" style="text-align:justify;">
		  <ul class="latest-posts">
			<?php
        	foreach( $search as $row )
			{
		?>
            <li>
              <a href="<?php echo base_url() ?>frontend/<?php echo $row->table_name ?>_detail/<?php echo $row->primary_key ?>/<?php echo $sess=="id"?SEO($row->title_id):SEO($row->title_en); ?>">
              	<big><strong class="text-primary"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></strong></big>
              </a>
              
			  <div class="description">
                <p>
                	<?php echo PotongKata($sess=="id"?$row->text_id:$row->text_id, 50); ?>
                    
                </p>
			  </div>
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