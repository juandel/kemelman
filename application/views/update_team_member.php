<?php 
$view_name = uri_string();
$url_title = url_title($view_name,'underscore');

if (!isset($image_path)) {
	$image_path = $team_member['image_path'];
}

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
  	if (isset($error)) {
		echo '<div class="alert alert-danger" style="background-color:white; border:none">'.$error.'</div>';
  	}
  	// Form helper Inserted
		$data_form = array('style' => 'padding:40px;');
		echo form_open_multipart('web/update_member/'.$team_member['id'], $data_form);

		div("", "form-group");	
			echo form_label('Nombre', 'name');
			$data_name = array(
			              'name'        => 'name',
			              'id'          => 'name',
			              'maxlength'   => '32',
			              'size'        => '50',
			              'style'       => 'width:30%',
			              'class'		=> 'form-control',
			              'value'		=>	$team_member['name']
			            );
			echo form_input($data_name);
			echo form_error('name');
		div_c();

		div("", "form-group");	
			echo form_label('Cargo', 'position');
			$data_position = array(
			              'name'        => 'position',
			              'id'          => 'position',
			              'maxlength'   => '256',
			              'size'        => '50',
			              'style'       => 'width:30%',
			              'class'		=> 'form-control',
			              'value'		=>	$team_member['position']
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
			              'class'		=> 'form-control',
			              'value'		=>	$team_member['facebook']
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
			              'class'		=> 'form-control',
			              'value'		=>	$team_member['linkedin']
			            );
			echo form_input($data_linkedin);
			echo form_error('linkedin');

		div_c();

		div("","team-member");
			$image_members_properties = array(
	        'src'   => base_url().'img/team/'.$image_path,
	        'alt'   => 'Team member: '.$team_member['name'].' - '.$team_member['position'],
	        'class' => 'img-responsive img-circle',
	        'title' => 'Team member: '.$team_member['name'].' - '.$team_member['position'],
	        'style' => 'margin-left:5px;'
 	);
			echo img($image_members_properties);

		div_c();
                   
		div("", "form-group");
			echo form_label('Elegir imagen', 'image_path');
			$data_image_path = array(
			              'name'        => 'image_path',
			              'id'          => 'image_path',
			              'style'       => 'width:50%',
			            );
			echo form_upload($data_image_path,'','multiple');
		div_c();

		div("", "form-group");
		$data_submit = array(
		              'name'        => 'submit_team_member_edit',
		              'class'       => 'btn btn-default row',
		              'value'       => 'Actualizar info miembro',
		              'style'		=> 'margin-top:20px;'
		            );
		echo form_submit($data_submit);
		echo form_close();
		div_c();
	?>
  </div>
</div>

<?php 
//Insert footer into template
foreach ($footer as $foot) {
  echo $foot;
}
?>