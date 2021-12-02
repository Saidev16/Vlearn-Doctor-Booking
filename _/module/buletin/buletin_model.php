<?php
	if(isset($_POST['id_filiere'])){
		$id_filiere = $_SESSION['id_filiere_buletin'] = $_POST['id_filiere'];	
	}
		else if(isset($_SESSION['id_filiere_buletin'])){
			$id_filiere = $_SESSION['id_filiere_buletin'] ;	
		}
		else{
			$id_filiere = $_SESSION['id_filiere_buletin'] = 1; 
		}
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
    <tr>
        <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
        <td width="78%" class="titre">&nbsp;GESTION DES BULETINS
		<span class="task">[modèle]</span></td>
        </td>
        <td width="8%">
            <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
                <tr>
				
                    <td valign="top" align="center">
                        <a href="gestion_des_buletins.php?add_model=default">
						<div class="ajouter"></div>Ajouter</a>
                    </td>
					<td valign="top" align="center">
                        <a href="#"

                           onclick="javascript:if(document.adminMenu.boxchecked.value==0)

                               {

                                   alert('Veuillez sélectionnez un cours  ??');

                               }

                               else

                               {

                                   chemin=document.adminMenu.boxchecked.value;

                                   chemin='gestion_des_buletins.php?delete_model_item='+chemin;

                                   window.location.replace(chemin);

                               }">
							   <div class="supprimer"></div>supprimer</a>
                    </td>
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
 <form action="#" method="post" name="adminMenu">
        <input type="hidden" name="boxchecked" value="0" />
        <div class="container_search">

                 <select name="id_filiere" class="search">
                <option value="0">RECHERCHE PAR FILIERE</option>
                <?php
                $fil="select id_filiere, nom_filiere 
				from $tbl_filiere 
				where archive=0
				and id_filiere in (select distinct id_filiere from $tbl_buletin)";
				
                $req=mysql_query($fil);
                while($row=mysql_fetch_assoc($req)){
                    $if=htmlentities($row['id_filiere']);
					$nf=htmlentities($row['nom_filiere']);
                    ?>
            <option value="<?=$if?>" <?=($id_filiere==$if)  ? $selected : ''?>>&nbsp;<?=$nf?></option>
                <?php
				}
				?>
            </select>
            <input type="submit" vname="valider" value="valider" class="input"  />
	</div>
       
<tr>
<?php
			  // boucle sur les semestres
			  $nbr=0;
			  $sql="select distinct semestre from $tbl_buletin  
			  where id_filiere='$id_filiere'
			  and archive=0 order by semestre";
			   
			  $req=@mysql_query($sql) or die("erreur lors de la sélection des semestres");
			
			  while($ligne=mysql_fetch_assoc($req)){
			  $semestre=(int)$ligne['semestre'];
			  $nbr++;

			  $end_tag='';
			  if ( ($nbr == 2 ) or ($nbr ==4) or ($nbr==6) or ($nbr==8) ) {
			  $end_tag='</tr><tr>';
			                  }
          
			  $sql1="select distinct b.id_buletin, b.code_cours, c.titre, c.nbr_credit  
			  from $tbl_buletin as b, $tbl_cours as c  
			  where trim(c.code_cours)=trim(b.code_cours)
			  and b.semestre=$semestre
			  and b.id_filiere='$id_filiere' order by code_cours"; 
			  $req1=@mysql_query($sql1) or die("erreur de selection des donnees du semestre");
			  
			  			  
	?>
	   
      <td width="50%" valign="top" align="left">
	    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="adminlist">
			  <tr>
				 <td colspan="6" align="center" class="gras">Semestre <?=$semestre?></td>
			  </tr>
			  <tr class="gras" align="center">
			  		<td>&nbsp;</td>
					<td width="50">Code</td>
					<td>Cours</td>
					<td width="20">Sem</td>
					<td width="20">Note</td>
					<td width="20">Cr</td>
			  </tr>
	<?php
		while($row=mysql_fetch_assoc($req1)){
		$ib=$row['id_buletin'];
	?>
			  <tr>
			  		  <td align="center"><input type="radio" id="<?=$ib?>"  name="id"
					   value="<?=$ib?>" onClick="document.adminMenu.boxchecked.value=<?=$ib?>" />
					
					 </td>
					 <td valign="top" align="left">&nbsp;<?=$row['code_cours']?></td>
					 <td valign="top" align="left">&nbsp;<?=htmlentities($row['titre'])?></td>
					 <td valign="top" align="center">&nbsp;<?=$semestre?></td>
					 <td valign="top" align="center">&nbsp;</td>
					 <td valign="top" align="center">&nbsp;<?=$row['nbr_credit']?></td>
                                          
			  </tr>
<?php
}
?>

</table>
	
	  </td>
	  <?php
	    echo  $end_tag ;
       }
      ?>
     </td>
 </tr>
 </form>
</table>