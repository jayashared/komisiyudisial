<?php
	$sess = $this->session->userdata("lang");
	$news = isset($news)?$news:"";
	//print_r($news);
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title"><?php echo $sess=="id"?"Berita":"News" ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog col-sm-9 col-md-9">
        
        <div class="bottom-padding col-sm-12 col-md-12" style="text-align:justify;">
		  <ul class="latest-posts">
			<?php
        	foreach( $news as $row )
			{
		?>
            <li>
              <a href="<?php echo base_url() ?>frontend/news_detail/<?php echo $row->id_news ?>/<?php echo $sess=="id"?SEO($row->title_id):SEO($row->title_en); ?>">
              	<big><strong class="text-primary"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></strong></big>
              </a>
              <?php if( !empty($row->picture) ) {?>
			  <img class="col-md-3" src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $row->picture ?>" alt="<?php echo $sess=="id"?$row->title_id:$row->title_en; ?>" title="<?php echo $sess=="id"?$row->title_id:$row->title_en; ?>" width="200">
			  <?php } ?>
              <div class="meta">
				<span class="time"><?php echo TglOnlyIndo($row->date) ?></span> | 
                <span class="meta">
					<?php echo $sess=="id"?"Kategori":"Categori"; ?>: 
					<?php
                    	foreach( $row->category as $rc )
						{
							echo $sess=="id"?$rc->news_category_id:$rc->news_category_en;
						}
					?>
                </span> | 
                <span class="meta">Tags: 
                	<?php
                    	foreach( $row->tags as $rt )
						{
							echo $sess=="id"?$rt->news_tag_id:$rt->news_tag_en;
						}
					?>
                </span>
			  </div>
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
      <?php
      	$this->load->view("frontend/pages/news-sidebar.view.php");
	  ?>
    </div>
  </div><!-- .container -->
</section><!-- #main -->