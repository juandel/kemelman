<?php 

function div($id, $class,$style=NULL){
    $element = "<div ";
    
    if ($id) {
        $element = $element.'id="'.$id.'"';
    }

    if ($class) {
        $element = $element.'class="'.$class.'"';
    }
    if ($style) {
        $element =$element.'style="'.$style.'"';
    }
    $element =$element.'">'."\n";

	echo $element;
}

function div_c(){
	echo'</div>';
}

function page_title(){
	echo "JUANDEL";
}
function sub_page_title(){
	echo "Architectural Visualization";
}

function get_working_uri_keyword(){
	$section = uri_string();
    $ca = explode('/', $section);

    if (count($ca)>1) {
        $la = $ca[1];
    }elseif(count($ca)<2){
        $la = $ca[0];
        if($ca[0] == "") {
            $la = "web";
        }
    }
    return $la;
}

 ?>