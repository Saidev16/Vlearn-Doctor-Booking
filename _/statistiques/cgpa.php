<?php $where=$gpa=$cgpa='';?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES STATISTIQUES 
 	</td>
	<td width="22%">&nbsp;</td> 
  </tr>
</table>
<div class="container_search">
  
 <select name="cgpa" id="cgpa" class="search" onchange="javascript:change(this.id)" >
     <option value="0" >CGPA</option>
     <option value="<2" <?php echo $cgpa=='<2' ? 'selected="selected"' : '' ?>>Less than 2</option>
     <option value=">3" <?php echo $cgpa=='>3' ? 'selected="selected"' : '' ?>>More than 3</option>
     <option value=">3.5" <?php echo $cgpa=='>3.5' ? 'selected="selected"' : '' ?>>More than 3.5</option>
 </select>
<input type="submit" name="valider" value="valider" class="input"/>
<input type="submit" value="tous" name="tous" class="input"  /> 
 </div>
<table width="100%" align="center" cellspacing="1"  class="adminlist" >
  <tr>
	 <th width="120">code d'inscription</th>
	 <th width="800">Nom et prénom</th>
  </tr>

       <?php
	   $i=0;
        $sql="SELECT n.code_inscription, nom, prenom, sum( gpa ) FROM `tbl_note` as n, tbl_etudiant as e GROUP BY idSession, e.code_inscription";
        $req=@mysql_query($sql) or die ($sql);
  	    while ($ligne = mysql_fetch_assoc($req)) {
		$i++;
 	    $ci=$ligne["code_inscription"];
      ?>

  <tr>
	  <td align="left"><?=$ci?></td>
	  <td align="left">&nbsp;<?=ucfirst($ligne["nom"]).' '.ucfirst($ligne["prenom"])?></td>
  </tr>

<?php
      }
?>
</form>
<tr class="gras">
	<td colspan="5">Nombre d'étudiants  : <?=$i?></td>
</tr>
 </table>
<?php echo $sql; ?>