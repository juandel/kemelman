<?php 
	$view_name = uri_string();
	$url_title = url_title($view_name);

	//Insert header into template
	foreach ($head as $he) {
	  echo $he;
	}
?>
	<ol class="breadcrumb">
		<li><a href="<?=base_url()?>">Home</a></li>
  		<li><?=$view_name;?></li>
	</ol>
	<section class="bg-light-gray sec-no-padding <?=get_working_uri_keyword()?>">
		<div class="container-fluid" >
	<?php
		if (isset($work[0])) {
	?>
			<div class="row <?=get_working_uri_keyword()?>_images">

				<?php 

				foreach ($images as $value) {
				?>

					 <div class="col-md-4 col-sm-6 portfolio-item">
					    <div>
					        <a href="<?=base_url()?>img/uploads/<?=$value['name']?>" class="portfolio-link" data-toggle="modal" data-lightbox="images_works">
					            <img src="<?=base_url()?>img/uploads/<?=$value['name']?>" class="img-responsive img-thumbnail">
					        </a>
					    </div>
					</div>

				<?php
				}

				?>
			</div>
			<div class="<?=get_working_uri_keyword()?>_description row bg-light-gray" >
				<div class="col-md-offset-1 col-md-5">
					<h2 id="obra_title"><?=$work[0]['title']?></h2>
					<h5>
					<?php 

						$categories_array = explode("_", $work[0]['category']);
						foreach ($categories_array as $category_array) {
							echo $category_array." ";
						}

					 ?>
					</h5>

					<p class="description"><?=$work[0]['description']?></p>
				</div>
				<div class="col-md-offset-1 col-md-5">
					<div class="row">
						<h4>Amenities:</h4>
					</div>
					
					<div class="row amenities">
						<?php
						
						// Loop through and check which amenity has a value of 1 and keep that one.
						foreach ($amenities_raw as $amenity_key => $amenity_value) {
							if ($amenity_value ) {
						?>
						<div class="col-md-3">
							<img class="center-block" src="<?=base_url()?>img/logos/<?=$amenity_key?>-01.svg">
							<h6><?=$amenity_key?></h6>
						</div>
						
						<?php
							}
						}
					?>
					</div>
				</div>

			</div>
			<?php if ($work[0]['lat'] || $work[0]['lng']): ?>

				<div class="row sec-no-padding">
					<div id="map" data-lat="<?=$work[0]['lat'] ?>" data-lng="<?=$work[0]['lng'] ?>"style="height: 400px;">
					</div>
				</div>

			<?php endif ?>
			
		<?php if (isset($_SESSION['user_id'])){ ?>
			
			<div class="row bg-light-gray <?=get_working_uri_keyword()?>_logged_in">
				<h3 class="container">
					<a class="btn btn-info" href="<?=base_url('works/update_work/'.$work[0]['id'])?>">Edit Work</a>

					<a id="deleteButton" class="btn btn-danger" href="<?=base_url('works/delete_work/'.$work[0]['id'])?>">Delete Work</a>
				</h3>
			</div>

		<?php } ?>
			
	
	<?php 
	}
	?>
		</div>
	</section>

	<?php
	//Insert footer into template
	foreach ($footer as $foot) {
	  echo $foot;
	}

	?>
