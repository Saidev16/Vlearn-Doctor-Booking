 <?php
 if(isset($_GET['code_inscription'])){
     $code_inscription=$_SESSION['code_inscription']=$_GET['code_inscription'];
      
     $sql="select e.code_inscription, concat(e.nom, ' ', e.prenom) as name, f.nom_filiere
	  from $tbl_etudiant as e, $tbl_filiere as f where 
	 code_inscription='$code_inscription'
	 and e.filiere=f.id_filiere limit 1";
     $req=@mysql_query($sql) or die ('erreur lors de la selection du nom et prenom');
     $row=mysql_fetch_assoc($req);
     $name=$_SESSION['name']=$row['name'];
	 $nom_filiere=$row['nom_filiere'];
     
 
 
 ?>
 <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
   <tr>
     <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
     <td width="78%" class="titre">&nbsp;GESTION DES BULETINS   
		 <span class="sub_title"> Nom:&nbsp;<?=$name?></span>
		<span class="sub_title"> Fili&egrave;re:&nbsp;<?=$nom_filiere?></span>
	</td>
	<td width="8%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	  <tr>
        <td valign="top" align="center" >
		  <a href="#" onclick="window.print()"><div class="imprimer"></div>Imprimer</a>
		</td>
        <td valign="top" align="center" >
		  <a href="gestion_des_buletins.php"><div class="retour"></div>Retour</a>
		</td>
     </tr>
	  </table>
	</td> 
   </tr>
</table>
<table width="100%" align="center" cellspacing="1" class="adminlist" >
<tr>
<?php
			  // boucle sur les semestres
			  $nbr=0;
			  $sql1="select distinct semestre from $tbl_buletin_data 
			  where code_inscription='$code_inscription'";
			  $req=@mysql_query($sql1) or die("erreur lors de la sélection des semestres");
			  while($ligne=mysql_fetch_assoc($req)){
			  $semestre=$ligne['semestre'];
			  $nbr++;

			  $end_tag='';
			  if ( ($nbr == 2 ) or ($nbr ==4) or ($nbr==6) or ($nbr==8) ) {
			  $end_tag='</tr><tr>';
			                  }
          
			  $sql2="select b.code_cours, b.semestre, b.note_finale_chiffre,
			  b.note_finale_lettre, c.nbr_credit  
			  from $tbl_buletin_data as b, $tbl_cours as c  
			  where trim(c.code_cours)=trim(b.code_cours)
			  and code_inscription='$code_inscription' 
			  and semestre='$semestre'"; 
			  $req2=@mysql_query($sql2) or die("erreur de sélection des donnees du semestre ");
			  if(mysql_num_rows($req2)){
			  			  
	?>
	   
      <td width="50%" valign="top" align="left">
	    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="adminlist">
			  <tr>
				 <td colspan="5" align="center" class="gras">Semestre<?=$semestre?></td>
			  </tr>
			  <tr class="bold" align="center">
					<td width="50">Code</td>
					<td>Titre du cours</td>
					<td width="20">Sem</td>
					<td width="25">Note en <br />chiffre</td>
					<td width="25">Note en <br />lettre</td>
					<td width="20">Cr</td>
			  </tr>
	<?php
		while($row=mysql_fetch_assoc($req2)){
	?>
			  <tr>
				<td valign="top" align="left" class= "smallEdit">&nbsp;<?=$row['code_cours']?></td>
				<td valign="top" align="left">&nbsp;<?=htmlentities($row['titre'])?></td>
				<td valign="top" align="center">&nbsp;<?=$row['semestre']?></td>
				<td valign="top" align="center">&nbsp;<?=$row['note_finale_chiffre']?></td>
				<td valign="top" align="center">&nbsp;<?=$row['note_finale_lettre']?></td>
				<td valign="top" align="center">&nbsp;<?=$row['nbr_credit']?></td>
			  </tr>
<?php
}
?>
</table>
		<?php
		}
		?>
	  </td>
	  <?php
	    echo  $end_tag ;
       }
      ?>
     </td>
 </tr>
</table>
  <?php
  }
  ?>