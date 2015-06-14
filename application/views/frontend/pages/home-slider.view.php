<style>
	#slider-container { margin-top:20px; }
	#left-slider { margin-left:0px !important; cursor:pointer;  }
	#right-slider { border:0px solid black; height:auto; }
	.clear { clear:both; }
	#right-slider ul { }
	#right-slider ul li 
	{ 
		padding-left:0px; 
		margin-left:-40px; 
		list-style:square; 
		color:#FFF; 
		margin:0px 0px 0px -65px;
		padding:0px 0px 5px 10px;
		border-bottom:1px dotted #FFF;
		border-left:5px solid #FFF;
		display:block; 
	}
	#right-slider ul li a { color:#FFF; font-size:14px;}
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

<div class="row" id="slider-container">
<div class="container">
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
                    class="img-thumbnail slider-select" title="<?php echo $sess=="id"?$row->title_id:$row->title_en; ?>"
                    data-id_slider="<?php echo $row->id_slider ?>"
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
    
    <div id="right-slider" class="col-md-3">
        <div  style="background:#669933; height:350px;" class="col-md-12">
            <div class="title-box" style="color:#FFF; font-size:18px; padding-top:10px;"><i class="fa fa-info-circle"></i> Layanan Informasi Publik</div>
            <ul class="">
                <li class=""><a href="<?php echo base_url() ?>frontend/static_content/selection_of_supreme_court_justice">Informasi Seleksi CHA</a></li>
                <li class=""><a href="<?php echo base_url() ?>frontend/static_content/behavioural_surveillance_judge">Informasi Pengawasan Perilaku Hakim</a></li>
                <li class=""><a href="<?php echo base_url() ?>frontend/static_content/financial_statements_and_planning">Laporan Keuangan dan Perencanaan</a></li>
                <li class=""><a href="<?php echo base_url() ?>frontend/static_content/research_result">Hasil Penelitian Komisi Yudisial</a></li>
            	<li>
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><i class="fa fa-phone"></i>&nbsp;</td>
                        <td>021 - 3190 3876</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>021 - 3190 3902</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>021 - 3190 3802</td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-envelope"></i>&nbsp;</td>
                        <td><small>pengaduan@komisiyudisial.go.id</small></td>
                      </tr>
                    </table>
                </li>
            </ul>
            
      </div>
    </div>
</div>
</div>


<script>
	var winH = $(document).height();
	var winW = $(document).width();
	var sW = "";
	var sH = "";
	
	
	if( winW < 768 )
	{
		sH = winW-150;
		sW = winW;
		//alert(sH)
	}
	else
	{
		sH = "350";
		sW = "100%";
	}
	
	
	
	jQuery(document).ready(function($) {
	
	  $('#banner-fade').bjqs({
		height      : sH,
		width       : sW,
		responsive  : true,
		centercontrols : true, 
		showmarkers : false,
		usecaptions : false
	  });
	
	});
	
	$(".slider-select").click(function(e) {
        var id_slider = $(this).attr("data-id_slider");
		location.href = "<?php echo base_url() ?>frontend/slider_detail/" + id_slider;
    });
</script>