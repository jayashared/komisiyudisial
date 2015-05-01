<?php $sess = $this->session->userdata("lang"); ?>
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-3">
      <div class="title-box">
        <a href="#" class="btn btn-default">
			<?php echo $sess=="id"?"Berkas":"All Post"; ?>
        <span class="glyphicon glyphicon-arrow-right"></span></a>
        <h2 class="title"><?php echo $sess=="id"?"Agenda":"Agenda"; ?></h2>
      </div>
      <?php $agenda = isset($agenda)?$agenda:""; ?>
      <ul class="latest-posts">
        <?php  
			echo empty($agenda)?"Data not Found":"";
			foreach( $agenda as $ra )
			{
		?>
        <li>
          <div class="meta">
            <span><?php echo $sess=="id"?$ra->address_id:$ra->address_en; ?></span>, 
            <span class="time"><?php echo $sess=="id"?$ra->time_id:$ra->time_en; ?></span>
          </div>
          <div class="description">
            <a href="#" >
              	<strong class="text-primary"><?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?></strong>
            </a>
            <p>
            	<?php echo $sess=="id"?PotongKata($ra->text_id, 50):PotongKata($ra->text_en, 50); ?>
            </p>
          </div>
        </li>
        <?php
			}
		?>
      </ul>
    </div>
    
    <div class="col-sm-12 col-md-3">
      <div class="title-box">
        <a href="#" class="btn btn-default"><?php echo $sess=="id"?"Berkas":"All Post"; ?> <span class="glyphicon glyphicon-arrow-right"></span></a>
        <h2 class="title"><?php echo $sess=="id"?"Informasi Lelang":"Procurement"; ?></h2>
      </div>
      
      <?php $procurement = isset($procurement)?$procurement:""; ?>
      
      <ul class="latest-posts">
	  <?php  
        echo empty($procurement)?"Data not Found":"";
        foreach( $procurement as $ra )
        {
      ?>
        <li>
          <div class="meta">
            <span class="time"><?php echo TglIndo($ra->modified_date) ?></span>
          </div>
          <div class="description">
            <a href="#" >
                <strong class="text-primary"><?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?></strong>
            </a>
            <p>
                <?php echo $sess=="id"?PotongKata($ra->text_id, 50):PotongKata($ra->text_en, 50); ?>
            </p>
          </div>
        </li>
      <?php } ?>
      </ul>
    </div>
    
    <div class="col-sm-12 col-md-3">
      <div class="title-box">
        <a href="#" class="btn btn-default"><?php echo $sess=="id"?"Berkas":"All Post"; ?>  <span class="glyphicon glyphicon-arrow-right"></span></a>
        <h2 class="title"><?php echo $sess=="id"?"Pers Release":"Siaran Pers"; ?></h2>
      </div>
      
      <?php $pers_release = isset($pers_release)?$pers_release:""; ?>
      
      <ul class="latest-posts">
        <?php  
			echo empty($pers_release)?"Data not Found":"";
			foreach( $pers_release as $ra )
			{
		  ?>
			<li>
			  <div class="meta">
				<span class="time"><?php echo TglIndo($ra->modified_date) ?></span>
			  </div>
			  <div class="description">
				<a href="#" >
					<strong class="text-primary"><?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?></strong>
				</a>
				<p>
					<?php echo $sess=="id"?PotongKata($ra->text_id, 50):PotongKata($ra->text_en, 50); ?>
				</p>
			  </div>
			</li>
		  <?php } ?>
      </ul>
    </div>
    
    <div class="col-sm-12 col-md-3">
      <div class="title-box">
        <a href="#" class="btn btn-default">All posts <span class="glyphicon glyphicon-arrow-right"></span></a>
        <h2 class="title"><?php echo $sess=="id"?"Artikel":"Article"; ?></h2>
      </div>
      <?php
	  	$article = isset($article)?$article:"";
      	echo empty($article)?"Data not Found":"";
	  ?>
      <ul class="latest-posts">
        <?php
        	foreach( $article as $ra )
			{
		?>
        <li>
          <div class="meta">
            <span class="time"><?php echo TglIndo($ra->modified_date) ?></span>
          </div>
          <div class="description">
            <a href="#" >
              	<strong class="text-primary"><?php echo $sess=="id"?$ra->title_id:$ra->title_en; ?></strong>
            </a>
            <p>
            	<?php echo $sess=="id"?PotongKata($ra->text_id, 50):PotongKata($ra->text_en, 50); ?>
            </p>
          </div>
        </li>
        <?php
			}
		?>
      </ul>
    </div>
  </div>
</div>