<script language="javascript1.2">
function valider_student(){
if(document.adminMenu.boxchecked.value==0){
alert('Veuillez sélectionner un cours ');
return false;
}
else{
document.adminMenu.task.value='etudiant';
document.adminMenu.submit();
return true; }
}
//notes
function valider_note(){
if(document.adminMenu.boxchecked.value==0){
alert('Veuillez sélectionner un cours ');
return false;
}
else{
document.adminMenu.task.value='note';
document.adminMenu.submit();
return true; }
}
//absences
function valider_absence(){
if(document.adminMenu.boxchecked.value==0){
alert('Veuillez sélectionner un cours ');
return false;
}
else{
document.adminMenu.task.value='absence';
document.adminMenu.submit();
return true; }
}
//descriptif
function valider_descriptif(){
if(document.adminMenu.boxchecked.value==0){
alert('Veuillez sélectionner un cours ');
return false;
}
else{
document.adminMenu.task.value='descriptif';
document.adminMenu.submit();
return true; }
}
//syllabus
function valider_syllabus(){
if(document.adminMenu.boxchecked.value==0){
alert('Veuillez sélectionner un cours ');
return false;
}
else{
document.adminMenu.task.value='syllabus';
document.adminMenu.submit();
return true; }
}
//detail
function valider_detail(){
if(document.adminMenu.boxchecked.value==0){
alert('Veuillez sélectionner un cours ');
return false;
}
else{
document.adminMenu.task.value='detail';
document.adminMenu.submit();
return true; }
}
</script>
<span id="titre_page">Liste des cours </span>
<table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td>
<table width="300px" border="0" cellspacing="5" cellpadding="0" align="right" id="lien_msj">
  <tr id"lien_msj">
    <td align="center"> 
	  <a href="#" onclick="return valider_student()" title="liste des étudiants">
		   <div class="etudiant"></div>Etudiant
      </a>
	</td>
    <td align="center">
	 <a href="#" onclick="return valider_note()"  title="fiche de notes">
		   <div class="notes"></div>Notes
     </a>
	</td>
    <td align="center">
	<a href="#" onclick="return valider_absence()" title="fiche d'absences">
		   <div class="absence"></div>Absences</a>
	</td>
    <td align="center">
	<a href="#" onclick="return valider_descriptif()" title="déscriptif du cours">
		   <div class="descriptif"></div>Déscriptif</a></td>
    <td align="center">
	<a href="#" onclick="return valider_syllabus()" title="syllabus du cours">
		   <div class="syllabus"></div>Syllabus</a></td>
	<td align="center">
	<a href="#" onclick="return valider_detail()" title="détail du cours">
		   <div class="detail"></div>Détail</a></td>
  </tr>

</table>
</td></tr>
<tr height="10px"><td></td></tr>
<tr><td>
<?php
    $total=0;
    $id=(int)$_SESSION['code_prof'];
	$sql="SELECT distinct s.code_cours, c.titre from $tbl_cours as c, $tbl_seance as s  
	where c.code_cours=s.code_cours
	and s.code_prof='$id' 
	and s.idSession='$idSession' 
	and c.archive= 0 "; 
	$req=@mysql_query($sql) or die ("erreur lors de la sélection des cours");
	$total=mysql_num_rows($req);
	if($total){
	?>
	<form action="professeur.php" method="post" name="adminMenu" id="adminMenu" >
       <input type="hidden" name="boxchecked" id="boxchecked" value="0" />
	    <input type="hidden" name="task" id="task" value="" />
 	<table width="575" border="0" cellspacing="1" cellpadding="0" style="border:#666666 1px solid">
  <tr class="entete">
    <td width="15px" align="center">#</td>
    <td width="60">&nbsp;Code</td>
    <td width="475">&nbsp;Intitulé du cours</td>
  </tr>
	  <tr><td colspan="3" bgcolor="#333333" height="1px"></td></tr>
	<?php
    while($row=mysql_fetch_assoc($req)){
	$cc=htmlentities($row['code_cours']);
		?>
 <tr height="17px">
    <td><input type="radio" id="<?=$cc?>" name="id" value="<?=$cc?>" 
	onClick="document.adminMenu.boxchecked.value='<?=$cc?>'" />
	</td>
    <td align="left" style="font-weight:bold">&nbsp;<?=$cc?></td>
    <td align="left">&nbsp;<?=htmlentities(trim($row['titre']))?></td>
 </tr>
 <tr height="1px">
     <td bgcolor="#333333" colspan="3"></td>
 </tr>
  <?php
  }
  ?>
  <tr>
    <td colspan="3" class="footer_table">Nombre de cours : <?=$total?></td>
  </tr>
 </table>
</form>
<?php
}
?>
</td></tr>
</table>
