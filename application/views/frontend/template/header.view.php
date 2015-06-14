<?php $sess = $this->session->userdata("lang"); ?>
<div id="top-box">
  <div class="top-box-wrapper bg-danger">
	<div class="container">
	  <div class="row">
		<div class="col-xs-9 col-sm-2">
		  <div class="btn-group language btn-select">
			<a class="btn dropdown-toggle btn-default" role="button" data-toggle="dropdown" href="#">
			  <span class="visible-xs"></span><!-- 
			  --><?php echo $sess=="id"?"Bahasa":"English"; ?>
			  <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
			  <li class="set-lang" data-lang="EN" id="lang-id"><a href="#">English</a></li>
			  <li class="set-lang" data-lang="ID" id="lang-en"><a href="#">Bahasa</a></li>
			</ul>
		  </div>
		  
		</div>
		<?php
			$newsticker = isset($sitemap["newsticker"])?$sitemap["newsticker"]:"";
		?>
		<div class="col-xs-3 col-sm-10">
            <marquee scrolldelay="100" onmouseover="stop()" onmouseout="start()" style="margin:0px !important; color:#FFFFFF;"> 
                <strong>Info Update: </strong>
				<?php foreach( $newsticker as $rn ){ ?>
                    <i class="fa fa-calendar"></i> <?php echo TglIndo($rn->date) ?> - 
                    <a href="<?php echo base_url() ?>frontend/news_detail/<?php echo $rn->id_news ?>/<?php echo $sess=="id"?SEO($rn->title_id):SEO($rn->title_en); ?>" style="color:#FFF;">
                        <?php echo $sess=="id"?$rn->title_id:$rn->title_en; ?>
                    </a> | 
                <?php } ?>
            </marquee>
		</div>
	  </div>
	</div>
  </div>
</div><!-- #top-box -->

<header class="header header-two">
  <div class="header-wrapper">   
    <div class="container">           
      <div class="row">
		<div class="col-xs-6 col-md-2 col-lg-3 logo-box">
		  <div class="logo">
			<a href="<?php echo base_url() ?>frontend">
			  <img src="<?php echo base_url() ?>assets/images/logo-ky.png" class="logo-img" alt="">
			</a>
		  </div>
		</div><!-- .logo-box -->
      
		<div class="col-xs-6 col-md-10 col-lg-9 right-box">
          <div class="right-box-wrapper">    
          
            <div class="header-icons">
			  <div class="search-header hidden-600">
				<a href="#">
				  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
					<path d="M12.001,10l-0.5,0.5l-0.79-0.79c0.806-1.021,1.29-2.308,1.29-3.71c0-3.313-2.687-6-6-6C2.687,0,0,2.687,0,6
					s2.687,6,6,6c1.402,0,2.688-0.484,3.71-1.29l0.79,0.79l-0.5,0.5l4,4l2-2L12.001,10z M6,10c-2.206,0-4-1.794-4-4s1.794-4,4-4
					s4,1.794,4,4S8.206,10,6,10z"></path>
					<image src="<?php echo base_url() ?>assets/progressive_template_v2.2.6_stable/img/png-icons/search-icon.png" alt="" width="16" height="16" style="vertical-align: top;">
				  </svg>
				</a>
			  </div>
			</div><!-- .header-icons -->
			<div class="primary">
				<?php $this->load->view("frontend/template/nav.view.php") ?>
			</div><!-- .primary -->
		  </div>
		</div>
 
		<div class="search-active col-sm-9 col-md-9">
		  <a href="#" class="close"><span>close</span>×</a>
		  <form name="search-form" class="search-form" method="get" action="<?php echo base_url() ?>frontend/searching_process">
			<input class="search-string form-control" type="search" placeholder="<?php echo $sess=="id"?"Pencarian":"Search"; ?>" name="query">
			<button class="search-submit">
			  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
				<path fill="#231F20" d="M12.001,10l-0.5,0.5l-0.79-0.79c0.806-1.021,1.29-2.308,1.29-3.71c0-3.313-2.687-6-6-6C2.687,0,0,2.687,0,6
				s2.687,6,6,6c1.402,0,2.688-0.484,3.71-1.29l0.79,0.79l-0.5,0.5l4,4l2-2L12.001,10z M6,10c-2.206,0-4-1.794-4-4s1.794-4,4-4
				s4,1.794,4,4S8.206,10,6,10z"></path>
				<image src="<?php echo base_url() ?>assets/progressive_template_v2.2.6_stable/img/png-icons/search-icon.png" alt="" width="16" height="16" style="vertical-align: top;">
			  </svg>
			</button>
		  </form>
		</div>
	  </div>
	</div>
  </div><!-- .header-wrapper -->
</header><!-- .header -->
<br />

<style>
	.set-lang{ cursor:pointer; }
</style>

<?php $sess = $this->session->userdata("lang"); ?>

<script>
	$(document).ready(function(e) {
        
    });

	/*$(".set-lang").mouseover(function(e) {
        $(".set-lang").removeClass("label-danger");
		$(this).addClass("label-danger");
    });*/
	
	$(".set-lang").click(function(e) {
        var lang = $(this).attr("data-lang");
		//alert(lang)
		location.href = "<?php echo base_url() ?>frontend/set_lang/" + lang + "?curl=<?php echo current_url(); ?>";
    });
</script>