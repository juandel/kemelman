<?php 

foreach ($head as $he) {
  echo $he;
}

?>
<section id="login">
    <div class="container-fluid">
        <div class="row">
            
        </div>
        <div class="row">
            <div class="col-lg-12">
              <?php
              if (!$error==0) {
                echo '<div class="alert alert-danger" style="background-color:white; border:none">'.$error.'</div>';
              }

               $data_form = array('style' => 'padding:20px;');
                echo form_open('users/login', $data_form);

                div("", "form-group");  
                echo form_label('User', 'username');
                $data_user = array(
                              'name'        => 'username',
                              'id'          => 'username',
                              'maxlength'   => '32',
                              'size'        => '50',
                              'style'       => 'width:30%',
                              'class'       =>"form-control"
                            );
                echo form_input($data_user);
                echo form_error('username');
                div_c(); 

                  div("", "form-group");  
                echo form_label('Password', 'password');
                $data_password = array(
                              'name'        => 'password',
                              'id'          => 'password',
                              'maxlength'   => '32',
                              'size'        => '50',
                              'style'       => 'width:30%',
                              'class'       =>"form-control"
                            );
                echo form_password($data_password);
                echo form_error('password');
                div_c();    

                $data_submit = array(
                              'name'        => 'submit_user',
                              'class'          => 'btn btn-default',
                              'value'       => 'Login',
                            );
                echo form_submit($data_submit);
                echo form_close();
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