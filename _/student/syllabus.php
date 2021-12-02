 <?php
 if (isset($_POST['boxchecked'])){
 $code_cours=$_POST['boxchecked'];
 ?>
<span id="titre_page">Syllabus</span>
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><table width="40" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
       <td>
	   <table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="500px"></td>
	<td align="center" width="50">
	    <a href='student.php?task=cours' id="lien_msj"><div class="retour"></div>retour</a>
 	</td>
  </tr>
</table>
	   </td>
  </tr>
</table>
</td>
  </tr>
  <tr height="10"><td></td></tr>
  </tr>
  <tr><td>
  <?php
 
 $header="select * from $tbl_header where type='syllabus' limit 1";
 $req=@mysql_query($header) or die ("erreur lors de la création de l'etête du document");
 $row=mysql_fetch_assoc($req);
 $logo=$row['logo'];
 $title=$row['titre'];
 $version=$row['version'];
 $for_esm=$row['for_esm'];
 $sous_logo=$row['sous_logo'];
 
 
 $sql="SELECT  c.titre, p.nom_prenom, s.session, s.annee_academique
		FROM  $tbl_cours AS c, $tbl_professeur as p, $tbl_seance as ss, $tbl_session as s
		WHERE ss.code_cours ='$code_cours'
		and   s.idSession='$idSession'
        and   s.idSession=ss.idSession
        and   ss.code_prof=p.code_prof limit 1 "; 
		
 $req=@mysql_query($sql) or die("erreur lors de la sélection");
      $row=mysql_fetch_assoc($req)  ;
      $titre=$row['titre'];
      $nom_prenom=$row['nom_prenom'];
      $session=$row['session'];
      $annee_academique=$row['annee_academique'];
?>
  <!--entete-->
 <table width="100%" border="0" cellspacing="1" cellpadding="0" height="70px" style="text-align:center" class="adminlist">
   <tr height="30px">
    <td rowspan="3" width="30%"><img src="images/logo/<?=$logo?>" border="0" width="168" height="70" />
	<br />
	<span id="sous_logo"><?=$sous_logo?></span>
	</td>
	<td width="30%" ><span id="formulaire">Formulaire </span></td>
    <td width="30%"><span id="for_esm"><?=$for_esm?></span></td>
     </tr>
 <tr height="15px">
    <td rowspan="2"><span id="letitre"><?=$title?></span></td>
    <td  rowspan="2" ><span id="version"><?=$version?></span> </td>
  </tr>
  <tr height="10px"></tr>
</table>
<!--  fin entete-->
  </td></tr>
  <tr>
  <td height="10px"></td>
  </tr>
  <tr>
     <td align="left">
        <div style="width:550px; height:20px; display:block; text-align:left">
          <span class="bold">Intitulé du cours</span> :<?=$titre?>
    </div>
    <div style="width:550px; height:20; display:inline; text-align:left">
		  <span class="bold">Code</span> :<?=$code_cours?>&nbsp;&nbsp;
		  <span class="bold">Enseignant</span> :<?=$nom_prenom?>&nbsp;&nbsp;
		  <span class="bold">Semestre</span> :
		  <?=($session=='automne') ? $txt_automne : $txt_printemps?>
		  &nbsp;<?=substr($annee_academique, 2, 2)?>&nbsp;&nbsp;
    </div>

     </td>

  </tr>
   <tr>
  <td height="10px"></td>
  </tr>
  <tr><td>
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="task" value="edit_syllabus" />
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="adminlist" >
    <tr class="entete" align="center" >

     <td width="60px">Week</td>
	 <td width="170px">Contenu</td>
	 <td width="300px">Progress report :Etat d'avancement</td>
  </tr> 

<?php
$code_cours=$_POST['boxchecked'];
$sql2="select * 
from $tbl_syllabus 
where code_cours='$code_cours'
and idSession='$idSession' limit 0,13"; 
$req=@mysql_query($sql2) or die( "erreur lors de sélection des syllabus");
while ($row=mysql_fetch_assoc($req)){
?>
<tr height="18px">

    <td align="left" class="bold" valign="top">&nbsp;week<?=htmlentities($row['week'])?></td>
	<td align="left" valign="top">&nbsp;<?=html_entity_decode(stripslashes($row['contenu']))?></td>
	<td align="left" valign="top">&nbsp;<?=html_entity_decode(stripslashes($row['avancement']))?></td>
  </tr>
  
  
 <?php
  }

  ?>
</table>
</form>
 
  <tr><td>
   <table width="550" border="0" cellspacing="0" cellpadding="0" class="fiche_footer">
  <?php
   $query="select * from  $tbl_footer where type='descriptif' limit 1";
   $req=@mysql_query($query) or die ("erreur lors de la création du footer");
   while($row=mysql_fetch_assoc($req)){
   ?>
  <tr>
    <td class="souligne" width="10%">Auteur</td>
    <td width="25%">: <?=$row['auteur1']?></td>
    <td class="souligne" width="10%">Auteur</td>
    <td width="25%">: <?=$row['auteur2']?></td>
	<td class="souligne" width="10%">Auteur</td>
    <td width="25%">: <?=$row['auteur3']?></td>
  </tr>
  <tr>
     <td class="souligne">Fonction</td>
	<td>: <?=$row['fonction1']?></td>
	 <td class="souligne">Fonction</td>
	<td>: <?=$row['fonction2']?></td>
	 <td class="souligne">Fonction</td>
	<td>: <?=$row['fonction3']?></td>
  
  </tr>
  <tr>
    <td class="souligne">Visa</td>
    <td>: &nbsp;<?=$row['visa1']?></td>
    <td class="souligne">Visa</td>
    <td>: &nbsp;<?=$row['visa2']?></td>
	<td class="souligne">Visa</td>
    <td>: &nbsp;<?=$row['visa3']?></td>
  </tr>
  <tr>
    <td class="souligne">Date</td>
	<td>: <?=$row['date1']?></td>
	<td class="souligne">Date</td>
	<td>: <?=$row['date2']?></td>
	<td class="souligne">Date</td>
	<td>: <?=$row['date3']?></td>
	</tr>
	<?php
	}
	?>
</table>
</td></tr>
  </td></tr>
</table>
 <?php
  }
  ?>