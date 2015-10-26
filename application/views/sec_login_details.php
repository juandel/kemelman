<?php 

foreach ($head as $he) {
  echo $he;
}

?>
<section id="login_details">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <?php
              if (!$error==0) {
                echo '<div class="alert alert-danger" style="background-color:white; border:none">'.$error.'</div>';
              }
              echo validation_errors();

              if (isset($_SESSION['user_id'])){

                $data_form = array('style' => 'padding:20px;');
                echo form_open('users/login_details', $data_form);

                div("", "form-group");  
                echo "<h4> Cambiar contraseña para el usuario <span style='color:grey;'>". $user['username']. ".</span></h4>";

                echo form_label('Password', 'password1');
                $data_password1 = array(
                              'name'        => 'password1',
                              'id'          => 'password1',
                              'maxlength'   => '32',
                              'size'        => '50',
                              'style'       => 'width:30%',
                              'class'       =>"form-control"
                            );
                echo form_password($data_password1);
                echo form_error('username');
                div_c(); 

                  div("", "form-group");  
                echo form_label('Verificar Password', 'password2');
                $data_password2 = array(
                              'name'        => 'password2',
                              'id'          => 'password2',
                              'maxlength'   => '32',
                              'size'        => '50',
                              'style'       => 'width:30%',
                              'class'       =>"form-control"
                            );
                echo form_password($data_password2);
                echo form_error('password');
                div_c();    

                $data_submit = array(
                              'name'        => 'change_password',
                              'class'          => 'btn btn-default',
                              'value'       => 'Cambiar contraseña',
                            );
                echo form_submit($data_submit);
                echo form_close();

              }else{
              ?>

              <p class="alert alert-danger" style="background-color:white; border:none">
                Necesitas estar loggueado como admin para cambiar la contraseña.
              </p>
              
              <?php

              }

              ?>
            </div>
        </div>
    </div>
</section>
<?php 
foreach ($footer as $foot) {
  echo $foot;
} 
?>