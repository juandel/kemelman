<?php 
$view_name = uri_string();
$url_title = url_title($view_name,'underscore');

//Insert header into template
foreach ($head as $he) {
  echo $he;
}
?>
<div class="container-fluid " style=" padding: 20px 0px; background-color:rgb(247, 247, 247)">
  <ol class="breadcrumb">
    <li><a href="<?=base_url()?>">Home</a></li>
    <li><?=$view_name;?></li>
  </ol>
  <div class="row">
  	<?php
  	// Form helper Inserted
		$data_form = array('style' => 'padding:20px;');
		echo form_open_multipart('web/add_team_member', $data_form);

		div("", "form-group");	
		echo form_label('Name', 'name');
		$data_name = array(
		              'name'        => 'name',
		              'id'          => 'name',
		              'maxlength'   => '32',
		              'size'        => '50',
		              'style'       => 'width:30%',
		              'class'		=>"form-control"
		            );
		echo form_input($data_name);
		echo form_error('name');
		div_c();

		div("", "form-group");	
		echo form_label('Position', 'position');
		$data_position = array(
		              'name'        => 'position',
		              'id'          => 'position',
		              'maxlength'   => '256',
		              'size'        => '50',
		              'style'       => 'width:30%',
		              'class'		=>"form-control"
		            );
		echo form_input($data_position);
		echo form_error('position');
		div_c();

		div("", "form-group");	
		echo form_label('Facebook', 'facebook');
		$data_facebook = array(
		              'name'        => 'facebook',
		              'id'          => 'facebook',
		              'maxlength'   => '64',
		              'size'        => '50',
		              'style'       => 'width:30%',
		              'class'		=>"form-control"
		            );
		echo form_input($data_facebook);
		echo form_error('facebook');
		div_c();

		div("", "form-group");	
		echo form_label('Linkedin', 'linkedin');
		$data_linkedin = array(
		              'name'        => 'linkedin',
		              'id'          => 'linkedin',
		              'maxlength'   => '64',
		              'size'        => '50',
		              'style'       => 'width:30%',
		              'class'		=>"form-control"
		            );
		echo form_input($data_linkedin);
		echo form_error('linkedin');

		div_c();


		div("", "form-group");
		echo form_label('Choose avatar', 'image_path');
		$data_image_path = array(
		              'name'        => 'image_path',
		              'id'          => 'image_path',
		              'style'       => 'width:50%',
		            );
		echo form_upload($data_image_path,'','multiple');
		div_c();


		$data_submit = array(
		              'name'        => 'submit_team_member',
		              'class'          => 'btn btn-default',
		              'value'       => 'Add member',
		            );
		echo form_submit($data_submit);
		echo form_close();
	?>
  </div>
</div>

<?php 
//Insert footer into template
foreach ($footer as $foot) {
  echo $foot;
}
?>