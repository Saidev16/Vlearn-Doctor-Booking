<?php
	if (isset($_POST['code'])){
	    
		$libele=addslashes($_POST['libele']);
		$semestre=$_POST['semestre'];
		$session=$_POST['session'];
		$nbr_credit=addslashes($_POST['nbr_credit']);
		$titre_en=addslashes($_POST['titre_en']);
		$code=trim(addslashes($_POST['code']));
	
	if(!empty($_POST['type']) && !empty($_POST['type1'])){ $type=$_POST['type'].'/'.$_POST['type1'];} 
						else if(!empty($_POST['type'])){  $type=$_POST['type'];} 
							else if(!empty($_POST['type1'])){  $type=$_POST['type1'];}
								else if(!empty($_POST['type2'])){  $type=$_POST['type2'];}  
												  					

		//insertion du cours
		$sqlzin="SELECT max(`code_cours_testing`) as max FROM tbl_cours ";
$sqlzin1 =mysql_query($sqlzin) or die("erreur lors de traitement de F*");
	
$ab= mysql_fetch_assoc($sqlzin1);
$cu= $ab["max"];
$code_cours_testing= $cu+1;
	$sql="INSERT INTO $tbl_cours ( `code_cours` ,code_cours_testing, `titre` , `titre_eng` , `nbr_credit` ,`session` , 
	`semestre` , `type` , `inscription`  ) VALUES ('$code' ,'$code_cours_testing', '$libele', '$titre_en', '$nbr_credit',
	'$session', '$semestre', '$type', '1');";

    @mysql_query($sql)or die ("erreur lors de l'ajout du nouveau cours ");
	   
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_cours.php');
			//-->
			</script>
              <?php
						}
				  else{
			  ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/cours.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES COURS <span class="task">[ajouter]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="validate()"><div class="save"></div>Valider</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_cours.php" ><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
 <form method="post" action="gestion_cours.php?new=oui" name="f_ajout"  >
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
		 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
			<tr>
				<td colspan="2" height="3px"><div id="er_code" class="erreur"></div></td>
			</tr>
			
		   	<tr>
			  <td width="15%" class="gras"><label for="code">Code cours  : </label></td>
			  <td width="85%"><input type="text" name="code" id="code" style="width:100px" class="input" onkeyup="OnAddVerify()"/></td> 
		    </tr>
			
		    <tr>
		  		<td colspan="2" height="3px"><div id="er_libele" class="erreur"></div></td>
		    </tr>
			
		    <tr>
		  		<td class="gras"><label for="libele">Titre en Français : </label></td>
		        <td><input type="text" name="libele" id="libele" style="width:550px" class="input" /></td>
		   </tr>
		   
		   <tr>
		  		<td colspan="2" height="3px"><div id="er_titre_en" class="erreur"></div></td>
		   </tr>
			
		   <tr>
			   <td class="gras"><label for="titre_en">Titre en Englais :</label> </td>
			   <td><input type="text" name="titre_en" id="titre_en" style="width:550px" class="input"/></td>
		  </tr>
		  
		 <tr>
			   <td colspan="2" height="3px"></td>
		 </tr>
	 
	    <tr>
		    <td class="gras"><label for="nbr_credit">Nombre de crédit :</label> </td>
		    <td><input type="text" name="nbr_credit" id="nbr_credit"  style="width:100px" class="input" /></td>
		</tr>
		
	    <tr>
			<td colspan="3" height="3px"></td>
		</tr>
	
	  
		  
	<tr>
		<td colspan="2" height="3px"></td>
	</tr>
	  </table>
	  			</td>
	  		</tr>
		</table>
</form>
<?php
}
?>