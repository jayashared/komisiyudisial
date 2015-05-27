<style>
	.link a:hover { text-decoration:underline; }
</style>
<?php
	$link = isset($link)?$link:"";
	$sess = $this->session->userdata("lang");
?>

<div class="text-small features-block col-sm-3 col-md-3">
  <div class="header-box" href="#">
    <div class="icon-box">
      <i class="fa fa-link"></i>
    </div>
    <h6><?php echo $sess=="id"?"Link Terkait":"Related links"; ?></h6>
  </div>
	<nav>
    <ul class="link">
  	<?php foreach( $link as $row ){ ?>
		<li style="list-style:circle;">
            <a href="<?php echo $row->url ?>" target="_blank">
            	<?php echo $sess=="id"?$row->title_id:$row->title_en; ?>
            </a>
        </li>
  	<?php } ?>
    </ul>
    </nav>
</div><!-- .features-block -->