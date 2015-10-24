		</div>
		<!-- jQuery -->
		<script src="<?=base_url()?>js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="<?=base_url()?>js/bootstrap.min.js"></script>

		<!-- Plugin JavaScript -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

		<!-- Contact Form JavaScript -->
		<script src="<?=base_url()?>js/jqBootstrapValidation.js"></script>

		<!-- Custom Theme JavaScript -->
		<script src="<?=base_url()?>js/agency.js"></script>

		<!-- Lightbox -->
		<script src="<?=base_url()?>js/lightbox.min.js"></script>

		<!-- google maps -->
		<script src="https://maps.googleapis.com/maps/api/js"></script>
		<script>
			function initialize() {
				var mapCanvas = document.getElementById('map');
				var lat = parseFloat(mapCanvas.dataset.lat);
				var lng = parseFloat(mapCanvas.dataset.lng);
				var obra_name = document.getElementById('obra_title').innerHTML;

				var myLatLng = {lat:lat, lng:lng};
				

				var mapOptions = {
					center: myLatLng,
					zoom: 15,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					scrollwheel: false
				}

				// Tell maps API which map and what options.
				var map = new google.maps.Map(mapCanvas, mapOptions);

				var marker = new google.maps.Marker({
	    			position: myLatLng,
	    			map: map,
					title: obra_name
				});
			}

			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		<?php 
		// $slider = array(1,0); 
		// $slider_rand_key = array_rand($slider, 1);
		// echo ($slider_rand_key);
		// if ($slider[$slider_rand_key]<1) {
		?>


		<script src="<?=base_url()?>js/jquery.slideme2.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#slider').slideme({
					arrows: true,
					resizable: {
						width: 1024,
						height: 600,
					},
					autoslide: true,
					autoslideHoverStop : true,
					css3 : true,
					loop : true,
					transition : 'zoom',
					speed : 4000,
					touch : true,

					labels : {
						next: '<span class="fa fa-arrow-right fa-2x"></span>',
						prev: '<span class="fa fa-arrow-left fa-2x"></span>'
					}
				});
			})		
		</script>

		<?php
		// }else{
		?>
		
		<!-- NIVO Slider  

		 <script src="<?=base_url()?>js/jquery.nivo.slider.js" type="text/javascript"></script>
		 <script type="text/javascript">
		// 	$(document).ready(function() {
		// 	    $('#slider').nivoSlider();
		// 	});
		// </script>

		<?php
		// }
		?>
		-->

		<!-- Google Analytics -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-63980731-1', 'auto');
		  ga('send', 'pageview');

		</script>

	<!-- CLOSE BODY TAG -->
	</body>

<!-- CLOSE HTML TAG -->
</html>