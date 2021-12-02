// JavaScript Document
function validate(){
  if($F('nom') == '') {
   $('er_nom').update("Veuillez remplir le champs nom!");
   $('nom').focus();
   return false;
  }

 if($F('mail') =='') {
    $('er_mail').update("Veuillez remplir le champs email!");
    $('mail').focus();
    return false;
  }

/*  if($F('mail').match(/^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,3}$/) == null) {
    $('er_mail').update("Veuillez saisir un email valide!");
    $('mail').focus();
    return false;
  }*/
  
  if($F('login') == '') {
   $('er_login').update("Veuillez remplir le champs login!");
   $('login').focus();
   return false;
  }
  
  if($F('pass') == '') {
   $('er_pass').update("Veuillez remplir le champs mot de passe!");
   $('pass').focus();
   return false;
  }
  
	else{
	document.f_ajout.submit();
	return true;
	}

}

function onUpdateValidate(){
  if($F('nom') == '') {
   $('er_nom').update("Veuillez remplir le champs nom!");
   $('nom').focus();
   return false;
  }

 if($F('mail') =='') {
    $('er_mail').update("Veuillez remplir le champs email!");
    $('mail').focus();
    return false;
  }

 /* if($F('mail').match(/^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,3}$/) == null) {
    $('er_mail').update("Veuillez saisir un email valide!");
    $('mail').focus();
    return false;
  }*/
  
  if($F('login') == '') {
   $('er_login').update("Veuillez remplir le champs login!");
   $('login').focus();
   return false;
  }
  
	else{
	document.f_ajout.submit();
	return true;
	}

}