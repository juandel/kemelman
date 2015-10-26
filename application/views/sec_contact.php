<section id="contact">  
  <div class="container-fluid">
      <div class="row title-contact">
          <div class="col-lg-12 text-center">
              <h2 class="section-heading">Contactenos</h2>
              <h5 class=" text-muted" style="color:white;">Estamos para responderle cualquier duda o pregunta.</h5>
          </div>
      </div>
      <div class="row row-form">
           <div class="col-lg-12">

              <?php

              $data_form = array(
                              'style' => 'padding:20px;',
                              'name' =>'contactForm',
                                  );
              echo form_open_multipart('web/email#contact', $data_form);
                  div("", "row");
                      div("", "col-md-6");
                          div("", "form-group");  
                          // echo form_label('Name', 'name');
                              $data_name = array(
                                            'name'        => 'name',
                                            'id'          => 'name',
                                            'maxlength'   => '32',
                                            'placeholder' => 'Nombre',
                                            'class'       =>"form-control"
                                          );
                              echo form_input($data_name);
                              echo form_error('name');
                          div_c();

                          div("", "form-group");  
                          // echo form_label('Email', 'email');
                              $data_email = array(
                                            'name'        => 'email',
                                            'id'          => 'email',
                                            'maxlength'   => '64',
                                            'placeholder' => 'Su email',
                                            'class'       =>"form-control"
                                          );
                              echo form_input($data_email);
                              echo form_error('email');
                          div_c();
                      div_c();

                      div("", "col-md-6");
                          div("", "form-group");  
                          // echo form_label('Your message', 'message');
                              $data_message = array(
                                            'name'        => 'message',
                                            'id'          => 'message',
                                            'maxlength'   => '256',
                                            'placeholder' => 'En que podemos ayudarlo?',
                                            'class'       =>"form-control"
                                          );
                              echo form_textarea($data_message);
                              echo form_error('message');
                          div_c();
                      div_c();

                      div("", "col-md-12 text-center");
                          $data_submit_contact = array(
                                        'name'        => 'submit_contact',
                                        'class'       => 'btn btn-xl',
                                        'id'          => 'contact_button',
                                        'value'       => 'Contact Us',
                                        'type'        => 'submit',
                                        'content'     => '<span class="fa fa-send fa-2x"></span>'
                                      );
                          echo form_button($data_submit_contact);
                      div_c();
                  div_c();   
              echo form_close();
              
              ?>

          </div>
      </div>
      <div class="col-lg-12 text-center">
        <h3 class="section-subheading" style="color:white;">info@estudiokemelman.com.ar</h3>
      </div>
  </div>
</section>