
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td class="titre">&nbsp;&nbsp;GESTION DES ETUDIANTS </td>
	<td width="150">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		   <td valign="top" align="center" >
		  <a href="#" onclick="window.print()" title="Imprimer">
		  <div class="imprimer"></div>Imprimer</a>
		  </td>
		</tr>
	  </table>

	</td> 

  </tr>

 </table>

 <table width="100%" cellspacing="1" border="0"  class="adminlist" >
<input type="hidden" name="boxchecked" value="0" />
  <tr align="center">
		 		 
		 <th width="177">Nom et pr&eacute;nom</th>
		 <th width="235">Note de test francais</th>
		 <th width="171">Note de test anglais</th>
		 <th width="190">Note de test mathematique</th>
		 <th width="186">Note de test logique</th>

 <th width="186">Session</th>		 
   </tr>

	  <?php
	 $sql1="select distinct(code_inscription),idSession
	 from tbl_inscription_cours 
        where (left(code_inscription,1)='9' OR left(code_inscription,1)='8') and (idSession=12 OR idSession=13) order by idSession";

	$result1 = @mysql_query($sql1) or die("erreur lors de s&eacute;lection des &eacute;tudiants");
 
while ($row = mysql_fetch_assoc($result1))
{

	   $cii=$row['code_inscription'];
$a=$row['idSession'];
 $sql="SELECT concat(e.nom, ' ' ,e.prenom) as name,e.test_fr ,e.test_math,e.test_logique ,e.test_eng              
		from tbl_etudiant e  where e.code_inscription='$cii'"; 


		
 $result2 = @mysql_query($sql) or die("erreur lors de s&eacute;lection des &eacute;tudiants"); 
		


		 while ($ligne = mysql_fetch_assoc($result2)) {
		 
		  
		   ?>

	   <tr height="17px">
	
		 <td>&nbsp;<?php echo $ligne['name'];?></td>
		 <td>&nbsp;<?php echo $ligne['test_fr'];?></td>
		 <td>&nbsp;<?php echo $ligne['test_math'];?></td>
		 <td>&nbsp;<?php echo $ligne['test_logique'];?></td>
		 <td>&nbsp;<?php echo $ligne['test_eng'];?></td>
<?php

if($a==12)
{$aa='Fall 2009';}
else
if($a==13)

{$aa='Spring 2010';}
?>
<td align="center" width="15px"><?=$aa?></td>
		 
	</tr>

	  		 <?php
		  }}


		 
		 ?>


	 </table>
