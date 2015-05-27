<style>
	.link a:hover { text-decoration:underline; }
</style>
<?php
	$information_system = isset($information_system)?$information_system:"";
	$sess = $this->session->userdata("lang");
?>

<div class="text-small features-block col-sm-3 col-md-3">
  <div class="header-box" href="#">
    <div class="icon-box">
      <i class="fa fa-desktop"></i>
    </div>
    <h6><?php echo $sess=="id"?"Sistem Informasi":"Information System"; ?></h6>
  </div>
	<nav>
    <ul class="link">
  	<?php foreach( $information_system as $row ){ ?>
		<li style="list-style:circle;">
            <a href="<?php echo $row->url ?>" target="_blank">
            	<?php echo $sess=="id"?$row->title_id:$row->title_en; ?>
            </a>
        </li>
  	<?php } ?>
    </ul>
    </nav>
</div><!-- .features-block -->