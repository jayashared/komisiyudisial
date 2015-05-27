<?php
	$sess = $this->session->userdata("lang");
	$category = isset($category)?$category:"";
	$publication_year = isset($publication_year)?$publication_year:"";
?>
  <div id="sidebar" class="sidebar col-sm-2 col-md-2">
	
    <aside class="widget list">
	  <header>
		<h3 class="title"><?php echo $sess=="id"?"Arsip":"Archive" ?></h3>
	  </header>
	  <ul>
      	<?php
        	foreach( $publication_year as $ry )
			{
		?>
			<li><a href="<?php echo base_url() ?>frontend/publication/<?php echo $this->uri->segment(3) ?>/<?php echo $ry->publication_year ?>">
				<?php echo $ry->publication_year ?></a>
            </li>
		<?php
			}
		?>
	  </ul>
	</aside><!-- .list -->
    
    <aside class="widget list" style="display:none;">
	  <header>
		<h3 class="title"><?php echo $sess=="id"?"Publikasi":"Publication" ?></h3>
	  </header>
	  <ul>
      	<?php
        	foreach( $category as $rc )
			{
		?>
			<li><a href="#"><?php echo $sess=="id"?$rc->title_id:$rc->title_en ?></a></li>
		<?php
			}
		?>
	  </ul>
	</aside><!-- .list -->
	
  </div><!-- .sidebar -->