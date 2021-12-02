<?php

 if (isset($_GET['descriptif'])){

     $code_seance=$_GET['descriptif'];

     $sql="select  ss.session, ss.annee_academique, ss.idSession, s.code_cours, c.titre, 
	 p.nom_prenom  from
     $tbl_descriptif as d, $tbl_seance as s, $tbl_session as ss, 
	 $tbl_cours as c , $tbl_professeur as p
     where s.code_seance='$code_seance'
     and s.code_cours=c.code_cours
     and s.code_prof=p.code_prof
	 and ss.idSession=s.idSession
     and d.code_cours=s.code_cours limit 1";

     $req=mysql_query($sql) or die("erreur lors de la sélection sous entete");

     $row=mysql_fetch_assoc($req);

     $code_cours=$row['code_cours'];
     $nom_prenom=$row['nom_prenom'];
     $session=$row['session'];
     $titre=$row['titre'];
	 $idSession=$row['idSession'];
     $annee_academique=$row['annee_academique'];
		?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/cours.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES SEANCES DES COURS 
	<span class="task">[descriptif]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onblur="window.print()"><div class="imprimer"></div>Imprimer</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_seance.php"><div class="retour"></div>Retour</a>		 
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
 <table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
 <?php

		 $sqlh="select * from $tbl_header where type='descriptif' limit 1";
		 $req=@mysql_query($sqlh) or die ("erreur lors de la création du hedaer");
		 $row=mysql_fetch_assoc($req);
		 $logo=$row['logo'];
		 $title=$row['titre'];
		 $version=$row['version'];
		 $for_esm=$row['for_esm'];
		 $sous_logo=$row['sous_logo'];

		$sql1=" SELECT * from $tbl_descriptif where code_cours='$code_cours' 
		and idSession='$idSession'";
	    $req=mysql_query($sql1) or die('erreur lors de la sélection du cours');
	    while($row=mysql_fetch_assoc($req)){

		?>

		<tr>

		<td colspan="2" height="70px">

		 <!--entete-->

<table width="575" border="0" align="center" cellspacing="1" cellpadding="0"
		   height="70px" class="adminlist" style="text-align:center" >
   <tr height="30px">
    <td rowspan="3" width="30%">
	<img src="<?=$targetLogo?><?=$logo?>" border="0" width="160" height="65" /><br />
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

</td>

		</tr>

   <tr>

    <td colspan="2" height="10px"></td>

  </tr>

   <tr>

    <td colspan="2" height="180px"  valign="top">

	<table width="550" border="0" align="center" cellspacing="3" cellpadding="0" class="adminlist" style="text-align:left; padding-left:2px">

  <tr>

    <td colspan="2" style="border:none; padding:0; margin:0">

	<table width="575" border="0" cellspacing="1" cellpadding="0" style="text-align:left; padding-left:2px">
  <tr>
       <td colspan="2">

       <div style="width:100%; height:20px; display:block; font_size:11px">
              <span class="gras">Intitulé du cours</span> :
			  <span class="medium_font"><?=$titre?> </span>
        </div>
        <div style="width:100%; height:20; display:inline">
    		  <span class="gras">Code</span> :<span class="medium_font">
			  <?=$code_cours?>&nbsp;&nbsp;</span>
    		  <span class="gras">Enseignant</span> :<span class="medium_font">
			  <?=$nom_prenom?>&nbsp;&nbsp;</span>
    		  <span class="gras">Semestre</span> :<span class="medium_font">
			  <?=$session ?>&nbsp;
			  <?=$annee_academique ?>&nbsp;&nbsp;</span>
        </div>

       </td>

      </tr>

	 </table>

	</td>

  </tr>

   

  <tr>

    <td colspan="2" class="gras">OBJECTIFS COGNITIFS ET COMPORTEMENTAUX DU COURS : </td>

  </tr>

   <td colspan="2" height="2px"></td>

  <tr>

    <td colspan="2" class="gras" >A la fin du semestre, les etudiants auront acquis les  competences suivantes:</td>
  </tr>
  <tr>
    <td colspan="2" height="50px">&nbsp;<?=html_entity_decode($row['competence'])?></td>
  </tr>
  <tr>
    <td colspan="2" class="gras">
	A la fin du semestre, les etudiants auront acquis les connaissances suivantes:
	</td>
  </tr>

  <tr>
    <td colspan="2" height="50px">&nbsp;<?=html_entity_decode($row['connaissance'])?></td>
  </tr>

  <tr>

        <td colspan="2" class="gras">A la fin du semestre, les etudiants auront acquis les attitudes suivantes:</td>

  </tr>

  <tr>
    <td colspan="2" height="50px">&nbsp;<?=html_entity_decode($row['attitude'])?></td>
  </tr>

  <tr>
    <td colspan="2" class="gras">CONTENU ACADEMIQUE DU COURS : </td>
  </tr>

  <tr>
    <td colspan="2" height="50px" >&nbsp;<?=html_entity_decode($row['contenu'])?></td>
  </tr>

  <tr>
    <td colspan="2" class="gras">METHODE D’ENSEIGNEMENT ET MOYENS PEDAGOGIQUES PREVUS,
IMPLICATION DES ETUDIANTS, ET APPLICATIONS DU CONTENU ACADEMIQUE:</td>
  </tr>
  <tr>
    <td colspan="2" height="50px" >&nbsp;<?=html_entity_decode($row['methode'])?></td>
  </tr>
  <tr>
    <td colspan="2" class="gras">EXIGENCES DU COURS ET MODALITES D’EVALUATIONS (CONTROLE CONTINU, EXAMENS, EXPOSES, RAPPORTS, PROJETS PRATIQUES, TRAVAIL DE TERRAIN, RECHERCHE SUR INTERNET) :</td>
  </tr>

  <tr>
  <td colspan="2" height="50px" id="contenu_descriptif">&nbsp;<?=html_entity_decode($row['exigence'])?></td>
  </tr>

  <tr>
   <td colspan="2" class="gras" >POURCENTAGE POUR CHAQUE COMPOSANTE DE LA NOTE FINALE (y compris la note de participation et des examens de mi-semestre et de fin de semestre) : </td>
  </tr>

  <tr>
   <td colspan="2" height="50px">&nbsp;<?=html_entity_decode($row['pourcentage'])?></td>
  </tr>

  <tr>
  <td colspan="2" class="gras">BIBLIOGRAPHIE : </td>
  </tr>

  <tr>
   <td colspan="2" height="50px" valign="top" >&nbsp;<?=html_entity_decode($row['bibliographie'])?></td>
  </tr>

  <?php
  }
  ?>
   </table>
	<!--fin detail-->
	</td>
  </tr>

  <tr>
    <td colspan="2" height="5px"></td>
  </tr>

  </table>
   <table width="575" border="0" align="center" cellspacing="0" cellpadding="0" style="font-family:verdana; font-size:10px; border:#000000 1px solid; padding:1px; margin-top:5px">
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
</table>
<?php
}
}
?>