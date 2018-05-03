<?php
	$sess = $this->session->userdata("lang");
	$submenu = isset($submenu)?$submenu:"";
?>
  <div id="sidebar" class="sidebar col-sm-3 col-md-3">
	<aside class="widget list">
	  <?php
      	foreach( $submenu as $row )
		{
	  ?>
      <header>
		<h3 class="title"><?php echo $sess=="id"?$row->title_id:$row->title_en ?></h3>
	  </header>
	  <ul>
      	<?php
        	foreach( $row->sub as $rc )
			{
		?>
			<li>
                <a href="<?php echo base_url() ?><?php echo $rc->url ?>">
                    <?php echo $sess=="id"?$rc->title_id:$rc->title_en ?>
                </a>
            </li>
		<?php
			}
		?>
	  </ul>
      <?php } ?>
	</aside><!-- .list -->
  </div><!-- .sidebar -->