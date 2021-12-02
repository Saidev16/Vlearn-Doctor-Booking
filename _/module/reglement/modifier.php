<?php
 if(isset($_SESSION['id_reg'])){
   $id=$_SESSION['id_reg'];
   
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DU REGLEMENT INTERIEUR
	&nbsp;<span class="task">modifier</span></td>
	<td width="22%">
	  <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link">
	    <tr>
		  <td valign="top" align="center" >
		  
		  <a href="#" onclick="document.adminMenu.submit()"><div class="save"></div>Valider</a>
	      
		  </td>
		   
		</tr>
	  </table>
	</td> 
  </tr>
</table>
     <?php
            if(isset($_POST['reglement'])) {

            $reglement=addslashes($_POST['reglement']);

			$sql="UPDATE  $tbl_reglement SET `reglement`='$reglement' where id='$id'  ";

			@mysql_query($sql)or die ("erreur lors de la modification du reglement integrieur ");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
					window.location.replace('gestion_reglement.php');
			//-->
			</script>
              <?php
			  }
			  // c'est pour l'affichage
              ?>
			  

<table width="100%" align="center" cellspacing="1" >
<form action="#" method="post" name="adminMenu">
   <?php
 	$sql="select * from $tbl_reglement  where id='$id'";
 	$i=0;
 	$req=@mysql_query($sql) or die ("erreur lors de la sélection du reglement");
 	while ($ligne = mysql_fetch_array($req)) {
	$i++;
?>
       <form method="post"  action="" name="f_ajout"  >
		  <tr>
 		  <td>
		  <textarea style="width:800px; height:500px;" name="reglement">
		  	<?=html_entity_decode($ligne['reglement']); ?>
		  </textarea>
 	     </td>
 		  </tr>

<?php
      } 
	  
?>
  </form>
  </table>
  <?php
  }
  ?>