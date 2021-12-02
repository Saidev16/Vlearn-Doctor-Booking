<?php
function translate($word){
	if (isset($_SESSION['lang']) and $_SESSION['lang']=='eng'){
	$ini_array = parse_ini_file("eng.ini");
		if(isset($ini_array[$word])){
			return $ini_array[$word]; 
		                            }
		else{
			return $word;
		    }
	
	                                                          }
	else{
	$ini_array = parse_ini_file("fr.ini");
		if(isset($ini_array[$word])){
			return $ini_array[$word]; 
		}
		else{
			return $word;
		    }
	    }
                  }
	?>