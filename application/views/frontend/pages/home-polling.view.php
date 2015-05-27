<?php
	$polling = isset($polling)?$polling:"";
	$sess = $this->session->userdata("lang");
?>

<div class="text-small features-block col-sm-3 col-md-3">
  <div class="header-box">
    <div class="icon-box">
      <i class="fa fa-desktop"></i>
    </div>
    <h6><?php echo $sess=="id"?"Polling Pengguna":"User Polling"; ?></h6>
  </div>
  <form method="post" action="<?php echo base_url()?>frontend/vote_process">
  <div>
  	
    <?php 
		foreach( $polling as $row )
		{
	?>

    <strong class="text-primary"><?php echo $sess=="id"?$row->cateory_id:$row->cateory_en; ?></strong>
    	<ul style="margin-left:-20px;">
        	<?php
            	foreach( $row->option as $ro ){
			?>
        	<li>
            	<label>
            	<input type="radio" name="id_polling" value="<?php echo $ro->id_polling ?>" />
				<?php echo $sess=="id"?$ro->polling_id:$ro->polling_en; ?>
            	</label>
            </li>
            <?php } ?>
        </ul>

    <input type="submit" name="vote" value="Voting" class="btn" />
    <input type="button" name="vote" value="Hasil" id="vote_result" class="btn btn-primary" />
    <?php
		}
	?>
  </div>
  </form>
</div><!-- .features-block -->

<script>
	$("#vote_result").click(function(e) {
        location.href = "<?php echo base_url() ?>frontend/polling_result"
    });
</script>