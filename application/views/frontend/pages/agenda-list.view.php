<?php
	$sess = $this->session->userdata("lang");
	$agenda = isset($agenda)?$agenda:"";
	//print_r($agenda);
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title"><?php echo $sess=="id"?"Agenda":"Agenda" ?></h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog col-sm-12 col-md-12">
        
        <div class="bottom-padding col-sm-12 col-md-12" style="text-align:justify;">
		  <ul class="latest-posts">
			<?php
        	foreach( $agenda as $row )
			{
		?>
            <li>
              <a href="<?php echo base_url() ?>frontend/agenda_detail/<?php echo $row->id_agenda ?>/<?php echo $sess=="id"?SEO($row->title_id):SEO($row->title_en); ?>">
              	<big><strong class="text-warning"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></strong></big>
              </a>
              <div class="meta">
				<span class="time"><?php echo $sess=="id"?"Tanggal Posting: ":"Posting Date: " ?><?php echo TglOnlyIndo($row->modified_date) ?></span>
			  </div>
			  <div class="description">
                <p>
                	<?php echo $sess=="id"?$row->time_id:$row->time_en ?>
                    <?php echo $sess=="id"?$row->address_id:$row->address_en ?>
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