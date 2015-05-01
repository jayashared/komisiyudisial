<?php 
	
	$sitemap = isset($extra['sitemap'])?$extra['sitemap']:"";
?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <?php
            	foreach( $sitemap as $row )
				{
			?>
            <li id="<?php echo $row->name ?>">
                <a href="<?php echo !empty($row->url)?base_url() . 'admin/' . $row->url:"#" ?>"><?php echo $row->icon ?> <?php echo $row->title_id ?>
                <?php echo !empty($row->sub_sitemap)?'<span class="fa arrow"></span>':'' ?>
                </a>
                <?php if( !empty($row->sub_sitemap) ){ ?>
                <ul class="nav nav-second-level">
				<?php } ?>
				<?php
                	foreach( $row->sub_sitemap as $rsub )
					{
				?>
                		
                            <li>
                                <a href="<?php echo base_url() ?>admin/<?php echo $rsub->url ?>"><?php echo $rsub->title_id ?></a>
                            </li>                        
                <?php		
					}
                ?>
                <?php if( !empty($row->sub_sitemap) ){ ?>
                </ul>
                <?php } ?>
                <!-- /.nav-second-level -->
            </li>
            <?php
				}
			?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->