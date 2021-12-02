// JavaScript Document

function valider_etud(){
if($F('login_etudiant')==""){
alert("veuiller taper votre login");
$('login_etudiant').focus;
return false;
}

if($F('pass_etudiant')==""){
alert("veuiller taper votre mot de passe");
$('pass_etudiant').focus;
return false;
}

else{
document.frmEtu.submit();
return true;
}

}

function valider_prof(){
if($F('login_prof')==""){
alert("veuiller taper votre login");
$('login_prof').focus;
return false;
}

if($F('pass_prof')==""){
alert("veuiller taper votre mot de passe");
$('pass_prof').focus;
return false;
}

else{
document.frmProf.submit();
return true;
}

}