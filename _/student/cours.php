
<span id="titre_page"><?php echo 'My Course Schedule';?></span>


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

	//    $sqlsession="SELECT DISTINCT n.idSession, s.session, s.annee_academique,s.ordering
  //
	// FROM tbl_note_morocco AS n, $tbl_session AS s, $tbl_cours AS c
	// where n.idSession = s.idSession
	// AND n.code_inscription = '$code_inscription'
	// AND  c.code_cours = n.code_cours
	// AND n.archive = 0
	// order by s.ordering";
 	// 	 $reqsession=@mysql_query($sqlsession) or die ('erreur de selection de la session');

		 // while($ligne=mysql_fetch_assoc($reqsession)){

		 // $idSession=$ligne['idSession'];
		 // $session=$ligne['session'];
		 // $annee=$ligne['annee_academique'];

		$sql="SELECT c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type, c.code_cours_duplicata
       FROM $tbl_note AS n, $tbl_cours AS c
       WHERE  c.code_cours = n.code_cours
       AND code_inscription = '$code_inscription'
       $conditions_gen
       AND letter_grade != 'T'
       AND n.archive = 0 ";
    //var_dump($sql);
		$req=@mysql_query($sql) or die("erreur lors de la s�lection des cours");

      		 // while($row = mysql_fetch_assoc($res)){
 ?>
 <table width="575" border="0" cellspacing="1" cellpadding="0" align="center" class="adminlist">
 	<tr style="font-style:italic">
	    <th colspan="4" align="center" height="8"><?php echo $session.' '.$annee;?></th>
	</tr>
     <tr class="entete">

	    <td width="75">&nbsp;Code</td>
	    <td width="475">&nbsp;<?php echo 'Course title';?></td>
	      <td width="475">&nbsp;<?php echo 'Credit';?></td>
    </tr>
 <?php

 while ($line=mysql_fetch_assoc($req)){
 $id=$line['code_cours'];
 ?>
   <tr style="text-align:left; height:16px">

    <td class="bold">&nbsp;<?=$id?></td>
    <td>&nbsp;<?=stripslashes($line['titre'])?></td>
     <td>&nbsp;<?=stripslashes($line['nbr_credit'])?></td>
  </tr>
<?php
 }
// }


 ?>

</table>
<?php
}

//fermeture test sur la variable de session

 ?>
