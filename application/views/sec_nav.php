<?php 

if (uri_string()=="web" || uri_string()=="") {
  $service_link ="#services";
  $uni_link ="#vivienda_unifamiliar";
  $multi_link ="#vivienda_multifamiliar";
  $varios_link ="#varios";
  $equipo_link ="#team";
  $contacto_link ="#contact";
}else{
  $service_link = base_url()."#services";
  $uni_link = base_url()."#vivienda_unifamiliar";
  $multi_link = base_url()."#vivienda_multifamiliar";
  $varios_link = base_url()."#varios";
  $equipo_link = base_url()."#team";
  $contacto_link = base_url()."#contact";

}

?>
<nav class="navbar navbar-default navbar-fixed-top " >
    <div class="container-fluid" style="padding-left:0px;">
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header page-scroll container-fluid">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand page-scroll" style="background-color:white;" href="<?php 
                                                          if (uri_string() =="web" || uri_string()=="" ){
                                                              echo '#header';
                                                          }else{
                                                              echo base_url();
                                                          }?>"><?php echo file_get_contents("img/logos/logo_brand_kemelman.svg"); ?><p><span>Estudio</span> <br>ING. KEMELMAN<br><span>Britect SRL</span></p></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
              <a class="page-scroll" data-close="true" href="<?=$service_link?>" style="background-color:transparent;">Servicios</a></li>
          <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Obras <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a class="page-scroll" href="<?=$uni_link?>">Viviendas Unifamiliares</a></li>
              <li><a class="page-scroll" href="<?=$multi_link?>">Viviendas Multifamiliares</a></li>
              <li><a class="page-scroll" href="<?=$varios_link?>">Varios</a></li>
            </ul>
          </li>
          <li>
              <a class="page-scroll" data-close="true" href="<?=$equipo_link?>">Equipo</a>
          </li>
          <li>
              <a class="page-scroll" data-close="true" href="<?=$contacto_link?>">Contacto</a>
          </li>

        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
                <!-- /.navbar-collapse -->
  </div>
                <!-- /.container-fluid -->
</nav>
<div class= "container nav-fix-height"></div>