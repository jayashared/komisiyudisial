<?php
	$sitemap = isset($sitemap)?$sitemap:"";
?>
<div class="navbar navbar-default" role="navigation">
<button type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target=".primary .navbar-collapse">
  <span class="text">Menu</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</button>
<nav class="collapse collapsing navbar-collapse">
  <ul class="nav navbar-nav navbar-center">
  	<?php
    	foreach( $sitemap as $row )
		{
	?>
	    
        <?php
        	if( !empty( $row->sub_sitemap ) )
			{
		?>
        	<li class="parent item-primary item-bg">
              <a href="#"><?php echo $row->title_id ?></a>
              <ul class="sub">
                <?php foreach( $row->sub_sitemap as $r ){ ?>
                	<li><a href="<?php echo $r->url ?>"><?php echo $r->title_id ?></a></li>
                <?php } ?>
              </ul>
            </li>	
        <?php
			}
			else
			{
		?>
        	<li class=""><a href="<?php echo base_url() . "frontend." . $row->url ?>"><?php echo $row->title_id ?></a></li>
        <?php
			}
		?>
    <?php
		}
	?>
    
  </ul>
</nav>
</div>