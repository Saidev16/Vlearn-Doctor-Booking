 <?php
 if(isset($_GET['idCleEmploi'])){
     $idCleEmploi=$_SESSION['idCleEmploi']=$_GET['idCleEmploi'];
      
     $sql="select titre from tbl_cle_emploi where idCleEmploi='$idCleEmploi' limit 1";
     $req=@mysql_query($sql) or die ('erreur lors de la selection du titre');
     $row=mysql_fetch_assoc($req);
     $titre=$_SESSION['titreCleEmploi']=$row['titre'];
     
 }
 
 ?>
 <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
   <tr>
     <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
     <td width="78%" class="titre">&nbsp;GESTION DES EMPLOIS DU TEMPS   
		 <span class="sub_title"><?=$titre?></span>
		 
	</td>

	<td width="8%">

	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>
                <td valign="top" align="center" >

		  <a href="#" onclick="window.print()" title="voir le syllabus du cours"><div class="imprimer"></div>Imprimer</a>

		</td>
                <td valign="top" align="center" >

		  <a href="gestionCleEmploi.php" title="precedent"><div class="retour"></div>Retour</a>

		</td>
                

		</tr>

	  </table>

	</td> 

   </tr>

</table>

<table width="1000" align="center" cellspacing="1"  class="adminlist" >
<?php

function rotate_text($param){
                $var='';
		for ($i=0; $i<strlen($param); $i++){

                    $var=$var.substr($param, $i, 1).'<br>';

		}
		return $var;
                            }
$jours=array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
for ($i=0; $i<count($jours); $i++){
    $jour=$jours[$i];
       echo '<tr class="gras">';
       echo '<td rowspan="2">'.strtoupper(rotate_text($jour)).'</td>';
$sql1="select distinct horaire from tbl_emploi_items where jour='$jour' and idCleEmploi='$idCleEmploi' order by horaire limit 4";
$req=@mysql_query($sql1) or die ('erreur lors de la selection des horaires');
while ($row=mysql_fetch_assoc($req)){

          echo '<td align="center">'.$row['horaire'].'</td>';
    }
     echo '</tr><tr>';  
   
    $sql2="select distinct c.titre_eng, e.horaire, e.salle, e.idEmploiItem, p.nom_prenom from
    $tbl_cours as c, tbl_emploi_items as e, $tbl_professeur as p where
    jour='$jour'
    and idCleEmploi='$idCleEmploi'
    and c.code_cours=e.code_cours
    and e.code_prof=p.code_prof
    order by e.horaire limit 4";
   $result=@mysql_query($sql2) or die ('erreur lors de la selection des titre des cours');
  while ($row=mysql_fetch_assoc($result)){

          
          echo '<td align="center">';
          echo '<div>'.$row['titre_eng'].'</div>';
          echo '<div>'.$row['nom_prenom'].'</div>';
          echo '<div>salle :'.$row['salle'].'</div>';
          echo '<div class="smallEdit"><a href="gestion_emploi.php?modifier='.$row['idEmploiItem'].'">[Editer]</a></div>';
          echo '</td>';
    }
      echo '</tr>';
}      
?>
</table>
  