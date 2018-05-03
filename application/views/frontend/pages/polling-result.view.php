
<?php
	$sess = $this->session->userdata("lang");
	$polling = isset($polling)?$polling:"";
	
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h3 class="title"><?php echo $sess=="id"?"Hasil Polling":"Polling Result" ?></h3>
    </div>	
  </header>
  <div class="container">
  	
    <?php
    	$m = $this->session->flashdata('message');
		if( !empty($m) ){
	?>
        <div class="alert <?= $m[0] ?>">
            <?= $m[1] ?>
        </div>
    <?php } ?>
  
    <?php
    	foreach( $polling as $row ){
	?>
    <div class="row">
		<div class="bottom-padding col-sm-12 col-md-12">
		  
          <div class="title-box">
			<h2 class="title"><?php echo $sess=="id"?$row->cateory_id:$row->cateory_en ?></h2>
		  </div>
		  <?php
		  	$i = 0;
          	foreach( $row->option as $ro ){
		  	$p = $i%2==0?"progress-bar-info":"progress-bar-warning";
		  ?>
          	  <label><?php echo $sess=="id"?$ro->polling_id:$ro->polling_en ?> (<?php echo $ro->jumlah ?>)</label>
              <div class="progress active">
                <div class="progress-bar <?php echo $p ?>" style="width: <?php echo $ro->result ?>%;">
					
                </div>
              </div>
              
          <?php 
		  	$i++;
		  } 
		  ?>
          <div align="right">
          <label>Total Polling: <?= $total_polling ?></label>
		  </div>
        </div>
        
    </div>
    <?php } ?>
        
  </div><!-- .container -->
</section><!-- #main -->