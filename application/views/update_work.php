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
  <div class="container-fluid">
  	<div class="col-md-12">
  <?php 

  if (isset($feedback)) {
    foreach ($feedback as $key => $value) {
      echo "<p>".$value."</p>";
    }
  }

  if (isset($error)) {
    foreach ($error as $er =>$err) {
      echo '<div class="alert alert-danger">'.$err.'</div>';
    }
  }

  // if the variable Work Exists print form
  if (isset($work)) {
    // Form helper Inserted
    $data_form = array();
    echo form_open_multipart('works/update_work/'.$work_id, $data_form);
    
    div("", "col-md-6"); 
      
      div("", "form-group");  
      echo form_label('Work Title', 'title');
      $data_title = array(
                    'name'        => 'title',
                    'id'          => 'title',
                    'value'       => $work[0]['title'],
                    'maxlength'   => '32',
                    'size'        => '50',
                    'class'   =>"form-control"
                  );
      echo form_input($data_title);
      echo form_error('title');
      div_c();

      div("", "form-group");  
      echo form_label('Superficie', 'superficie');
      if (isset($work[0]['superficie'])) {
        $superficie_val = $work[0]['superficie'];
      }else{
        $superficie_val = 0;
      }
      $data_superficie = array(
                    'name'        => 'superficie',
                    'id'          => 'superficie',
                    'value'       => $superficie_val,
                    'maxlength'   => '11',
                    'size'        => '50',
                    'class'       => "form-control"
                  );
      echo form_input($data_superficie);
      echo form_error('superficie');
      div_c();

      div("", "form-group");  
      echo form_label('Work Description', 'description');
      $data_description = array(
                    'name'        => 'description',
                    'id'          => 'description',
                    'value'       => $work[0]['description'],
                    'maxlength'   => '256',
                    'size'        => '50',
                    'class'   =>"form-control"
                  );
      echo form_textarea($data_description);
      echo form_error('description');
      div_c();

      div("", "form-group");  
      echo form_label('Categoria', 'category');
      $options_category = array(
                    'vivienda_unifamiliar' => 'Vivienda unifamiliares',
                    'vivienda_multifamiliar' => 'Vivienda multifamiliares',
                    'varios'   => 'Varios'
                  );
      echo form_dropdown('category', $options_category,$work[0]['category']);
      echo form_error('category');
      div_c();

      div("", "form-group");  
      echo form_label('Location', 'location');
      $data_location = array(
                    'name'        => 'location',
                    'id'          => 'location',
                    'value'       => $work[0]['location'],
                    'maxlength'   => '64',
                    'size'        => '50',
                    'class'   =>"form-control"
                  );
      echo form_input($data_location);
      echo form_error('location');

      div_c();

      ?>

      <div class="row anchor_lat_lng">
        <p>Click
          <?=anchor_popup('http://www.latlong.net/convert-address-to-lat-long.html', ' AQUI ');?>
        para Conseguir Lat y Lng de direccion para mapa
        </p>
      </div>

      <?php

      div("", "form-group");  
        echo form_label('Lat', 'lat');
        $data_lat = array(
                      'name'        => 'lat',
                      'id'          => 'lat',
                      'value'       => $work[0]['lat'],
                      'maxlength'   => '11',
                      'size'        => '10',
                      'class'   =>"form-control"
                    );
        echo form_input($data_lat);
        echo form_error('lat');
      div_c();

      div("", "form-group");  
        echo form_label('Lng', 'lng');
        $data_lng = array(
                      'name'        => 'lng',
                      'id'          => 'lng',
                      'value'       => $work[0]['lng'],
                      'maxlength'   => '11',
                      'size'        => '10',
                      'class'   =>"form-control"
                    );
        echo form_input($data_lng);
        echo form_error('lng');
      div_c();
      div("", "form-group");
        ?>
        <h4>Amenities</h4>

        <?php
        foreach ($amenities_val as $key => $value) {

          echo form_label($key, 'amenities_radio[]');
          $data_radio = array(
              'name'        => 'amenities_radio[]',
              'value'       => $key,
              'id'          => 'amenities',
              'checked'     => $value,
              );
          echo form_checkbox($data_radio);
        }
        
        
  
      div_c();

    div_c();

    div("", "col-md-6"); 
      
      if (count($images)) {
        foreach ($images as $image) {
        ?>
          <div class="col-md-4 portfolio-item">
                <a href="<?=base_url()?>img/uploads/<?=$image['name']?>" class="portfolio-link" data-toggle="modal" data-lightbox="images_works">
                    <img src="<?=base_url()?>img/uploads/<?=$image['name']?>" class="img-responsive" alt="<?=$image['name']?>">
                </a>

            <?php
              echo form_label($image['name'], 'image_radio[]');
              $data_radio = array(
                  'name'        => 'image_radio[]',
                  'value'       => $image['name'],
                  'id'          => 'image_radio',
                  'checked'     => FALSE
                  );

              echo form_checkbox($data_radio);
            ?>
          </div>

        <?php
        }
      }else{
        echo "<p>No images for this work</p>";
      }
          
      div("", "divide col-md-12");
        div("", "form-group choose_file");
          echo form_label('Choose file', 'upload');
          $data_upload = array(
                        'name'        => 'images[]',
                        'id'          => 'upload'
                      );
          echo form_upload($data_upload,'','multiple');
          echo '<p style="color:grey; font-size:0.8em;">Choose all the files you want to upload with CTRL or SHIFT</p>';
        div_c();
      div_c(); 
    div_c();

    $data_submit = array(
                  'name'        => 'submit',
                  'class'       => 'btn btn-default',
                  'value'       => 'Update work'
                );
    echo form_submit($data_submit);
    echo form_close();
  }

  ?>


  	</div>
  </div>
</section>
  <?php 
  //Insert footer into template
  foreach ($footer as $foot) {
    echo $foot;
  }
  ?>
