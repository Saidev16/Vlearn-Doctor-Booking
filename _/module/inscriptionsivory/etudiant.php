<?php
			if( (isset($_GET['code_inscription'])) && (!empty($_GET['code_inscription'])) ){
                   
				   $code_inscription=trim($_GET['code_inscription']);
				   $idSession=isset($_GET['idSession']) ? $_GET['idSession'] : $_SESSION['NidSession'];
                   
                    $sql1="select concat(nom, ' ', prenom) as name 
					from tbl_etudiant_ivory 
					where code_inscription='$code_inscription' 
				 limit 1";
                    $req=@mysql_query($sql1) or die("erreur lors de la sélection du nom et filiere");
                    $row=mysql_fetch_assoc($req);
                    $name=$row['name'];
                   
					
					//show the session 
		
                      
		  $sql2="select idSession, session, annee_academique 
				from $tbl_session where idSession=$idSession limit 1";
				
				
		$req=@mysql_query($sql2) ;
		$row=mysql_fetch_assoc($req);
		$idSession=$_SESSION['NidSession']=$row['idSession'];
		$session = $row['session'];
		$annee = $row['annee_academique'];

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td>&nbsp;<img src="images/icone/horraires.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;Registrations 
	<span class="sub_title">Name : <?=$name?></span>
	<!--<span class="sub_title">Filière : <?=$filiere?></span>
	<span class="sub_title">Session : <?=$session.' '.$annee?></span>-->
  </td>
	<td width="22%">
	  <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<td valign="top" align="center">
		   <a href="gestion_inscription_ivory.php" ><div class="cancel"></div>Back</a>
		  </td>
		</tr>
	  </table>
	</td> 
</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist" >
  <tr>
     <th width="15" align="center">#</th>
	 <th width="100" align="center" >Course Code</th>
	 <th align="center">Course Title</th>
	 <th width="175" align="center">Registration Date</th>
  </tr>
      <?php
       $i=0;
       $sql="select i.code_cours, c.titre, i.date_inscription 
	         from $tbl_cours as c, tbl_inscription_cours_ivory as i 
	         where   i.code_cours=c.code_cours 
			  and i.code_inscription='$code_inscription'
			  and i.idSession=$idSession
			  order by i.date_inscription desc";

      $req=@mysql_query($sql) or die ("erreur lors de la selection des cours");
      $count=mysql_num_rows($req);
 	  while ($ligne = mysql_fetch_array($req)) {
	  $i++;
      ?>

  <tr>
     <td align="center"><?=$i?></td>
	 <td align="left" class="gras">&nbsp;<?=htmlentities($ligne["code_cours"])?></td>
	 <td align="left">&nbsp;<?=ucfirst(trim(stripslashes($ligne["titre"])))?></td>
	 <td align="left">&nbsp;<?=$ligne["date_inscription"]?></td>
  </tr>

<?php
      }
?>
 </table>
<?php
}
?>
