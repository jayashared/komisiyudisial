<?php $sess = $this->session->userdata("lang"); ?>
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-4">
      <?php $this->load->view("frontend/pages/home-agenda.view.php") ?>
    </div>
    
    <div class="col-sm-12 col-md-4">
      <?php $this->load->view("frontend/pages/home-procurement.view.php") ?>
    </div>
    
    <div class="col-sm-12 col-md-4">
      <?php $this->load->view("frontend/pages/home-pers.view.php") ?>
    </div>
    

  </div>
</div>