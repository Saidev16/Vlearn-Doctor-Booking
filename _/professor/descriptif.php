

<span id="titre_page">Déscriptif du cours</span>
<table width="550" border="0" cellspacing="1" cellpadding="0" align="center"  >
  <?php
        if (isset($_POST['boxchecked'])){
		$code_cours=$_POST['boxchecked'];
		$header="select * from $tbl_header where type='descriptif' limit 1";
		$req=@mysql_query($header) or die ("erreur lors de la création du hedaer");
		$row=mysql_fetch_assoc($req);
		$logo=$row['logo'];
		$title=$row['titre'];
		$version=$row['version'];
		$for_esm=$row['for_esm'];
		$sous_logo=$row['sous_logo'];
		
		$sql="select annee_academique, session 
		from $tbl_session 
		where idSession='$idSession'";
		$req=@mysql_query($sql) or die ('erreur lors de la selection des session');
		$row=mysql_fetch_assoc($req);
		$session=$row['session']; 
		$annee=$row['annee_academique'];
		
	    $sql1="SELECT d.* , c.titre, p.nom_prenom
		FROM $tbl_descriptif AS d, $tbl_cours AS c, $tbl_professeur as p, $tbl_seance as s
		WHERE d.code_cours ='$code_cours'
        and d.code_cours=s.code_cours
		AND c.code_cours = d.code_cours
        and s.code_prof=p.code_prof
		and d.idSession='$idSession'
		and s.idSession=d.idSession LIMIT 0 , 1"; 
	    $req1=mysql_query($sql1) or die('erreur lors de la sélection du déscriptif du cours');
	    while($row=mysql_fetch_assoc($req1)){
		?>
   <tr>
    <td colspan="2" height="10px"></td>
  </tr>
  <tr>
    <td colspan="2" height="10px" align="right">
	<table width="150" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px" id="lien_msj">
  <tr>
    <td ></td>
	<td align="center" width="50px">
		<a href="#" onclick="window.print()"><div class="imprimer"></div>Print</a>
	</td>
    <td align="center"  width="50px">
		<a href="#" onclick="document.adminmenu.submit()"><div class="edit"></div>Editer</a>
	</td>
	<td align="center"  width="50px">
		<a href='professeur.php?task=cours'><div class="back"></div>retour</a>
	</td>
  </tr>
</table>
  <!--entete-->
  <table width="550" border="0" cellspacing="1" cellpadding="0" height="70px" style="text-align:center" class="adminlist">
   <tr height="30px">
    <td rowspan="3" width="30%">
	<img src="images/logo/<?=$logo?>" border="0" width="168" height="70" />
	<br />
	<span id="sous_logo"><?=$sous_logo?></span>
	</td>
	<td width="30%" ><span id="formulaire">Formulaire</span></td>
    <td width="30%"><span id="for_esm"><?=$for_esm?></span></td>
     </tr>
 <tr height="15px">
    <td rowspan="2"><span id="tit"><?=$title?></span></td>
    <td  rowspan="2" ><span id="version"><?=$version?></span></td>
  </tr>
  <tr height="10px"></tr>
</table>
<!--  fin entete-->
  </td></tr>
  <tr><td colspan="2" height="8px"></td></tr>
  <tr>
    <td colspan="2" height="180px"  valign="top">
	<!--detail-->
	<table width="550" border="0" cellspacing="3" cellpadding="0" class="adminlist" style=" padding:1px; text-align:left;" >

  <tr>
    <td colspan="2" align="left">
     <div id="titre_cours">
          <span class="bold">Intitulé du cours</span> :<?=htmlentities($row['titre'])?>
    </div>
    <div id="titre1">
		  <span class="bold">Code</span> :<?=stripslashes($row['code_cours'])?>&nbsp;&nbsp;
		  <span class="bold">Enseignant</span> :<?=htmlentities($row['nom_prenom'])?>&nbsp;&nbsp;
		  <span class="bold">Session</span> :<?=$session?>&nbsp;<?=$annee?>&nbsp;&nbsp;
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
    <td colspan="2" height="50px" >&nbsp;<?=html_entity_decode(stripslashes($row['methode']))?></td>
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
   <?php echo html_entity_decode(stripslashes($row['pourcentage'])); ?>
    
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
    $row=mysql_fetch_assoc($req);
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