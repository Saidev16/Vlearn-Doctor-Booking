<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DU SONDAGE <span style="font-size:12px">[statéstiques]</span> </td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" >
	    <tr>
		<td width="80%"></td>
			<td valign="top" align="center">
		   <a href="gestion_sondage.php" id="lien_msj">
		  <div style="background:top url(images/retour.gif) ; width:32; height:34;"></div>Retour</a>
		  </td> 
		</tr>
	  </table>
	</td> 
</table>
<?php
$sql="select objet from $tbl_sondage ";
$req=@mysql_query($sql) or die("erreur lors de la seléction du sondage");
$total=mysql_num_rows($req);
$ami= $Bouche=$website=$forum= $visite=$supports=$autre=0;
while ($row=mysql_fetch_assoc($req)){
switch ($row['objet']){
    case 'Amis(e)/Famille' :
    $ami+=1;
    break; 
	 case 'Bouche à oreille' :
    $Bouche+=1;
    break; 

 case 'website' :
    $website+=1;
    break; 

 case 'forum' :
    $forum+=1;
    break; 

 case 'visite de ilcs' :
    $visite+=1;
    break; 
	
 case 'supports publicitaires' :
    $supports+=1;
    break; 
 case 'autre' :
    $autre+=1;
    break; 
	}
}
$ami=($ami/$total) * 100;
$Bouche=($Bouche/$total) * 100;
$website=($website/$total) * 100;
$forum=($forum/$total) * 100;
$visite=($visite/$total) * 100;
$supports=($supports/$total) * 100;
$autre=($autre/$total) * 100;
?>
<table width="999" align="center" cellspacing="1"  style="margin-top:5px; font-family:verdana; font-size:11px; text-align:left">
  <tr><td width="110px"></td><td width="780"></td></tr>
  <tr>
  <td colspan="2"><b>Par quel intermédiaire vous avez connu ILCS ?</b></td>
  </tr>
    <tr><td height="10px" colspan="2"></td></tr>

  <tr>
  <td width="110px">Amis(e)/Famille:</td>
  <td><?=substr($ami, 0 ,5)?>%  </td>
 
  </tr>
   <tr>
   <td>Bouche à oreille:</td>
   <td><?=substr($Bouche, 0 ,5)?>%</td> 
   
    </tr>
	 <tr>
    <td>website: </td>
	<td><?=substr($website, 0, 5)?>%</td>
	 </tr>
	  <tr>
	 <td>forum:</td>
	 <td> <?=substr($forum, 0, 5)?>%</td>
	  </tr>
	   <tr>
	  <td>visite de ilcs: </td>
	  <td> <?=substr($visite, 0, 5)?>%</td>
	   </tr>
	    <tr>
	  <td>supports publicitaires: </td>
	  <td><?=substr($supports, 0, 5)?>%</td>
	   </tr> 
	   <tr>
	  <td>Autres: </td>
	  <td><?=substr($autre, 0, 5)?>%</td>
  </tr>
  <tr><td height="10px" colspan="2"></td></tr>
  <tr><td colspan="2">Nombre de votes: <?=$total?></td></tr>
  <?php
  $sql1="select max(date) as max, min(date) as min from $tbl_sondage";
  $req=@mysql_query($sql1) or die ("erreur lors de la sélection des date ");
  $row=mysql_fetch_assoc($req);
  ?>
  <tr><td colspan="2">Premier vote: <?=$row['min']?></td></tr>
  <tr><td colspan="2">Dernier vote: <?=$row['max']?></td></tr>
 </table>
