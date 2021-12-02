<script language="javascript1.2">

function valider_inscription(){

if(document.adminMenu.boxchecked.value==0){

alert('Veuillez s�lectionner un cours ');

return false;

}

else{

document.adminMenu.task.value='inscription';

document.adminMenu.submit();

return true; 

}

}

//descriptif

function valider_descriptif(){

if(document.adminMenu.boxchecked.value==0){

alert('Veuillez s�lectionner un cours ');

return false;

}

else{

document.adminMenu.task.value='descriptif';

document.adminMenu.submit();

return true; 

}

}

//syllabus

function valider_syllabus(){

if(document.adminMenu.boxchecked.value==0){

alert('Veuillez s�lectionner un cours ');

return false;

}

else{

document.adminMenu.task.value='syllabus';

document.adminMenu.submit();

return true;

}

}

function valider_desinscription(){

if(document.adminMenu.boxchecked.value==0){

alert('Veuillez s�lectionner un cours ');

return false;

}

else{

document.adminMenu.task.value='desinscription';

document.adminMenu.submit();

return true;

}

}



</script>

<span id="titre_page">Inscription aux cours</span>

<table width="550" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:4px">
<tr>
   <td>
    <table width="110" border="0" cellspacing="0" cellpadding="0" align="right" id="lien_msj">
       <tr>
		<td align="center"> 
			<a href="#" onclick="return valider_inscription()">
			<div class="add"></div>S'inscrire</a>
			
		</td>
         <td align="center">
 			<a href="#" onClick="return valider_desinscription();">
			<div class="delete"></div>D&eacute;sinscrire</a>
        </td>
    </tr>
    </table>
   </td>
</tr>
<tr>
   <td height="4"></td>
</tr>
</table>

 <form action="student.php" method="post" name="adminMenu">
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="task" id="task" value="" />
	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
<table width="575" border="0" cellspacing="0" cellpadding="0" align="center" style="border:#333333 1px solid">

<tr class="entete">
<th width="18px">#</th>
<th align="left" width="75px">&nbsp;Code </th>
<th align="left" width="480" style="padding-left:2px">Titre du cours</th>
</tr>
 <tr><td height="1px" bgcolor="#333333" colspan="3"></td></tr>
<?php
		 if (isset($_SESSION['code_etudiant'])){
		 $code_inscription=$_SESSION['code_etudiant'];
		 $mygroupe=$_SESSION['etat'];
		 
		 //selection de la session d'inscription
		 
		 $sqlsession="select idSession, session, annee_academique from $tbl_session where inscription=0";
		 $req=@mysql_query($sqlsession) or die ('erreur de selection de la session');
		 $row=mysql_fetch_assoc($req);
		 $idSession=$row['idSession'];
		 $session=$row['session'];
		 $annee_academique=$row['annee_academique'];
		 
         $sql="SELECT DISTINCT  ci.code_cours, c.titre
			FROM $tbl_cours as c, $tbl_cours_inscription as ci
			where ci.groupe like '%$mygroupe%'
			and ci.code_cours=c.code_cours
			and archive = 0  order by code_cours ";
			
         $total = mysql_query($sql)or die ("erreur lors de la sélection des cours");
		 $url = "student.php?task=inscription&limit=";
		 $nblignes = mysql_num_rows($total);
		 $parpage=12;
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);
		 while ($row = mysql_fetch_array($result)) {
		 $cc=$row['code_cours'];
?>

<tr style="text-align:left" height="18px">
	 <td align="center">
	 <input type="radio" id="<?=$cc?>" name="id" value="<?=$cc?>" 
	 onClick=  "document.adminMenu.boxchecked.value='<?=$cc?>'" /></td>
	<td class="bold">&nbsp;<?=htmlentities($row['code_cours'])?></td>
	<td width="450"> <?=htmlentities($row['titre'])?></td>
 </tr>
 <tr>
 	<td height="1px" bgcolor="#333333" colspan="3"></td>
 </tr>
<?php
}
}
?>
</table>
</form>
      <div id="pagination" align="center">
    		<?=pagination($url,$parpage,$nblignes,$nbpages);?>
     </div>