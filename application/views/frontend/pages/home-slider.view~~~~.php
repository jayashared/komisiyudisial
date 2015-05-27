<?php
	$sess = $this->session->userdata("lang");
	$slider = isset($slider)?$slider:"";
?>
<div class="slider rs-slider load">
  <div class="tp-banner-container">
	<div class="tp-banner">
	  <ul>
      	<?php
        	foreach( $slider as $row )
			{
		?>
		<li data-delay="7000" data-transition="fade" data-slotamount="7" data-masterspeed="2000">
		  <div class="elements">
			<h2 class="tp-caption lft skewtotop title"
			  data-x="722"
			  data-y="101"
			  data-speed="1000"
			  data-start="1700"
			  data-easing="Power4.easeOut"
			  data-endspeed="500"
			  data-endeasing="Power1.easeIn">
			  <strong><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></strong>
			</h2>
			
			<div class="tp-caption lfr skewtoright description"
			  data-x="707"
			  data-y="189"
			  data-speed="1000"
			  data-start="1500"
			  data-easing="Power4.easeOut"
			  data-endspeed="500"
			  data-endeasing="Power1.easeIn"
			  style="max-width: 480px">
			  <p>
              	<?php echo PotongKata($sess=="id"?$row->text_id:$row->text_en, 20); ?>
              </p>
			</div>

			<a href="<?php echo base_url() ?>frontend/slider_detail/<?php echo $row->id_slider ?>/<?php echo $sess=="id"?SEO($row->title_id):SEO($row->title_en); ?>"
			  class="btn cherry tp-caption lfb btn-default"
			  data-x="722"
			  data-y="342"
			  data-speed="1000"
			  data-start="1700"
			  data-easing="Power4.easeOut"
			  data-endspeed="500"
			  data-endeasing="Power1.easeIn">
			  <?php echo $sess=="id"?"Selengkapnya":"Read More"; ?>
			</a>
		  </div>
		  <img src="<?php echo base_url() ?>assets/uploads/picture/<?php echo $sess=="id"?$row->picture:$row->picture; ?>" alt="" data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
		</li>
		<?php
			}
		?>
		
	  </ul>
	  <div class="tp-bannertimer"></div>
	</div>
  </div>
</div>