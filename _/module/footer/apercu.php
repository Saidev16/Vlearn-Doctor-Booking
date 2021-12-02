<style type="text/css">
input{
width:200px;
}
</style>
<script language="javascript1.2">
function valid_form(){
document.f_ajout.submit();
}
</script>

			<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES EMPRUNTS 
	<span class="task">[aper&ccedil;u]</span> </td>
	<td width="22%">
	  <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="gestion_footer.php"><div class="retour"></div>Retour</a>
		
		   </td>
		</tr>
	  </table>	
	  </td> 
  </tr>
</table>
	  <table width="550" border="0" cellspacing="0" align="center" cellpadding="0" id="table_footer">
	  <?php
	   $id=$_GET["apercu"];
			  $sql2="select * from $tbl_footer where  id_footer='$id'";
			  $req2=@mysql_query($sql2) or die("erreur dans la requette");
			  $row=mysql_fetch_assoc($req2);
			  ?>
  <tr>
    <td>Auteur:</td>
    <td><?=htmlentities($row['auteur1'])?></td>
    <td>Auteur:</td>
    <td><?=htmlentities($row['auteur2'])?></td>
    <td>Auteur:</td>
    <td><?=htmlentities($row['auteur3'])?></td>
  </tr>
   <tr><td height="3px" colspan="6"></td></tr>
  <tr>
    <td>Fonction:</td>
    <td><?=htmlentities($row['fonction1'])?></td>
    <td>Fonction:</td>
    <td><?=htmlentities($row['fonction2'])?></td>
    <td>Fonction:</td>
    <td><?=htmlentities($row['fonction3'])?></td>
  </tr>
   <tr><td height="3px" colspan="6"></td></tr>
  <tr>
    <td>Visa:</td>
    <td><?=htmlentities($row['visa1'])?></td>
    <td>Visa:</td>
    <td><?=htmlentities($row['visa2'])?></td>
    <td>Visa:</td>
    <td><?=htmlentities($row['visa3'])?></td>
  </tr>
  <tr><td height="3px" colspan="6"></td></tr>
  <tr>
    <td>Date:</td>
    <td><?=htmlentities($row['date1'])?></td>
    <td>Date:</td>
    <td><?=htmlentities($row['date2'])?></td>
    <td>Date:</td>
    <td><?=htmlentities($row['date3'])?></td>
  </tr>
</table>
  