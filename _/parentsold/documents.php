<span id="titre_page">Documents</span>
<span><a href="professeur.php?task=addDoc" style="color:#000;">Ajouter un document</a></span>
<fieldset>
	<legend>Recherche</legend>
<form name="search" method="post" action="">
<select name="idSession" class="select">
	<option value="">Sélectionner une session</option>
	<?php 
	$session = isset($_POST['idSession']) ? $_POST['idSession'] : '';
	$titre = isset($_POST['titre']) ? addslashes($_POST['titre']) : '';
	$sql = "select * from $tbl_session";
	$req = @mysql_query($sql);
	while($row = mysql_fetch_assoc($req)){
	?>
	<option value="<?=$row['idSession']?>" <?=$row['idSession']==$session ? $selected : '' ?>><?=$row['session']?>&nbsp;<?=$row['annee_academique']?></option>
	<?php
	}
	?>
</select>
<input type="text" class="input" name="titre" value="<?=$titre?>" id="titre" size="50" />
<input type="submit" class="bouton" value="valider" />
</form>
</fieldset>
<table width="575" border="0" cellspacing="1" cellpadding="0" id="tbl_demande" style="margin-top:10px; border:#333333 1px solid">
  <tr class="entete" align="center">
     <td width="75">Date</td>
	 <td width="400">Titre</td>
  </tr>
  <tr><td colspan="3" height="1px" bgcolor="#333333"></td></tr>
  <?php
  $where = '';
  if (isset($_POST['titre']) && !empty($_POST['titre']) ){
  		$titre = addslashes($_POST['titre']);
   		$where  = $where . " and titre like '%$titre%'";
  }
  
   if (isset($_POST['idSession']) && !empty($_POST['idSession']) ){
   		$session = (int)$_POST['idSession'];
  		$where = $where . " and idSession = '$session' ";
  }
  
  $nombre=0;
  if (isset($_SESSION['code_prof'])){
  $code_prof=$_SESSION['code_prof'];
  $sql="select * from tbl_docman where archive = 0 AND code_prof = '$code_prof' " . $where . ' ORDER BY date DESC';
  $req=@mysql_query($sql) or die ("erreur lors de la sélection des documents  ");
  $nombre=mysql_num_rows($req);
  while($row=mysql_fetch_assoc($req)){
  ?>
  <tr valign="top" align="left">
    <td valign="top">&nbsp;<?=htmlentities($row['date'])?></td>
    <td valign="top">&nbsp;<a href="http://<?=$_SERVER['HTTP_HOST']?>/piimt/module/demande/fichier/<?php echo $row['nom'];?>" style="color:#000; text-decoration:none; font-size:10px"><?=stripslashes(ucfirst($row['titre']))?></a></td>
  </tr>
   <tr><td colspan="3" height="1px" bgcolor="#333333"></td></tr>
  <?php
  }
  }
  ?>
  <tr><td colspan="3" height="5px" class="footer_table">Totale :<?=$nombre?></td></tr>
</table>
