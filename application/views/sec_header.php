<header id="header">
    <div class="container-fluid slider-div theme-showcase" style="padding:0px;">
        <!-- <div class="intro-text">
            <div class="intro-lead-in" style="visibility:hidden;font-size:5em;font-family: Montserrat,Helvetica Neue,Helvetica,Arial,sans-serif; font-style:normal;"><?=page_title()?></div>
            <div class="intro-heading" style="visibility:hidden;font-size:20px; line-height:1.4em;"><?=sub_page_title()?></div>
        </div> -->
        <div id="slider" >
            <ul class="slideme">
                <?php
                $images_rand_key = array_rand($images, 6);
                $images_rand = array();

                foreach ($images_rand_key as $key) {
                    $images_rand[] = $images[$key];
                }

                foreach ($images_rand as $image) {
                    $ext = explode('.', $image);
                    echo "<li>";
                    $image_properties = array(
                        'src'   => base_url('img/slider/'.$ext[0].".".$ext[1]),
                        'alt'   => 'jaddel_slider_image'.$ext[0],
                        'style' => 'width:100%;'
                    );
                    echo img($image_properties);
                    echo "</li>";
                }
             ?>
            </ul>
        	
		    <!-- <img src="images/slide1.jpg" alt="" /> -->
		</div>

		<!-- <div id="htmlcaption" class="nivo-html-caption">
		    <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
		</div> -->
    </div>
</header>