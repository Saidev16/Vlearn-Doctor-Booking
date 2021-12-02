<span id="titre_page">Grades </span>
 <?php
// v�rification de la variable de session

    if (isset($_SESSION['code_etudiant'])){
    $code_inscription=$_SESSION['code_etudiant'];
     $prefixe=$_SESSION['prefixe'];
     $sql="SELECT e.*
       FROM tbl_etudiant_all AS e WHERE code_inscription= '$code_inscription' and prefixe= '$prefixe'";
       $res= @mysql_query($sql) or die('Erreur :: Student information');
       $row = @mysql_fetch_assoc($res);
       $date=$row['date_naissance'];
      $nom=$row['nom'];
      $prenom=$row['prenom'];
      $adresse=$row['adresse'];
      $lieu_naissance=$row['lieu_naissance'];
      $code_bac=$row['code_bac'];
      $prefixe=$row['prefixe'];
      $graduation_date=$row['graduation_date'];

     if($prefixe=='MOR')
      { $tbl_note='tbl_note_morocco';}
      else  if($prefixe=='AG')
      {  $tbl_note='tbl_note_algeria';}
      else if($prefixe=='US')
      { $tbl_note='tbl_note_usa'; }
      if($prefixe=='BN')
      {  $tbl_note='tbl_note_benin';    }
      if($prefixe=='BF')
      {  $tbl_note='tbl_note_burkina';   }
      elseif ($prefixe=='CAM')
      {  $tbl_note='tbl_note_cameroun';   }

       $transcript = $row['new_transcript'];
       $conditions_gen = "";
       if ($transcript == 1) {
         $conditions_gen = "AND n.prefixe = '$prefixe'";
         $tbl_note = "tbl_note_acc";
         $table_inscription_sql = "tbl_inscription_cours_acc";
       }

				/* $sqlsession="select idSession, session, annee_academique from $tbl_session order by idSession desc";
				 $res=@mysql_query($sqlsession) or die ('erreur de selection des sessions');
				 while($row=mysql_fetch_assoc($res)){
				 $idSession=$row['idSession'];
				 $session=$row['session'];
				 $annee=$row['annee_academique'];*/

				$sql="SELECT  n.*, c.titre
                FROM  $tbl_note AS n, $tbl_cours AS c
                WHERE n.code_inscription = '$code_inscription'
                and c.code_cours = n.code_cours

 				and n.archive=0 ";

				$req=@mysql_query($sql) or die("erreur lors de s�lection des notes");
				if(mysql_num_rows($req)!=0){

 ?>
<table width="575" align="center" border="0" cellspacing="1" cellpadding="0" class="adminlist">
<tr><th colspan="13" style="font-style:italic"> <?php  echo $session.' '.$annee; ?></th></tr>


  <tr class="entete" height="18px" align="center">
    <td width="300">Course Title</td>
   <!-- <td width="50">Mid-Term</td>
    <td width="50">Projet</td>
    <td width="50">Participation</td>
    <td width="50">Final exam</td>-->
    <td width="50">Final grade</td>
    <td width="50">Letter grade</td>
   </tr>
<?php
while($row=mysql_fetch_assoc($req)){
?>
  <tr align="center" valign="top">
		<td align="left">&nbsp;<?=stripslashes($row['titre'])?></td>
		<!--<td>&nbsp;<?=$row['mid_term']?></td>
		<td>&nbsp;<?=$row['project']?></td>
		<td>&nbsp;<?=$row['participation']?></td>
		<td>&nbsp;<?=$row['final_exam']?></td>-->
        <td>&nbsp;<?=$row['final_grade']?></td>
		<td>&nbsp;<?=$row['letter_grade']?></td>
   </tr>
  <?php
  }
  ?>
</table>
     <?php
	 }
	// }
     }

	?>
<br /><br />
