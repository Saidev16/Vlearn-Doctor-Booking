// JavaScript Document
function get_selected(){
	
if ($F('groupe')==7){
$('tit_activ').style.display='block';
$('activite').style.display='block';
}

 if ($F('groupe')!=7){
$('tit_activ').style.display='none';
$('activite').style.display='none';
}

}

function validate(){
	
/*if ($F('ci')==""){
$('er_code').update("Veuillez saisir le code d'inscription");
return false;
}*/

/*if($F('ci').match(/^[-]?\d*\.?\d*$/) == null) {
   $('er_code').update("le code d'inscription ne doit contenir que des chiffres!");
   $('ci').focus();
   return false;
  }
  
if($('er_code').innerHTML != '') {
   return false;
  } 
  
if($F('nom') == '') {
   $('er_nom').update("Veuillez remplir le champs Nom!");
   $('nom').focus();
   return false;
  }*/
 /* 
if($F('cin') == '') {
   $('er_cin').update("Veuillez remplir le champs CIN!");
   $('cin').focus();
   return false;
  }
  
if($('er_cin').innerHTML != '') {
   return false;
  } 
  
if($F('mail')== '') {
    $('er_mail').update("Veuillez saisir votre email !");
    $('mail').focus();
    return false;
  }
  
if($F('mail').match(/^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,3}$/) == null) {
    $('er_mail').update("Veuillez saisir un email valide!");
    $('mail').focus();
    return false;
  }


else {*/
document.f_ajout.submit();
return true;
//}

}
function validate1(){
document.f_ajout.submit();
return true;
}



 
 function onAddVerify()
{
	if ($F('ci')!=""){
		if ($F('ci').length>6){
    var url = 'script/data/code_inscription.php';
	var params = 'code_inscription=' + $F('ci');
    var myAjax = new Ajax.Request(url,{method: 'get', parameters: params, onComplete: gestionReponse});
		                     }
					 }
} 

function gestionReponse(xhr)
{
	   
		var code_inscription=xhr.responseText;
    if (code_inscription)
	
    {
		if(code_inscription > 0){
		$('er_code').update("Ce code d'inscription n'est pas disponible !!! " );
	  				            }
					  else{
						  $('er_code').update("");
					      }
			
							 	 
	
		
	}

}


 function onUpdateVerify()
{
	if ($F('ci')!=""){
		if ($F('ci').length>6){
    var url = 'script/data/code_inscription.php';
	var params = 'code_inscription=' + $F('ci');
    var myAjax = new Ajax.Request(url,{method: 'get', parameters: params, onComplete: gestionReponses});
		                     }
					 }
} 

function gestionReponses(xhr)
{
	   
		var code_inscription=xhr.responseText;
    if (code_inscription)
	
    {
		
		if( (code_inscription > 0) && ($F('id') != $F('ci')) ){
		$('er_code').update("Ce code d'inscription n'est pas disponible !!! " );
	  				            }
					  else{
						  $('er_code').update("");
					      }
			
							 	 
	
		
	}

}


 function onAddVerifyCin()
{
	if ($F('cin')!=""){
		if ($F('cin').length>5){
    var url = 'script/data/cin.php';
	var params = 'cin=' + $F('cin');
    var myAjax = new Ajax.Request(url,{method: 'get', parameters: params, onComplete: gestionReponseCin});
		                     }
					 }
} 

function gestionReponseCin(xhr)
{
	   
		var cin=xhr.responseText;
    if (cin)
	
    {
		if(cin > 0){
		$('er_cin').update("Ce code d'identité national n'est pas disponible !!! " );
	  				            }
					  else{
						  $('er_cin').update("");
					      }
			
							 	 
	
		
	}

}


function onUpdateVerifyCin()
{
	if ($F('cin')!=""){
		if ($F('cin').length>5){
    var url = 'script/data/cin.php';
	var params = 'cin=' + $F('cin');
    var myAjax = new Ajax.Request(url,{method: 'get', parameters: params, onComplete: gestionReponsesCin});
		                     }
					 }
} 

function gestionReponsesCin(xhr)
{
	   
		var cin=xhr.responseText;
    if (cin)
	
    {
		
		if( (cin > 0) && ($F('ex_cin') != $F('cin')) ){
		$('er_cin').update("Ce code d'identité national n'est pas disponible !!!" );
	  				            }
					  else{
						  $('er_cin').update("");
					      }
			
							 	 
	
		
	}

}


	