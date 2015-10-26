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

<section class="sec-no-padding bg-light-gray <?=get_working_uri_keyword()?>">
    <div class="container-fluid ">

      <?php 
      if (isset($resize_error)) {
        echo '<div class="alert alert-warning">'.$resize_error.'</div>';
      }

      if (isset($error)) {
      	echo '<div class="alert alert-warning">'.$error.'</div>';
      }

      if (isset($db)) {
          echo "<p>".$db."</p>";
      }

      // Form helper Inserted
      $data_form = array();
      echo form_open_multipart('works/create_work', $data_form);

      div("", "form-group");	
      echo form_label('Nombre Obra', 'title');
      $data_title = array(
                    'name'        => 'title',
                    'id'          => 'title',
                    'maxlength'   => '32',
                    'size'        => '50',
                    'class'		=>"form-control"
                  );
      echo form_input($data_title);
      echo form_error('title');
      div_c();

      div("", "form-group");  
      echo form_label('Superficie', 'superficie');
      $data_superficie = array(
                    'name'        => 'superficie',
                    'id'          => 'superficie',
                    'maxlength'   => '11',
                    'size'        => '50',
                    'class'   =>"form-control"
                  );
      echo form_input($data_superficie);
      echo form_error('superficie');
      div_c();


      div("", "form-group");	
      echo form_label('Work Descripcion', 'description');
      $data_description = array(
                    'name'        => 'description',
                    'id'          => 'description',
                    'maxlength'   => '256',
                    'size'        => '50',
                    'class'		=>"form-control"
                  );
      echo form_textarea($data_description);
      echo form_error('description');

      div_c();

      div("", "form-group");	
      echo form_label('Location', 'location');
      $data_location = array(
                    'name'        => 'location',
                    'id'          => 'location',
                    'maxlength'   => '64',
                    'size'        => '50',
                    'class'		=>"form-control"
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
                      'maxlength'   => '11',
                      'size'        => '10',
                      'class'   =>"form-control"
                    );
        echo form_input($data_lng);
        echo form_error('lng');
      div_c();

      div("", "form-group");  
      echo form_label('Categoria', 'category');
      $options_category = array(
                    'vivienda_unifamiliar' => 'Vivienda unifamiliares',
                    'vivienda_multifamiliar' => 'Vivienda multifamiliares',
                    'varios'   => 'Varios'
                    );

      echo form_dropdown('category', $options_category, 'vivienda_unifamiliar');
      echo form_error('category');

      div_c();

      div("", "form-group");
      ?>

        <h4>Amenities</h4>

        <?php
        if (isset($amenities_list)) {
          foreach ($amenities_list as $amenity) {
            if ($amenity != 'id' && $amenity != 'obra_id') {
              echo form_label($amenity, 'amenities_radio[]');
                      $data_radio = array(
                          'name'        => 'amenities_radio[]',
                          'id'          => 'amenities',
                          'value'       => $amenity,
                          'checked'     => FALSE
                          );

              echo form_checkbox($data_radio);
            }
          }
        }
      div_c();



      div("", "form-group");
        echo form_label('Elegi el archivo', 'upload');
        $data_upload = array(
                      'name'        => 'images[]',
                      'id'          => 'upload'
                    );
        echo form_upload($data_upload,'','multiple');
        echo '<p class="choose_files">Choose all the files you want to upload with CTRL or SHIFT</p>';
      div_c();

      ?>
      <p>Las imagenes no deberian ser mas grandes que 1024 x 768</p>
      <?php

      $data_submit = array(
                    'name'        => 'submit',
                    'class'          => 'btn btn-default',
                    'value'       => 'Create work',
                  );
      echo form_submit($data_submit);

      echo form_close();
      ?>

      <a class="btn" href="<?=base_url('web')?>">Cancel</a>

    </div>
</section>
<?php 
//Insert footer into template
foreach ($footer as $foot) {
  echo $foot;
}
?>