<span id="titre_page">Personal Card</span>
<?php
$id=(int)$_SESSION['code_prof'];
$sql="SELECT * FROM $tbl_professeur WHERE code_prof = '$id' LIMIT 0 , 1";
$req=@mysql_query($sql) or die("erreur lors de la sélection des informations du professeur");
$row=mysql_fetch_assoc($req);
?>
<table width="575" cellspacing="2" cellpadding="0" align="center" border="0" style="text-align:left; margin-top:10px">
  <tr> 
    <td width="420" class="entete">&nbsp; Registration Code :</td>
	</tr>
	<tr>
    	<td>&nbsp;<?=$row['code_prof']; ?></td>
    </tr>
 
    <tr>
    	<td class="entete">&nbsp;Name :</td>
	</tr>
    <tr>
    	<td>&nbsp;<?=addslashes($row['nom_prenom'])?></td>
    </tr>
    <tr>
    	<td class="entete">&nbsp;Degrees :</td>
	</tr>
	<tr>
    	<td>&nbsp;<ul style="list-style:none"><?php 
		$diplomes = explode(";", $row['diplome']);
		foreach ($diplomes as $diplome){
		echo  $diplome != '' ? '<li>&raquo;'. addslashes($diplome) .'</li>' : '';
		}
		?>
		</ul></td>
    </tr>
    <tr>
    	<td class="entete">&nbsp;Nationality :</td>
	</tr>
	<tr>
    	<td>&nbsp;<?=addslashes($row['nationnalite'])?></td>
	</tr>
	<!--<tr>
    	<td class="entete">&nbsp;Matières enseignées :</td>
	</tr>
	<tr>
    	<td>&nbsp;<?=addslashes($row['matiere'])?></td>
	</tr>-->
	<tr>
    	<td class="entete">&nbsp;Phone number :</td>
	</tr>
	<tr>
    <td>&nbsp;<?=addslashes($row['contact'])?></td>
	</tr>
	<tr>
    	<td class="entete">&nbsp;E-mail :</td>
	</tr>
	<tr>
    	<td>&nbsp;<?=addslashes($row['mail'])?></td>
	</tr>
   <!-- <tr>
    	<td class="entete">&nbsp;Situation : </td>
	</tr>
	<tr>
    	<td>&nbsp;<?=addslashes($row['type'])?></td>
	</tr>-->
</table>
