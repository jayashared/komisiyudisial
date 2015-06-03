<style>
	#slider-container { margin-top:20px; }
	#left-slider { border:0px solid red; height:auto; }
	#right-slider { border:0px solid black; height:auto; }
	.clear { clear:both; }
</style>

<!-- bjqs.css contains the *essential* css needed for the slider to work -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/slider/bjqs.css">

<!-- demo.css contains additional styles used to set up this demo page - not required for the slider --> 
<link rel="stylesheet" href="<?php echo base_url() ?>assets/slider/demo.css">

<!-- load jQuery and the plugin -->
<script src="<?php echo base_url() ?>assets/slider/js/bjqs-1.3.min.js"></script>

<?php
	$sess = $this->session->userdata("lang");
	$slider = isset($slider)?$slider:"";
?>

<div class="container" id="slider-container">
    <div id="left-slider" class="col-md-9">
        <!--  Outer wrapper for presentation only, this can be anything you like -->
          <div id="banner-fade">
            <!-- start Basic Jquery Slider -->
            <ul class="bjqs col-md-12">
			<?php
            foreach( $slider as $row )
            {
            ?>
              <li>
              <img src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $sess=="id"?$row->picture:$row->picture; ?>" 
              	class="img-responsive img-thumbnail" title="<?php echo $sess=="id"?$row->title_id:$row->title_en; ?>"
              >
              </li>
            <?php
			}
			?>
            </ul>
            <!-- end Basic jQuery Slider -->
          </div>
          <!-- End outer wrapper -->
    </div>
    <div id="right-slider" class="col-md-3"></div>
</div>


<script>
	var winH = $(document).height();
	var winW = $(document).width();
	var sW = "";
	var sH = "";
	
	
	if( winW < 768 )
	{
		sH = winW-100;
		sW = winW;
		//alert(sH)
	}
	else
	{
		sH = "400";
		sW = "100%";
	}
	
	
	
	jQuery(document).ready(function($) {
	
	  $('#banner-fade').bjqs({
		height      : sH,
		width       : sW,
		responsive  : true,
		centercontrols : true, 
		showmarkers : false, 
	  });
	
	});
</script>