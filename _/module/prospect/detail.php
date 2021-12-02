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
		  <a href="gestion_prospect.php?modifier=<?=$code_inscription?>">
		  <div class="modifier"></div>Modifier</a>
		  </td>
		   
		 <td valign="top" align="center" >
		  <a href="#" onclick="window.print()" title="Imprimer">
		  <div class="imprimer"></div>Imprimer</a>
		  </td>
		   <td align="right">
		 <a href="gestion_prospect.php"><div class="retour"></div>retour</a>
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
	  from tbl_prospect  as e, $tbl_groupe as g
	  where code_inscription='$id'
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
       
  </tr>
  
  <tr>
    <td ><span class="gras">Pr&eacute;nom</span> :&nbsp;<?=$row['prenom']?></td>
   
  </tr>
  
  
  
  
  
   <tr>
    <td ><span class="gras">Date d'inscription</span> :&nbsp;<?=$row['date_inscription']?></td>
  
  </tr>
  
    <tr>
    <td ><span class="gras">E-mail</span> :&nbsp;<?=$row['email']?></td>
   
  </tr>
  <tr>
   
    <td><span class="gras">Num&eacute;ro de t&eacute;l&eacute;phone</span> :&nbsp;<?=$row['tel']?></td>
  </tr>
  
   
  
   
   <tr>
    
    <td><span class="gras">Groupe :</span>&nbsp;<?=$row['title']?></td>
  </tr>
 
  <tr>
    
    <td><span class="gras">Besoin</span> :&nbsp;<?=$row['niveau']?></td>
  </tr>
  <tr>
    <td><span class="gras">Ville</span> :&nbsp;<?=$row['ville']?></td>
    
  </tr>
   <tr>
    <td><span class="gras">Observation</span> :&nbsp;<?=$row['observation']?></td>
    
  </tr>
 
  


  <?php
  }
  ?>
</table>
 <?php
  }
  ?>