<?php
 if(isset($_GET['idCleEmploi'])){
     $idCleEmploi=$_SESSION['idCleEmploi']=$_GET['idCleEmploi'];
      
     $sql="select titre from $tbl_titre_emploi where idCleEmploi='$idCleEmploi' limit 1";
     $req=@mysql_query($sql) or die ('erreur lors de la selection du titre');
     $row=mysql_fetch_assoc($req);
     $titre=$_SESSION['titreCleEmploi']=$row['titre'];
     
 }
 
 ?>
<span id="titre_page"><?=$titre?></span><br>
<table width="575" border="0" cellspacing="1" cellpadding="0" style="font-size:10px" class="adminlist">
  
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
       echo '<tr class="bold">';
       echo '<td rowspan="2">'.strtoupper(rotate_text($jour)).'</td>';
$sql1="select distinct horaire from tbl_emploi_items where jour='$jour' and idCleEmploi='$idCleEmploi' order by horaire limit 4";
$req=@mysql_query($sql1) or die ('erreur lors de la selection des horaires');
while ($row=mysql_fetch_assoc($req)){

          echo '<td align="center" class="entete" height="17">'.$row['horaire'].'</td>';
    }
     echo '</tr><tr>';  
   
    $sql2="select distinct c.titre_eng, e.horaire, e.salle, e.idEmploiItem, p.nom_prenom from
    $tbl_cours as c, $tbl_emploi_items as e, $tbl_professeur as p where
    jour='$jour'
    and idCleEmploi='$idCleEmploi'
    and c.code_cours=e.code_cours
    and e.code_prof=p.code_prof
    order by e.horaire limit 4";
   $result=@mysql_query($sql2) or die ('erreur lors de la selection des titre des cours');
  while ($row=mysql_fetch_assoc($result)){

          
          echo '<td align="center">';
          echo '<div>'.$row['titre_eng'].'</div>';
          echo '<div style="color:#00F">'.$row['nom_prenom'].'</div>';
          echo '<div style="color:#900">salle :'.$row['salle'].'</div>';
          echo '</td>';
    }
      echo '</tr>';
}      
?>
</table>