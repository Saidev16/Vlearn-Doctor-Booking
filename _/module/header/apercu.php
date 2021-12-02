<style type="text/css">
input{
width:200px;
}
</style>
<script language="javascript1.2">
function valid_form(){
document.f_ajout.submit();
return true;
}
</script>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/classes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES ENTETES DE PAGE <span class="task">[aper&ccedil;u]</span> </td>
	<td width="22%">
	  <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" id="link">
	    <tr>
		  <td valign="top" align="center">
		   <a href="gestion_header.php"><div class="retour"></div>Retour</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>
 <table width="550px" border="0" align="center" cellspacing="1" cellpadding="0" height="70px" class="adminlist" style="text-align:center">
 <?php
 $id=$_GET["apercu"];
 $sql="select * from $tbl_header where id_header='$id'";
 $req=@mysql_query($sql) or die ("erreur lors de la sélection du header");
 $row=mysql_fetch_assoc($req);
 ?>
   <tr height="30px">
    <td rowspan="3" width="170px"><img src="../images/logo/<?=$row['logo']?>" border="0" width="168" height="70" />
	<br />
	<span style="font-weight:bold; width:70px; float:right; padding-left:10px; text-align:center"><?=$row['sous_logo']?></span>
	</td>
	<td width="170px" ><span style="color:#6666CC; font-weight:bold; text-align:center">Formulaire </span></td>
    <td width="170px"><span style="color:#FF0000; font-weight:bold"><?=$row['for_esm']?></span></td>
     </tr>
    <tr height="15px">
    <td rowspan="2"><span style="color:#339933; font-weight:bold; text-align:center"><?=$row['titre']?></span></td>
    <td  rowspan="2" ><span style="color:#666666; font-weight:bold"><?=$row['version']?></span>
	<br /><span style=" font-weight:bold; width:100%; display:block; border-top:#000000 1px solid"><?=$row['page']?></span>
	 </td>
  </tr>
  <tr height="10px"></tr>
</table>
