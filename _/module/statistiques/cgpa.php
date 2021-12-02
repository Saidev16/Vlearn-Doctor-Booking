<?php $where=$gpa=$cgpa='';?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES STATISTIQUES 
 	</td>
	<td width="22%">&nbsp;</td> 
  </tr>
</table>
 
<table width="100%" align="center" cellspacing="1"  class="adminlist" >
  <tr>
	 <th width="120">code d'inscription</th>
	 <th width="800">Nom et prénom</th>
	 <th>CGPA</th>
  </tr>

       <?php
	   $i=0;
        $sql="SELECT n.code_inscription, nom, prenom, sum( gpa ) as cgpa, count(code_cours) as nbr 
		FROM `tbl_note` as n, tbl_etudiant as e 
		where e.code_inscription=n.code_inscription
		and letter_grade !='T'
        and final_grade > 0		
		GROUP BY  e.code_inscription";
        $req=@mysql_query($sql) or die ($sql);
  	    while ($ligne = mysql_fetch_assoc($req)) {
		$i++;
 	    $ci=$ligne["code_inscription"];
		 
      ?>

  <tr>
	  <td align="left"><?=$ci?></td>
	  <td align="left">&nbsp;<?=ucfirst($ligne["nom"]).' '.ucfirst($ligne["prenom"])?></td>
	  <td align="left">&nbsp;<?=substr($ligne["cgpa"]/$ligne["nbr"], 0, 6)?></td>
  </tr>

<?php
      }
?>
</form>
  </table>
 