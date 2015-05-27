<?php $sess = $this->session->userdata("lang"); ?>
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-4">
      <?php $this->load->view("frontend/pages/home-announcement.view.php") ?>
    </div>
    
    <div class="col-sm-12 col-md-4">
      <?php $this->load->view("frontend/pages/home-agenda.view.php") ?>
    </div>
    
    
    <div class="col-sm-12 col-md-4">
      <?php $this->load->view("frontend/pages/home-article.view.php") ?>
    </div>
  </div>
</div>