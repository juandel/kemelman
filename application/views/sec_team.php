<section id="team" class="bg-light-gray">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Nuestro Equipo</h2>
                <h3 class="section-subheading text-muted">Una empresa familiar con trayectoria.</h3>
            </div>
        </div>
        <div class="row">
            <?php 

            if (!isset($team_members)|| (count($team_members)<1)) { ?>
            
            <p>There are no Team members loaded in the Database.</p>

            <?php
            }else{
                // Calculate col number for bootstrap display, depending on how many images there are.
                $num = count($team_members);
                $num = (12/$num);

                foreach ($team_members as $team_member) { ?>
                    <div class="col-sm-<?=$num?>">
                        <div class="team-member">
                            <img src="<?=base_url()?>img/team/<?=$team_member['image_path']?>" class="img-responsive img-circle" alt="">
                            <h4><?=$team_member['name']?></h4>
                            <p class="text-muted"><?=$team_member['position']?></p>
                            <ul class="list-inline social-buttons">
                                
                                <?php if (($team_member['facebook'])): ?>
                                    <li><a href="https://www.facebook.com/<?=$team_member['facebook']?>"><i class="fa fa-facebook"></i></a>
                                    </li>  
                                <?php endif ?>
                                <?php if (($team_member['linkedin'])): ?>
                                    <li><a href="<?=$team_member['linkedin']?>"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                        <?php
                        if (isset($_SESSION['user_id'])){ 
                        ?>
                            <div class="row container-fluid" style="padding:0px;">
                                <h3 class="container" style="margin:-6px 130px auto;">
                                    <a class="btn btn-info" href="<?=base_url().'web/update_member/'.$team_member['id']?>">Update info</a>
                                </h3>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                } 
            }
            ?>            
        </div>

        <?php
        if (isset($_SESSION['user_id'])){ ?>
                
                <div class="row container-fluid bg-light-gray" style="padding:0px;">
                    <h3 class="container" style="margin:60px auto; text-align:center;">
                        <a class="btn btn-info" href="<?=base_url('web/add_team_member')?>">Add a team member</a>
                    </h3>
                </div>
        <?php 
        } 
        ?>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <p class="large text-muted"></p>
            </div>
        </div>
    </div>
</section>