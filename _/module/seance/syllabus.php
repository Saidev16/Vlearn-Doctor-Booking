<?php

 if (isset($_GET['syllabus'])){

	$code_seance=(int)$_GET['syllabus'];

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
	<span class="task">[syllabus]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="window.print"><div class="imprimer"></div>Imprimer</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_seance.php"><div class="retour"></div>Retour</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>

<!--entete-->

<?php

$sqlh="select * from $tbl_header where type='syllabus' limit 1";

 $result=@mysql_query($sqlh) or die ("erreur lors de la création du header");

 $row=mysql_fetch_assoc($result);

$logo=$row['logo'];
$title=$row['titre'];
$version=$row['version'];
$for_esm=$row['for_esm'];
$sous_logo=$row['sous_logo'];
?>

 <table width="575" border="0" cellspacing="1" align="center" cellpadding="0" height="70px" style="text-align:center" class="adminlist" style="text-align:center">

   <tr height="30px">
    <td rowspan="3" width="30%">
	<img src="<?=$targetLogo?><?=$logo?>" border="0" width="168" height="70" /><br />
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
   <table width="575" border="0" cellspacing="1" cellpadding="0" align="center"  >
             <tr>
         <td>
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
			  <?=$annee_academique?>&nbsp;&nbsp;</span>
        </div>

         </td>

      </tr>
   </table>
<table width="575" border="0" cellspacing="1" cellpadding="0" align="center" class="adminlist" style="margin-top:5px;">

<tr>
  <tr style="font-weight:bold; text-align:center">
    <td width="75">Week</td>
    <td width="325">Contenu</td>
    <td width="500">Etat d’avancement</td>
  </tr>
 <?php
     $sql="select * from $tbl_syllabus where code_cours='$code_cours' 
	 and idSession='$idSession' order by week limit 0, 13"; 
	  
     $req=mysql_query($sql) or die("erreur lors de la selection des syllabus");
     while ($row=mysql_fetch_assoc($req)){
  ?>

  <tr style="text-align:left">
     <td valign="top" class="gras">&nbsp;week<?=htmlentities($row['week'])?></td>
     <td valign="top">&nbsp;<?=html_entity_decode(stripslashes($row['contenu']))?></td>
     <td valign="top">&nbsp;<?=html_entity_decode(stripslashes($row['avancement']))?></td>
  </tr>
	<?php
	}
	?>
</table>

    <!--footer-->

          <table width="575" border="0" align="center" cellspacing="0" cellpadding="0" style="font-family:verdana; font-size:10px; border:#000000 1px solid; padding:1px; margin-top:5px">
   <?php
   $query="select * from  $tbl_footer where type='syllabus' limit 1";
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
    <!--end footer-->
<?php
}
}
?>