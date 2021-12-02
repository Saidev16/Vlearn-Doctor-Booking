<?php
 $year=$_GET['details'];
 $year1=$year+1;
 $niveau=$_GET['niveau'];
 $where =" ";

if($niveau=='BBA')
{
$where= " and (e.date ='0000-00-00' or e.date BETWEEN '$year-09-01' AND '$year1-09-30')";

}else if($niveau=='MBA')
{$where = "and (e.datemba ='0000-00-00' or e.datemba BETWEEN '$year-09-01' AND '$year1-09-30')";
}
else if($niveau=='DBA')
{$where="  and (e.datedba ='0000-00-00' or e.datedba BETWEEN '$year-09-01' AND '$year1-09-30')";
}





	/* $sql = "SELECT concat(e.nom, ' ' ,e.prenom)as name,date_inscription,e.prefixe,e.niveau,n.code_inscription FROM `tbl_note` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription  and n.archive=0 and e.niveau='$niveau' and e.prefixe='AUL' and e.archive=0 group by n.code_inscription
	           	UNION ALL
	           	SELECT concat(e.nom, ' ' ,e.prenom)as name,date_inscription,e.prefixe,e.niveau,n.code_inscription FROM `tbl_note_piimt` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and  n.archive=0 and e.niveau='$niveau'  and e.prefixe='MOR' and e.archive=0   group by n.code_inscription
	           	UNION ALL
	        	SELECT concat(e.nom, ' ' ,e.prenom)as name,date_inscription,e.prefixe,e.niveau,n.code_inscription FROM `tbl_note_Algeria` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and e.prefixe='AUPA' and e.archive=0 and n.archive=0  and e.niveau='$niveau' group by n.code_inscription
	         	UNION ALL
	         	SELECT concat(e.nom, ' ' ,e.prenom)as name,date_inscription,e.prefixe,e.niveau,n.code_inscription FROM `tbl_note_Libya` as n ,tbl_cours as c, tbl_etudiant_deac as e WHERE c.code_cours_psi=n.code_cours and n.code_inscription = e.code_inscription and n.archive=0 and e.prefixe='AUPL' and e.archive=0 and e.niveau='$niveau'  group by n.code_inscription
	         	UNION ALL
	         	SELECT concat(e.nom, ' ' ,e.prenom)as name,date_inscription,e.prefixe,e.niveau,n.code_inscription FROM `tbl_note_benin` as n ,tbl_cours as c ,  tbl_etudiant_deac as e WHERE n.code_inscription = e.code_inscription  and c.code_cours=n.code_cours and n.archive=0 and e.niveau='$niveau'  and e.prefixe='AUPBN' and e.archive=0  group by n.code_inscription";*/


	         	$sql = "SELECT concat(e.nom, ' ' ,e.prenom)as name,date_inscription,date_inscription_mba,date_inscription_dba,e.prefixe,e.niveau,code_inscription 
	         	FROM 	         	tbl_etudiant_deac as e 
	         	WHERE e.niveau='$niveau' and e.archive!=2 and e.archive!=3  ".$where;



?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td class="titre" width="78%"><?php echo 'Listing Students'; ?></td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="right">
		   <a href="Statistiques.php"><div class="cancel"></div><?php echo 'cancel';?></a>
		  </td>
		</tr>

	  </table>

	</td>

  </tr>

 </table>


 <table width="100%" align="center" cellspacing="1"  class="adminlist" style="margin-top:2px">

 <form action="#" method="post" name="adminMenu" >


       <tr align="center">

		 <th width="100"><?php echo 'code'; ?></th>
		 <th width="272"><?php echo 'name'; ?></th>

		 <th width="166"><?php echo 'joined_on'; ?></th>

   </tr>

	  <?php
		 $i=0;
		 $total = @mysql_query($sql) or die("Failure to select students");
		 $url = $_SERVER['PHP_SELF']."?details=".$year."&niveau=".$niveau."&limit=";
		 $nblignes = mysql_num_rows($total);
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);
		 while ($ligne = mysql_fetch_assoc($result)) {
		 $i++;
		 $etud=$ligne["prefixe"].$ligne["code_inscription"];
		 $ci=$ligne["code_inscription"];
		   ?>


		 <td align="left" >&nbsp;<?=$etud?></td>
		 <td>&nbsp;<?=stripslashes(ucfirst($ligne["name"]))?></td>
		<!-- <td>&nbsp;<?= $ligne['nom_filiere_eng'] ?></td>-->
		 <td>&nbsp;<?php
		 if($niveau=='BBA'){
		$date=$ligne["date_inscription"];}
		else if($niveau=='MBA'){
		$date=$ligne["date_inscription_mba"];}
		else if($niveau=='DBA'){
		$date=$ligne["date_inscription_dba"];}
		$tab=split('[/.-]',$date);
		echo $tab[1].'-'.$tab[2].'-'.$tab[0];//echo $row['date_paiement']; ?>
		</tr><?php
		  }
		 ?>

	 </form>

	 </table>
	 <div id='pagination' align='center'>
         <?php
           echo pagination($url,$parpage,$nblignes,$nbpages);

     	 ?>
		    </div>
