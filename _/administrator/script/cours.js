// JavaScript Document

function validate(){
	
if ($F('code')==""){
$('er_code').update("Ce code cours n'est pas disponible");
return false;
}

if($('er_code').innerHTML != '') {
   return false;
  } 
  
if($F('libele') == '') {
   $('er_libele').update("Veuillez remplir le champs Titre en français!");
   $('libele').focus();
   return false;
  }
  
  if($F('titre_en') == '') {
   $('er_titre_en').update("Veuillez remplir le champs Titre en Englais!");
   $('titre_en').focus();
   return false;
  }

else {
document.f_ajout.submit();
return true;
}

}

 
 function OnAddVerify()
{
	if ( ($F('code')!="") && ($F('code').length>6) ){
	var params = 'code_cours=' + $F('code');
    var url = 'script/data/code_cours.php';
    var myAjax = new Ajax.Request(url,
								  {method: 'get', 
								  parameters: params,  
								  onComplete: gestionReponse});
		                     						}
					
} 

function gestionReponse(xhr)
{
	   
		var code_cours=xhr.responseText;
    if (code_cours){
    
		if(code_cours > 0){
		$('er_code').update("Ce code cours n'est pas disponible ");
	  				            }
					  else{
						  $('er_code').update("");
					  }
			
				}

}