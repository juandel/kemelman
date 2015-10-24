<?php 
//Insert header into template
foreach ($head as $he) {
  echo $he;
}
?>
<div class="container-fluid " style=" padding: 70px 0px; background-color:rgb(247, 247, 247); text-align:center;">
	<?php
	if (isset($sent)) {
		echo '<h2 class="section-heading">'.$sent.'</h2><br>';
	?>
	<span class="fa-stack fa-4x">
        <i class="fa fa-circle fa-stack-2x text-primary"></i>
        <i class="fa fa fa-envelope fa-stack-1x fa-inverse"></i>
    </span>
	<?php
		echo '<h4 class="section-subheading text-muted">We will be contacting you shortly, Thanks!<h4/>';
	}elseif (isset($fail)) {
		echo $fail;
	}
	?>
</div>







<?php
//Insert footer into template
foreach ($footer as $foot) {
  echo $foot;
}
?>