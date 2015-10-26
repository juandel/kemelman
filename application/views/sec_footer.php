<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6" style="text-align:left;padding-left:30px;">
                <p class="copyright" >Copyright &copy; Estudio Kemelman 2014</p>
            </div>
             
             <div class="col-md-6 col-sm-6" style="text-align:right;padding-right:30px;">
                    <?php
                    if (isset($_SESSION['user_id'])){
                    ?>
                            <a class="page-scroll" href="<?=base_url('users/login')?>">Admin</a>
                            <br>
                            <a class="page-scroll" href="<?=base_url('users/logout')?>">Log Out</a>
                    <?php 
                    }else{
                    ?>
                            <a class="page-scroll" href="<?=base_url('users/login')?>">Log in</a>
                    <?php
                    }
                    ?>
            </div> 
        </div>
    </div>
</footer>