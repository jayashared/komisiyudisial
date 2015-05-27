<?php
	$sess = $this->session->userdata("lang");
	$category = isset($category)?$category:"";
	$tags = isset($tag)?$tag:"";
?>
  <div id="sidebar" class="sidebar col-sm-3 col-md-3">
	<aside class="widget list">
	  <header>
		<h3 class="title"><?php echo $sess=="id"?"Kategori Berita":"News Category" ?></h3>
	  </header>
	  <ul>
      	<?php
        	foreach( $category as $rc )
			{
		?>
			<li>
                <a href="<?php echo base_url() ?>frontend/news/<?php echo $rc->id_news_category ?>">
                    <?php echo $sess=="id"?$rc->news_category_id:$rc->news_category_en ?>
                </a>
            </li>
		<?php
			}
		?>
	  </ul>
	</aside><!-- .list -->
	
	<aside class="widget tags">
	  <header>
		<h3 class="title"><?php echo $sess=="id"?"Tag Berita":"News Tags" ?></h3>
	  </header>
	  <ul class="clearfix">
      	<?php
        	foreach( $tags as $rt )
			{
		?>
		<li>
            <a href="#">
                <?php echo $sess=="id"?$rt->news_tag_id:$rt->news_tag_en ?>
            </a>
        </li>
		<?php
			}
		?>
	  </ul>
	</aside><!-- .tags -->
  </div><!-- .sidebar -->