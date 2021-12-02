 <?php
	 if (isset($_GET['detail'])){
	 $code_inscription= $_GET['detail'];
	 ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;D&eacute;tail</span></td>
	<td width="90">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 
		  <td valign="top" align="center" >
		  <a href="gestion_preinscrit.php?modifier=<?=$code_inscription?>">
		  <div class="modifier"></div>Modifier</a>
		  </td>
		   
		 <td valign="top" align="center" >
		  <a href="#" onclick="window.print()" title="Imprimer">
		  <div class="imprimer"></div>Imprimer</a>
		  </td>
		   <td align="right">
		 <a href="gestion_preinscrit.php"><div class="retour"></div>retour</a>
		 </td>
		</tr>
	  </table>
	</td> 
  </tr>
  </table>
    
	 <table width="100%" border="0"  align="center" cellspacing="3" class="cellule_table">
	 <?php
	 $id=$_GET['detail'];
	  
	    $sql="select e.*,g.title
	  from tbl_preinscrit  as e, $tbl_groupe as g
	  where code_inscription='$id'
	  and e.groupe=g.id
	  limit 1";
	   $req=@mysql_query($sql) or die ("erreur lors du chargement de fiche de cet &eacute;tudiant1");
	    while($row=mysql_fetch_assoc($req)){
		$a=$row['filiere'];
		
	  if($a == "")
	  {?>
	  <tr>
		<td><span class="gras">Code d'inscription</span> :&nbsp;<?=$row['code_inscription']?></td>
		<td><span class="gras"></span>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"height="2px"></td>
   </tr>
   <tr>
       <td><span class="gras">Nom</span> :&nbsp;<?=$row['nom']?></td>
       <td><span class="gras">Dernier dipl&ocirc;me</span> :&nbsp;<?php //$row['last_diplome']?></td>
  </tr>
  
  <tr>
    <td ><span class="gras">Pr&eacute;nom</span> :&nbsp;<?=$row['prenom']?></td>
    <td><span class="gras">5 photos</span> :&nbsp;<?=($row['cinq_photo']==1) ? 'oui' : 'non'?></td>
  </tr>
  
  <tr>
    <td><span class="gras">Date de naissance</span> :&nbsp;<?=$row['date_naissance']?></td>
    <td><span class="gras">Copie du bac</span> :&nbsp;<?=($row['copie_bac']==1) ? 'oui' : 'non'?>
	</td>
  </tr>
  
  <tr>
    <td><span class="gras">Adresse</span> :&nbsp;<?=$row['adresse']?></td>
    <td><span class="gras">Nationalit&eacute;</span>:&nbsp;<?=$row['nationalite']?></td>
  </tr>
  
  <tr>
    <td><span class="gras">Code du bac</span> :&nbsp;<?=$row['code_bac']?></td>
    <td><span class="gras">Sexe</span> :&nbsp;<?=$row['sexe']?></td>
  </tr>
  
   <tr>
    <td ><span class="gras">Date d'inscription</span> :&nbsp;<?=$row['date_inscription']?></td>
    <td><span class="gras">Frais d'inscription</span> :&nbsp;<?=$row['fraisinscription']?></td>
  </tr>
  
    <tr>
    <td ><span class="gras">E-mail</span> :&nbsp;<?=$row['email']?></td>
    <td><span class="gras">Num&eacute;ro de t&eacute;l&eacute;phone</span> :&nbsp;<?=$row['tel']?></td>
  </tr>
  
    <tr>
    <td><span class="gras">Filiere</span> :&nbsp;<?=$row['nom_filiere']?></td>
    <td><span class="gras">Ann&eacute;e</span> :&nbsp;<?=$row['annee']?></td>
  </tr>
  
   <tr>
    <td ><span class="gras">CIN</span> :&nbsp;<?=$row['cin']?></td>
    <td><span class="gras">Lieu de naissance </span>:&nbsp;<?=$row['lieu_naissance']?></td>
  </tr>
  
   <tr>
    <td ><span class="gras">Copie de cin</span> :&nbsp;<?=($row['copie_cin']==1) ? 'oui' : 'non'?></td>
    <td><span class="gras">Buletin des notes</span> :&nbsp;<?=($row['buletin']==1) ? 'oui' : 'non'?></td>
  </tr>
  
   <tr>
    <td ><span class="gras">Note de teste de fran&ccedil;ais</span> :&nbsp;<?=$row['test_fr']?></td>
    <td><span class="gras">Extrait de naissance</span> :&nbsp;<?=$row['extrait_naissance']== 1 ? 'oui' : 'non'?></td>
  </tr>
  
    <tr>
    <td ><span class="gras">Aquise acad&eacute;mique</span> :&nbsp;<?=$row['aquise_academique']?></td>
    <td><span class="gras">Note de teste d'englais</span> :&nbsp;<?=$row['test_eng']?></td>
  </tr>
  
   <tr>
    <td><span class="gras">Login</span> :&nbsp;<?=$row['login']?></td>
    <td><span class="gras">Acc&egrave;s</span> :&nbsp;<?=($row['acces']==1) ? 'oui' : 'non'?></td>
  </tr>
  
   <tr>
    <td><span class="gras">Mot de passe</span> :&nbsp;<?=strtolower($row['cin'])?></td>
    <td><span class="gras">Groupe :</span>&nbsp;<?=$row['title']?></td>
  </tr>
  
 <tr>
    <td valign="top"><span class="gras">Activit&eacute; :</span>&nbsp;<?=$row['activite']?></td>
	<td valign="top"><span class="gras">Montant Bourse  :</span>&nbsp;<?=$row['montantbourse']?></td>
</tr>
<tr>
    <td><span class="gras">note de test de math&eacute;matique</span> :&nbsp;<?=$row['test_math']?></td>
    <td><span class="gras">note de test de logique</span> :&nbsp;<?=$row['test_logique']?></td>
  </tr>
   <tr>
    <td><span class="gras">Bac original</span> :&nbsp;<?=($row['reglement']==1) ? 'oui' : 'non'?></td>
    <td><span class="gras">Bac en anglais</span> :&nbsp;<?=($row['english_bac']==1) ? 'oui' : 'non'?></td>
  </tr>
  <tr>
    <td><span class="gras">Trois lettres</span> :&nbsp;<?=($row['trois_lettre']==1) ? 'oui' : 'non'?></td>
    <td><span class="gras">Trois enveloppes</span> :&nbsp;<?=($row['trois_enveloppe']==1) ? 'oui' : 'non'?></td>
  </tr>
  <tr>
    <td><span class="gras">Buletin de notes</span> :&nbsp;<?=($row['buletin']==1) ? 'oui' : 'non'?></td>
    <td><span class="gras">R&egrave;glement lu et approuv&eacute;</span> :&nbsp;<?=($row['reglement']==1) ? 'oui' : 'non'?></td>
  </tr>
  <tr>
    <td><span class="gras">Elearning</span> :&nbsp;<?=($row['elearning']==1) ? 'oui' : 'non'?></td>
    <td><span class="gras">Niveau</span> :&nbsp;<?=$row['niveau']?></td>
  </tr>
  <tr>
    <td><span class="gras">Ville</span> :&nbsp;<?=$row['ville']?></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2">
    	<span class="gras">PIIMT</span> :&nbsp;<?=$row['piimt']== 1 ? $oui : $non?>
        <span class="gras">AUL</span> :&nbsp;<?=$row['aul']== 1 ? $oui : $non?>
        <span class="gras">UMT</span> :&nbsp;<?=$row['umt']== 1 ? $oui : $non?>
    </td>
  </tr>
  <tr>
    <td><span class="gras">Observation</span> :&nbsp;<?=$row['observation']?></td>
  </tr>
	  <?php }
	  
	  else
	  {
	 
	 $sql="select e.*, f.nom_filiere, g.title
	  from tbl_preinscrit as e, tbl_filiere as f, $tbl_groupe as g
	  where code_inscription='$id'
	  and e.filiere=f.id_filiere 
	  and e.groupe=g.id
	  limit 1";
	  
	  
	 $req=@mysql_query($sql) or die ("erreur lors du chargement de fiche de cet &eacute;tudiant");
	 while($row=mysql_fetch_assoc($req)){
	 ?>
 	<tr>
		<td><span class="gras">Code d'inscription</span> :&nbsp;<?=$row['code_inscription']?></td>
		<td><span class="gras"></span>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"height="2px"></td>
   </tr>
   <tr>
       <td><span class="gras">Nom</span> :&nbsp;<?=$row['nom']?></td>
       <td><span class="gras">Dernier dipl&ocirc;me</span> :&nbsp;<?php //$row['last_diplome']?></td>
  </tr>
  
  <tr>
    <td ><span class="gras">Pr&eacute;nom</span> :&nbsp;<?=$row['prenom']?></td>
    <td><span class="gras">5 photos</span> :&nbsp;<?=($row['cinq_photo']==1) ? 'oui' : 'non'?></td>
  </tr>
  
  <tr>
    <td><span class="gras">Date de naissance</span> :&nbsp;<?=$row['date_naissance']?></td>
    <td><span class="gras">Copie du bac</span> :&nbsp;<?=($row['copie_bac']==1) ? 'oui' : 'non'?>
	</td>
  </tr>
  
  <tr>
    <td><span class="gras">Adresse</span> :&nbsp;<?=$row['adresse']?></td>
    <td><span class="gras">Nationalit&eacute;</span>:&nbsp;<?=$row['nationalite']?></td>
  </tr>
  
  <tr>
    <td><span class="gras">Code du bac</span> :&nbsp;<?=$row['code_bac']?></td>
    <td><span class="gras">Sexe</span> :&nbsp;<?=$row['sexe']?></td>
  </tr>
  
   <tr>
    <td ><span class="gras">Date d'inscription</span> :&nbsp;<?=$row['date_inscription']?></td>
    <td><span class="gras">Frais d'inscription</span> :&nbsp;<?=$row['fraisinscription']?></td>
  </tr>
  
    <tr>
    <td ><span class="gras">E-mail</span> :&nbsp;<?=$row['email']?></td>
    <td><span class="gras">Num&eacute;ro de t&eacute;l&eacute;phone</span> :&nbsp;<?=$row['tel']?></td>
  </tr>
  
    <tr>
    <td><span class="gras">Filiere</span> :&nbsp;<?=$row['nom_filiere']?></td>
    <td><span class="gras">Ann&eacute;e</span> :&nbsp;<?=$row['annee']?></td>
  </tr>
  
   <tr>
    <td ><span class="gras">CIN</span> :&nbsp;<?=$row['cin']?></td>
    <td><span class="gras">Lieu de naissance </span>:&nbsp;<?=$row['lieu_naissance']?></td>
  </tr>
  
   <tr>
    <td ><span class="gras">Copie de cin</span> :&nbsp;<?=($row['copie_cin']==1) ? 'oui' : 'non'?></td>
    <td><span class="gras">Buletin des notes</span> :&nbsp;<?=($row['buletin']==1) ? 'oui' : 'non'?></td>
  </tr>
  
   <tr>
    <td ><span class="gras">Note de teste de fran&ccedil;ais</span> :&nbsp;<?=$row['test_fr']?></td>
    <td><span class="gras">Extrait de naissance</span> :&nbsp;<?=$row['extrait_naissance']== 1 ? 'oui' : 'non'?></td>
  </tr>
  
    <tr>
    <td ><span class="gras">Aquise acad&eacute;mique</span> :&nbsp;<?=$row['aquise_academique']?></td>
    <td><span class="gras">Note de teste d'englais</span> :&nbsp;<?=$row['test_eng']?></td>
  </tr>
  
   <tr>
    <td><span class="gras">Login</span> :&nbsp;<?=$row['login']?></td>
    <td><span class="gras">Acc&egrave;s</span> :&nbsp;<?=($row['acces']==1) ? 'oui' : 'non'?></td>
  </tr>
  
   <tr>
    <td><span class="gras">Mot de passe</span> :&nbsp;<?=strtolower($row['cin'])?></td>
    <td><span class="gras">Groupe :</span>&nbsp;<?=$row['title']?></td>
  </tr>
  
 <tr>
    <td valign="top"><span class="gras">Activit&eacute; :</span>&nbsp;<?=$row['activite']?></td>
	<td valign="top"><span class="gras">Montant Bourse  :</span>&nbsp;<?=$row['montantbourse']?></td>
</tr>
<tr>
    <td><span class="gras">note de test de math&eacute;matique</span> :&nbsp;<?=$row['test_math']?></td>
    <td><span class="gras">note de test de logique</span> :&nbsp;<?=$row['test_logique']?></td>
  </tr>
   <tr>
    <td><span class="gras">Bac original</span> :&nbsp;<?=($row['reglement']==1) ? 'oui' : 'non'?></td>
    <td><span class="gras">Bac en anglais</span> :&nbsp;<?=($row['english_bac']==1) ? 'oui' : 'non'?></td>
  </tr>
  <tr>
    <td><span class="gras">Trois lettres</span> :&nbsp;<?=($row['trois_lettre']==1) ? 'oui' : 'non'?></td>
    <td><span class="gras">Trois enveloppes</span> :&nbsp;<?=($row['trois_enveloppe']==1) ? 'oui' : 'non'?></td>
  </tr>
  <tr>
    <td><span class="gras">Buletin de notes</span> :&nbsp;<?=($row['buletin']==1) ? 'oui' : 'non'?></td>
    <td><span class="gras">R&egrave;glement lu et approuv&eacute;</span> :&nbsp;<?=($row['reglement']==1) ? 'oui' : 'non'?></td>
  </tr>
  <tr>
    <td><span class="gras">Elearning</span> :&nbsp;<?=($row['elearning']==1) ? 'oui' : 'non'?></td>
    <td><span class="gras">Niveau</span> :&nbsp;<?=$row['niveau']?></td>
  </tr>
  <tr>
    <td><span class="gras">Ville</span> :&nbsp;<?=$row['ville']?></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2">
    	<span class="gras">PIIMT</span> :&nbsp;<?=$row['piimt']== 1 ? $oui : $non?>
        <span class="gras">AUL</span> :&nbsp;<?=$row['aul']== 1 ? $oui : $non?>
        <span class="gras">UMT</span> :&nbsp;<?=$row['umt']== 1 ? $oui : $non?>
    </td>
  </tr>
  <tr>
    <td><span class="gras">Observation</span> :&nbsp;<?=$row['observation']?></td>
  </tr>


  <?php
  }}}
  ?>
</table>
 <?php
  }
  ?>