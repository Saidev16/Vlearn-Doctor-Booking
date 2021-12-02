<span id="titre_page">Déscriptif du cours</span>
<table width="550" border="0" cellspacing="1" cellpadding="0" align="center"  >
  <?php
        if (isset($_POST['boxchecked'])){
		
		$code_cours=$_POST['boxchecked'];
		$sql1="SELECT c.titre, s.session, s.annee_academique, p.nom_prenom
		FROM $tbl_professeur AS p, $tbl_session AS s, $tbl_cours AS c, $tbl_seance AS ss
		WHERE ss.code_cours='$code_cours'
		AND ss.idSession=s.idSession
		AND s.idSession='$idSession'
		AND ss.code_prof=p.code_prof limit 1 ";
		$req1=@mysql_query($sql1) or die ('erreur lors de la selection du titre ');
		$row=mysql_fetch_assoc($req1);
		
		$titre=$row['titre'];
		$session=$row['session'];
		$annee=$row['annee_academique'];
		$nom_prenom=$row['nom_prenom'];
		
		
		
		$header="SELECT * FROM $tbl_header WHERE type='descriptif' LIMIT 1";
		$req=@mysql_query($header) or die ("erreur lors de la création du hedaer");
		$row=mysql_fetch_assoc($req);
		$logo=$row['logo'];
		$title=$row['titre'];
		$version=$row['version'];
		$for_esm=$row['for_esm'];
		$sous_logo=$row['sous_logo'];		
		
		
	    $sql2="SELECT * 
		FROM $tbl_descriptif  
		WHERE code_cours ='$code_cours'
 		AND idSession='$idSession' LIMIT 1";

	    $req2=mysql_query($sql2) or die('erreur lors de la sélection du déscriptif du cours');
	    while($row=mysql_fetch_assoc($req2)){
		
		?>
   <tr>
    <td colspan="2" height="10px"></td>
  </tr>
  <tr>
    <td colspan="2" height="10px" align="right">
    <table width="150" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px">
  <tr>
    <td width="100px"></td>
	<td align="center" width="50px">
	<a href='student.php?task=cours' id="lien_msj">
	<div class="back"></div>retour</a>
	</td>
  </tr>
</table>
  <!--entete-->
  <table width="100%" border="0" cellspacing="1" cellpadding="0" height="70px" style="text-align:center" class="adminlist">
   <tr height="30px">
    <td rowspan="3" width="30%">
	<img src="images/logo/<?=$logo?>" border="0" width="168" height="70" />
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
  <tr><td colspan="2" height="8px"></td></tr>
  <tr>
    <td colspan="2" height="180px"  valign="top">
	<!--detail-->
	<table width="100%" border="0" cellspacing="3" cellpadding="0" class="adminlist" style=" padding:1px" >

  <tr>
    <td colspan="2" align="left">
     <div style="width:550px; height:17px; display:block">
          <span class="bold">Intitulé du cours</span> :<?=$titre?>
    </div>
    <div style="width:550px; height:20; display:inline">
		  <span class="bold">Code</span> :<?=$code_cours?>&nbsp;&nbsp;
		  <span class="bold">Enseignant</span> :<?=$nom_prenom?>&nbsp;&nbsp;
		  <span class="bold">Semestre</span> :
		  <?=($session=='automne') ? $txt_automne : $txt_printemps?>
		  &nbsp;<?=substr($annee, 2, 2)?>&nbsp;&nbsp;
    </div>
	</td>
  </tr>
   
  <tr>
    <td colspan="2" class="bold" align="left">OBJECTIFS COGNITIFS ET COMPORTEMENTAUX DU COURS : </td>
  </tr>
   <td colspan="2" height="2px"></td>
  <tr>
    <td colspan="2" class="bold" align="left">A la fin du semestre, les etudiants auront acquis les  competences suivantes:</td>
  </tr>
  <tr>
    <td colspan="2" height="50px" >
	&nbsp;<?=html_entity_decode(stripslashes($row['competence']))?>
	</td>
  </tr>
  <tr>
    <td colspan="2" class="bold" align="left">A la fin du semestre, les etudiants auront acquis les connaissances suivantes:</td>
  </tr>
  <tr>
    <td colspan="2" height="50px" >
	&nbsp;<?=html_entity_decode(stripslashes($row['connaissance']))?><br />
	</td>
   
  </tr>
  <tr>
        <td colspan="2" class="bold" align="left">A la fin du semestre, les etudiants auront acquis les attitudes suivantes:</td>
  </tr>
  <tr>
    <td colspan="2" height="50px" >
	&nbsp;<?=html_entity_decode(stripslashes($row['attitude']))?>
	</td>
  </tr>
  <tr>
    <td colspan="2" class="bold" align="left">CONTENU ACADEMIQUE DU COURS : </td>
  </tr>
  <tr>
    <td colspan="2" height="50px" >&nbsp;<?=html_entity_decode(stripslashes($row['contenu']))?></td>
  </tr>
  <tr>
    <td colspan="2" class="bold" align="left">METHODE D’ENSEIGNEMENT ET MOYENS PEDAGOGIQUES PREVUS,
IMPLICATION DES ETUDIANTS, ET APPLICATIONS DU CONTENU
ACADEMIQUE

:</td>
  </tr>
  <tr>
    <td colspan="2" height="50px" >&nbsp;<?=htmlentities(stripslashes($row['methode']))?></td>
  </tr>
  <tr>
    <td colspan="2" class="bold" align="left">EXIGENCES DU COURS ET MODALITES D’EVALUATIONS (CONTROLE CONTINU, EXAMENS, EXPOSES, RAPPORTS, PROJETS PRATIQUES, TRAVAIL DE TERRAIN, RECHERCHE SUR INTERNET)

:</td>
  </tr>
  <tr>
  <td colspan="2" height="50px" >
  &nbsp;<?=html_entity_decode(stripslashes($row['exigence']))?></td>
  </tr>
  <tr>
   <td colspan="2" class="bold" align="left">
   POURCENTAGE POUR CHAQUE COMPOSANTE DE LA NOTE FINALE (y compris la note de participation et des examens de mi-semestre et de fin de semestre) :
   </td>
  </tr>
  <tr>
   <td colspan="2" height="50px" >
   &nbsp;<?=html_entity_decode(stripslashes($row['pourcentage']))?><br />
   </td>
  </tr>
  <tr>
  <td colspan="2" class="bold" align="left">BIBLIOGRAPHIE : </td>
  </tr>
  <tr>
   <td colspan="2" height="50px" valign="top" >
   &nbsp;<?=html_entity_decode(stripslashes($row['bibliographie']))?></td>
  </tr>
   </table>
	<!--fin detail-->
	</td>
  </tr>
   <?php
  }
  ?>
  <tr>
    <td colspan="2" height="5px"></td>
  </tr>
  <tr>
  <td colspan="2">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="fiche_footer">
   <?php
   $query="select * from  $tbl_footer where type='descriptif' limit 1";
   $req=@mysql_query($query) or die ("erreur lors de la création du footer");
   while($row=mysql_fetch_assoc($req)){
   ?>
  <tr>
    <td class="souligne" width="10%">Auteur</td>
    <td width="25%">: <?=htmlentities($row['auteur1'])?></td>
    <td class="souligne" width="10%">Auteur</td>
    <td width="25%">: <?=htmlentities($row['auteur2'])?></td>
	<td class="souligne" width="10%">Auteur</td>
    <td width="25%">: <?=htmlentities($row['auteur3'])?></td>
  </tr>
  <tr>
     <td class="souligne">Fonction</td>
	<td>: <?=htmlentities($row['fonction1'])?></td>
	 <td class="souligne">Fonction</td>
	<td>: <?=htmlentities($row['fonction2'])?></td>
	 <td class="souligne">Fonction</td>
	<td>: <?=htmlentities($row['fonction3'])?></td>
  
  </tr>
  <tr>
    <td class="souligne">Visa</td>
    <td>: &nbsp;<?=htmlentities($row['visa1'])?></td>
    <td class="souligne">Visa</td>
    <td>: &nbsp;<?=htmlentities($row['visa2'])?></td>
	<td class="souligne">Visa</td>
    <td>: &nbsp;<?=htmlentities($row['visa3'])?></td>
  </tr>
  <tr>
    <td class="souligne">Date</td>
	<td>: <?=htmlentities($row['date1'])?></td>
	<td class="souligne">Date</td>
	<td>: <?=htmlentities($row['date2'])?></td>
	<td class="souligne">Date</td>
	<td>: <?=htmlentities($row['date3'])?></td>
	</tr>
	<?php
  }
  ?>
</table>
  </td></tr>
  </table>
<form name="adminmenu" action="" method="post">
<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
<input type="hidden" name="task" value="edit_descriptif" />
<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
</form>
    <?php
	  }
   ?>