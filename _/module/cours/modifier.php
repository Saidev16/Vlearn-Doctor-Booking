<?php

	if (isset($_POST['code'])){

					$libele=addslashes($_POST['libele']);
					$titre_eng=addslashes($_POST['titre_eng']);
					$semestre=$_POST['semestre'];
					$session=$_POST['session'];
					$nbr_credit=addslashes($_POST['nbr_credit']);
 					$code=$_POST['code'];
					$ex_code=$_POST['id'];
					if(!empty($_POST['type']) && !empty($_POST['type1'])){ $type=$_POST['type'].'/'.$_POST['type1'];} 
						else if(!empty($_POST['type'])){  $type=$_POST['type'];} 
							else if(!empty($_POST['type1'])){  $type=$_POST['type1'];} 
								else if(!empty($_POST['type2'])){  $type=$_POST['type2'];} 
					 
					
 						if($ex_code!=$code){

	//mise  jour table cours

	$sql1="update $tbl_cours set code_cours='$code',`titre` = '$libele',`titre_eng` = '$titre_eng',
	`nbr_credit` = '$nbr_credit',`session` = '$session',`semestre` = '$semestre',`type` = '$type'
     where code_cours='$ex_code' limit 1";
	@mysql_query($sql1) or die("erreur lors de la mise &aacute; jours du cours");

 	//mise a jour table inscription session

  //  $sql2="update $tbl_inscription_session set code_cours='$code' where code_cours='$ex_code' limit 1";
	//@mysql_query($sql2) or die("erreur lors de la mise a jours de la table inscription session");

 	//mise a jour tale inscription cours

	$sql3="update $tbl_inscription_cours set code_cours='$code' where code_cours='$ex_code'";
    @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

 	//mise a jour table note

	$sql4="update $tbl_note set code_cours='$code' where code_cours='$ex_code'";
	@mysql_query($sql4) or die("erreur lors de la mise a jours de la table note");

 	//mise a jour table absence

	$sql5="update $tbl_absence set code_cours='$code' where code_cours='$ex_code'";
	@mysql_query($sql5) or die("erreur lors de la mise à jours des absences");

 	//mise a jour table seance du cours

	$sql6="update $tbl_seance set code_cours='$code' where code_cours='$ex_code' limit 1";
	@mysql_query($sql6) or die("erreur lors de la mise à jours des seances");

 	//mise a jour table descriptif

	$sql7="update $tbl_descriptif set code_cours='$code' where code_cours='$ex_code' limit 1";
	@mysql_query($sql7) or die("erreur lors de la mise à jours des descriptif");

 	//mise a jour table syllabus

	$sql8="update $tbl_syllabus set code_cours='$code' where code_cours='$ex_code' limit 1";
	@mysql_query($sql8) or die("erreur lors de la mise à jours des syllabus");
    
	//mise a jour table cours inscription

	$sql9="update $tbl_cours_inscription set code_cours='$code' where code_cours='$ex_code' limit 1";
	@mysql_query($sql9) or die("erreur lors de la mise à jours des cours inscription");

                           }

						   else{

			$sql="update $tbl_cours set `titre` = '$libele',`titre_eng` = '$titre_eng',
							`nbr_credit` = '$nbr_credit',`session` = '$session',
							`semestre` = '$semestre',`type` = '$type'
							 where code_cours='$code' limit 1";
			@mysql_query($sql)or die ("erreur lors de la mise a jour du cours");

								}

 			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_cours.php');
			//-->
			</script>
              <?php
			  }
			  else{
			  $id=str_replace('-and-',"&",$_GET["modifier"]);
			  $sql2="select * from $tbl_cours where code_cours='$id' limit 1";
			  $req2=@mysql_query($sql2) or die("erreur dans la selection du cours");
			  $row=mysql_fetch_assoc($req2);
			  $ex_libele=stripslashes(trim($row['titre']));
			  $ex_titre_eng=stripslashes(trim($row['titre_eng']));
			  $ex_code=trim($row['code_cours']);
			  $ex_session=$row['session'];
			  $ex_se=$row['semestre'];
			  $ex_nbr_credit=$row['nbr_credit'];
              $ex_type=$row['type'];
			  

					  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/cours.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES COURS <span class="task">[modifier]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:validate();"><div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_cours.php"><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>

 <form method="post" action="gestion_cours.php?modifier=oui" name="f_ajout" >
 <input type="hidden" value="<?=$id?>" name="id" />
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="5"></td>
	   </tr>
	   
       <tr>
         <td valign="top" width="100%">
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		   <tr>
		  	  <td colspan="4" height="3px"><div id="er_code" class="erreur"></div></td>
		  </tr>
		  
		  <tr>
			  <td width="25%" class="gras"><label for="code">Code cours  :</label> </td>
			  <td width="30%">
				<input type="text" name="code" style="width:100px" id="code" class="input" value="<?=$id?>" onkeyup="verify()" />
			  </td>
			  <td width="25%"></td>
			  <td width="25%"></td>
		  </tr>
		  
		  <tr>
		  	  <td colspan="4" height="3px"><div id="er_libele" class="erreur"></div></td>
		  </tr>
		  
		  <tr>
			   <td class="gras"><label for="libele">Titre en Fran&ccedil;ais :</label> </td>
			   <td>
				 <input type="text" name="libele" id="libele" style="width:550px" class="input" value="<?=$ex_libele?>"/>
			   </td>
			   <td>&nbsp;</td>
			   <td>&nbsp;</td>
		   </tr>
		   
		  <tr>
		  	   <td colspan="4" height="3px"><div id="er_titre_en" class="erreur"></div></td>
		  </tr>
		  
		   <tr>
			   <td class="gras"><label for="titre_en">Titre en Englais :</label></td>
			   <td><input type="text" name="titre_eng" id="titre_en" class="input"  style="width:550px" value="<?=$ex_titre_eng?>" /></td>
			   <td>&nbsp;</td>
			   <td>&nbsp;</td>
		  </tr>
		  
	     <tr>
		 	   <td colspan="4" height="3px"></td>
		 </tr>

	     <tr>

			  <td class="gras"><label for="nbr_credit">Nombre de cr&eacute;dit :</label> </td>
			  <td>
				<input type="text" name="nbr_credit" id="nbr_credit" class="input"  style="width:100px" value="<?=$ex_nbr_credit?>" /></td>
			  <td></td>
			  <td></td>
	    </tr>

	    <tr>
		     <td colspan="4" height="3px"></td>
	    </tr>
	 
	    <tr>
		     <td class="gras"><label for="session">Session : </label></td>
		     <td>
			   <select name="session" id="session" class="input">
				   <option value="automne" <?=($ex_session=='automne') ? $selected : '' ?>>automne</option>
				   <option value="printemps" <?=($ex_session=='printemps') ? $selected : '' ?>>printemps</option>
			   </select>
		     </td>
		     <td></td>
		     <td></td>
        </tr>

		<tr>
			<td colspan="4" height="3px"></td></tr>
	 <tr>
		   <td class="gras"><label for="semestre">Semestre :</label> </td>
		   <td>
			 <select name="semestre" id="semestre" class="input">
				<option value="1" <?=($ex_se==1) ? $selected : ''?>>Premi&egrave;r semestre</option>
				<option value="2" <?=($ex_se==2) ? $selected : ''?>>Deuxi&egrave;me semestre</option>
				<option value="3" <?=($ex_se==3) ? $selected : ''?>>Troisi&egrave;me semestre</option>
				<option value="4" <?=($ex_se==4) ? $selected : ''?>>Quatri&egrave;me semestre</option>
			    <option value="5" <?=($ex_se==5) ? $selected : ''?>>Cinqui&egrave;me semestre</option>
				<option value="6" <?=($ex_se==6) ? $selected : ''?>>Sixi&egrave;me semestre</option>
				<option value="summer1" <?=($ex_se==summer1) ? $selected : ''?>>Summer 1</option>
				<option value="summer2" <?=($ex_se==summer2) ? $selected : ''?>>Summer 2</option>
				<option value="summer3" <?=($ex_se==summer3) ? $selected : ''?>>Summer 3</option>
			    </select>
			 </td>
		   <td></td>
		   <td></td>
    </tr>

	<tr>
			<td colspan="4" height="3px"></td>
	</tr>
    
	<tr>
		  <td class="gras"><label for="type">Type : </label></td>
		   <td>
		   <?php
		   $checked= "checked=\"checked\"";
		   $check1=$check2=$check3='';
		   if( ($ex_type=='master') or ($ex_type=='bachelor/master') ){
		   		 $check1=$checked;
				 								 					  }
		   if( ($ex_type=='bachelor') or ($ex_type=='bachelor/master') ){
		   		 $check2=$checked;
				 														     }
		   if( $ex_type=='MBA'){
		   		 $check3=$checked;
				 														     }
		   ?>
             Bachelor <input type="checkbox" name="type" value="bachelor" <?=$check2?> />
		     &nbsp;&nbsp;Master<input type="checkbox" name="type1" value="master" <?=$check1?> />
			
			 </td>
		   <td></td>
		   <td></td>
		  </tr>
	  </table>
	  			</td>
	  		</tr>
	  	</table>
</form>
<?php
}
?>