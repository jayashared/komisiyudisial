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
      <div class="content blog col-sm-12 col-md-12">
		
        <?php
        	foreach( $news as $row )
			{
		?>

        
        <div class="bottom-padding col-sm-12 col-md-12">
		  <ul class="latest-posts">
			<li>
              <a href="#">
              	<h5 class="title"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></h5>
              </a>
			  <img class="col-md-3" src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $row->picture ?>" alt="<?php echo $sess=="id"?$row->title_id:$row->title_en; ?>" title="<?php echo $sess=="id"?$row->title_id:$row->title_en; ?>" width="200">
			  <div class="meta">
				<span class="time"><?php echo TglOnlyIndo($row->date) ?></span>
			  </div>
			  <div class="description">
                <p>
                	<?php echo PotongKata($sess=="id"?$row->text_id:$row->text_id, 50); ?>
                </p>
			  </div>
			</li>
		  </ul>
		</div>
		<?php
			}
		?>
		
        
        
        
		<div class="pagination-box">
		  <ul class="pagination">
			<?php echo isset($paging)?$paging:""; ?>
		  </ul>

		</div><!-- .pagination-box -->
      </div><!-- .content -->
    </div>
  </div><!-- .container -->
</section><!-- #main -->