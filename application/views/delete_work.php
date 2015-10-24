<?php 
//Insert header into template
foreach ($head as $he) {
  echo $he;
}
?>

<div class="container-fluid " style="background-color:rgb(247, 247, 247)">
	<div class="col-md-12" style="background-color:white">
<?php 

if (isset($error)) {
    foreach ($error as $err) {
      echo '<div class="alert alert-danger" style="background-color:white; border:none">'.$err.'</div>';
    }  
}

if (isset($confirm)) {
    echo "<p>".$confirm."</p>";
}

?>

	</div>
</div>
<?php 
//Insert footer into template
foreach ($footer as $foot) {
  echo $foot;
}?>