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
        
        <div style="float:right; position:absolute; right:30px; top:10px; z-index:100000000">
            <span class="label label-warning set-lang" id="lang-id">ID</span>
            <span class="label label-warning set-lang" id="lang-en">EN</span>
        </div>
        
        
		<div class="search-active col-sm-9 col-md-9">
		  <a href="#" class="close"><span>close</span>×</a>
		  <form name="search-form" class="search-form" method="post" action="<?php echo base_url() ?>frontend/searching_process">
			<input class="search-string form-control" type="search" placeholder="Pencarian" name="query">
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

<div class="breadcrumb-box">
  <div class="container">
    <marquee> News Ticker </marquee>	
  </div>
</div><!-- .breadcrumb-box -->
<style>
	.set-lang{ cursor:pointer; }
</style>

<?php $sess = $this->session->userdata("lang"); ?>

<script>
	$(document).ready(function(e) {
        if( "<?php echo $sess ?>"=="id" )
		{
			$("#lang-id").removeClass("label-warning");
			$("#lang-id").addClass("label-danger");
		}
		else
		{
			$("#lang-en").removeClass("label-warning");
			$("#lang-en").addClass("label-danger");
		}
    });

	/*$(".set-lang").mouseover(function(e) {
        $(".set-lang").removeClass("label-danger");
		$(this).addClass("label-danger");
    });*/
	
	$(".set-lang").click(function(e) {
        var lang = $(this).text();
		location.href = "<?php echo base_url() ?>frontend/set_lang/" + lang + "?curl=<?php echo current_url(); ?>";
    });
</script>