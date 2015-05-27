<?php
	$sess = $this->session->userdata("lang");
	$slider = isset($slider)?$slider:"";
?>

<div class="cm-padding-bottom-36"></div>

<div class="slider progressive-slider load bottom-padding">
    <div class="container">
      <div class="row">
        <div class="sliders-box">
		<?php
			foreach( $slider as $row )
			{
        ?>
          <div class="col-sm-12 col-md-12">
            <div class="slid row">
              <div class="col-sm-12 col-md-12">
                <img class="slid-img" src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $sess=="id"?$row->picture:$row->picture; ?>" width="1170" height="550" alt="">
              </div>
              <div class="slid-content col-sm-4 col-md-4">
                <h1 class="title"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></h1>
                <p class="descriptions">
                	<?php echo PotongKata($sess=="id"?$row->text_id:$row->text_en, 20); ?>
                </p>
                <button class="btn btn-block btn-default btn-lg">More</button>
              </div>
            </div>
          </div>
		<?php
	        }
        ?>     
    	</div>      
    
        <div class="slider-nav col-sm-4 col-md-4">
          <div class="nav-box">
            <a class="next" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
                <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#838383" points="1,0.001 0,1.001 7,8 0,14.999 1,15.999 9,8 "></polygon>
              </svg>
            </a>
            <a class="prev" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
                <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#838383" points="8,15.999 9,14.999 2,8 9,1.001 8,0.001 0,8 "></polygon>
              </svg>
            </a>
            <div class="pagination switches"></div>	
          </div>
        </div>
      </div>
    </div>
</div>