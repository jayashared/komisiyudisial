<?php
	$sess = $this->session->userdata("lang");
	$publication = isset($publication)?$publication:"";
	$category_name = isset($category_name)?$category_name:"";
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title"><?php echo $sess=="id"?$category_name[0]->title_id:$category_name[0]->title_en ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog col-sm-10 col-md-10">
        
        <div class="bottom-padding col-sm-12 col-md-12" style="text-align:justify;">
		  <ul class="latest-posts">
			<?php
        	foreach( $publication as $row )
			{
		?>
            <li>
              <a href="<?php echo base_url() ?>frontend/publication_detail/<?php echo $row->id_publication ?>/<?php echo $sess=="id"?SEO($row->title_id):SEO($row->title_en); ?>">
              	<h5 class="title"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></h5>
              </a>
              <?php if( !empty($row->cover) ) {?>
			  <a href="<?php echo base_url() ?>assets/uploads/files/<?php echo $row->file ?>" target="_blank" 
              	title="<?php echo $sess=="id"?"Klik disini untuk download":"Click here to Download"; ?>"
              >
                  <img class="col-md-2 col-sm-12 col-xs-12" src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $row->cover ?>" 
                    alt="<?php echo $sess=="id"?$row->title_id:$row->title_en; ?>" 
                  >
              </a>
			  <?php } ?>
              <div class="meta">
				<span class="time"><?php echo TglOnlyIndo($row->publication_date) ?> - <?php echo TglOnlyIndo($row->expired_date) ?></span> | 
                <span class="meta">
					<?php echo $sess=="id"?"Kategori":"Categori"; ?>: 
					<?php echo $sess=="id"?$row->category_id:$row->category_en; ?>
                </span>
			  </div>
			  <div class="description">
                <p>
                	<?php 
						$m = $sess=="id"?"Penjelasan Singkat tidak ditemukan":"Description not Found";
						$des = $sess=="id"?$row->text_id:$row->text_id; 
						echo !empty($des)?PotongKata($des,50):$m;
					?>
                    
                </p>
			  </div>
              <div align="left">
              	<a href="<?php echo base_url() ?>assets/uploads/files/<?php echo $row->file ?>" target="_blank">
                	<i class="fa fa-download"></i> <?php echo $sess=="id"?"Unduh":"Download"; ?> 
                </a>
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
      <?php
      	$this->load->view("frontend/pages/publication-sidebar.view.php");
	  ?>
    </div>
  </div><!-- .container -->
</section><!-- #main -->