<section id="obras" class="bg-light-gray">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Obras</h2>
                <h3 class="section-subheading text-muted">Algunas de nuestras obras.</h3>
            </div>
        </div>
        <div class="row container-fluid">
            
        <?php 
        if (isset($vivienda_unifamiliar)) {

            echo '<div class="row '.$vivienda_unifamiliar[0]['category'].'"id="'.$vivienda_unifamiliar[0]['category'].'">';
            echo "<div class='row col-md-6 col-md-offset-3'><h4>Vivienda Unifamiliares</h4></div>";;

            foreach ($vivienda_unifamiliar as $viv_uni) {
                $images = $viv_uni['images'];

                // foreach work it will show only first image
                if(isset($images[0])){
        ?>             

                    <div class="col-md-4 col-sm-6 portfolio-item" id="<?=$viv_uni['category']?>">
                        <a href="<?=base_url()?>works/show_work/<?=$viv_uni['id']?>" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                     <p ><?=$viv_uni['description']?></p>
                                </div>
                            </div>
                            <img src="<?=base_url()?>img/uploads/<?=$images[0]['name']?>" class="img-responsive" >
                        </a>
                        <div class="portfolio-caption">
                            <h6 class="col-md-9"style="text-align:left;"><?=$viv_uni['title']?></h6>
                            <p class="col-md-3"style="text-align:left;"><?=$viv_uni['superficie']?> m2</p>
                        </div>
                    </div>

        <?php
                }                
            }
            echo "</div>";
        }
        if (isset($vivienda_multifamiliar)) {

            echo '<div class="row '.$vivienda_multifamiliar[0]['category'].'"id="'.$vivienda_multifamiliar[0]['category'].'">';
            echo "<div class='row col-md-6 col-md-offset-3' ><h4>Vivienda Multifamiliares</h4></div>";

            foreach ($vivienda_multifamiliar as $viv_multi) {
                $images = $viv_multi['images'];
                // foreach work it will show only first image
                if(isset($images[0])){
        ?>             

                    <div class="col-md-4 col-sm-6 portfolio-item" id="<?=$viv_multi['category']?>">
                        <a href="<?=base_url()?>works/show_work/<?=$viv_multi['id']?>" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                     <p ><?=$viv_multi['description']?></p>
                                </div>
                            </div>
                            <img src="<?=base_url()?>img/uploads/<?=$images[0]['name']?>" class="img-responsive" >
                        </a>
                        <div class="portfolio-caption">
                            <h6 class="col-md-9"style="text-align:left;"><?=$viv_multi['title']?></h6>
                            <p class="col-md-3"style="text-align:left;"><?=$viv_multi['superficie']?> m2</p>
                        </div>
                    </div>

        <?php
                }                
            }
            echo "</div>";
        }
        

        if (isset($edificios)) {

            echo '<div class="row '.$edificios[0]['category'].'"id="'.$edificios[0]['category'].'">';
            echo "<div class='row col-md-6 col-md-offset-3'><h4>Varios</h4></div>";

            foreach ($edificios as $edificio) {
                $images = $edificio['images'];
                // foreach work it will show only first image
                if(isset($images[0])){
        ?>             

                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <a href="<?=base_url()?>works/show_work/<?=$edificio['id']?>" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                     <p ><?=$edificio['description']?></p>
                                </div>
                            </div>
                            <img src="<?=base_url()?>img/uploads/<?=$images[0]['name']?>" class="img-responsive" >
                        </a>
                        <div class="portfolio-caption">
                            <h6 class="col-md-9"style="text-align:left;"><?=$edificio['title']?></h6>
                            <p class="col-md-3"style="text-align:left;"><?=$edificio['superficie']?> m2</p>
                        </div>
                    </div>

        <?php
                }                
            }
            echo "</div>";

        }elseif (!isset($_SESSION['user_id'])){
        ?>
            
            <div class="row">
                <h4>No Works! You must log in to create works.</h4>
            </div>

        <?php 
        }
        if (isset($_SESSION['user_id'])) {
        ?>
        <div class="row agregar-obra">
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="<?=base_url()?>works/create_work" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <i class="glyphicon glyphicon-picture" style=" width:100%; text-align:center; font-size:140px; background:grey;"></i>
                    
                </a>
                <div class="portfolio-caption">
                    <h3 style="text-align: center;">Agregar obra a la web</h3>
                </div>
            </div>
        </div>
            
        <?php
        }
        ?>


        </div>
    </div>
</section>