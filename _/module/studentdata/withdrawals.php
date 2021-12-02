<?php
 $year=$_GET['withdrawals'];
 $year1=$year+1;
$date1=$year.'-08-30';

                $date2=$year1.'-07-31';
/*$date1=$year.'-01-01';
$date2=$year.'-12-31';*/
$wherewithdrawal= " and `withdrawl_date` BETWEEN '$date1' AND '$date2'";
 $niveau=$_GET['niveau'];


 $sql="SELECT code_inscription,prefixe,concat(e.nom, ' ' ,e.prenom)as name,withdrawl_date,e.onsite FROM `tbl_etudiant_deac` as e WHERE e.niveau= '$niveau' and e.archive=2 and e.onsite=1 ".$wherewithdrawal;


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
		 <th width="166"><?php echo 'Witdrawal Date'; ?></th>
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
		 <td>&nbsp;<?php
		$date=$ligne["withdrawl_date"];
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
