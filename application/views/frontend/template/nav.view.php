<?php
	$sitemap = isset($sitemap["sitemap"])?$sitemap["sitemap"]:"";
	$sess = $this->session->userdata("lang");
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
                <li class="parent">
                  <a href="#"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></a>
                  <ul class="sub">
                    <?php foreach( $row->sub_sitemap as $r ){ ?>
                        <li><a href="<?php echo base_url() . $r->url ?>"><?php echo $sess=="id"?$r->title_id:$r->title_en; ?></a></li>
                        
                    <?php } ?>
                  </ul>
                </li>	
            <?php
                }
                else
                {
            ?>
                <li class=""><a href="<?php echo base_url() . $row->url ?>"><?php echo $sess=="id"?$row->title_id:$row->title_en; ?></a></li>
            <?php
                }
            ?>
        <?php
            }
        ?>
      </ul>
    </nav>
</div>