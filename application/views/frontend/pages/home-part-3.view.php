<div class="container">
  <div class="features-promo carousel-box bottom-padding load overflow">
    <div class="title-box">
      <a class="next" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
          <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#fcfcfc" points="1,0.001 0,1.001 7,8 0,14.999 1,15.999 9,8 "></polygon>
        </svg>
      </a>
      <a class="prev" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
          <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#fcfcfc" points="8,15.999 9,14.999 2,8 9,1.001 8,0.001 0,8 "></polygon>
        </svg>
      </a>
      <h1 class="title">Layanan dan Informasi</h1>
    </div>
    <div class="clearfix"></div>
    
    <div class="row">
      <div class="carousel no-responsive">
        <?php $this->load->view("frontend/pages/home-polling.view.php") ?>
        
        <?php $this->load->view("frontend/pages/home-internal.view.php") ?>
    
		<?php $this->load->view("frontend/pages/home-information-system.view.php") ?>
        
        <?php $this->load->view("frontend/pages/home-link.view.php") ?>
        <?php $this->load->view("frontend/pages/home-complaint.view.php") ?>
       
    </div>
  </div><!-- .features-promo -->
</div>