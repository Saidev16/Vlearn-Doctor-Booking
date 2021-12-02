<script language="javascript1.2">

function valid_form(){

/*if($F('code_inscription')==''){
alert('Veuillez choisir un étudiant !!!');
$('code_inscription').focus();
return false;
}

if($F('idSession')==''){
alert('Veuillez choisir une session !!!');
$('idSession').focus();
return false;
}

else{*/
document.f_ajout.submit();
return true;
//}

}
</script>
<?php
		if (isset($_POST['code_inscription'])){
		
		$code_inscription = $_POST['code_inscription'];
		
	
  		$date = date('Y-m-d H:m:s');
		$idSession = $_POST['idSession'];
	
		
		 $a ="select code_cours,code_cours_testing from tbl_cours where diff =1";
			$aa = mysql_query($a)or die ('Erreur:: selectionCours');
			while ($ligne= mysql_fetch_assoc($aa))
			{
			$code_cours =$ligne['code_cours'];
			$code_cours_testing =$ligne['code_cours_testing'];
		    if ($code_cours != '' ) 
			{
		     
		
			// enregistrer inscription
			$sql = "INSERT INTO tbl_inscription_cours_GUES (`code_cours`, `code_inscription`, `date_inscription`, `idSession`,code_cours_testing
					)
			VALUES ('$code_cours', '$code_inscription', '$date', '$idSession','$code_cours_testing');";
        	
 	         @mysql_query($sql)or die (mysql_error());
			 		
			
				
				// creation de la fiche de notes
				$sql = "insert into tbl_note_GUES(code_inscription, code_cours,code_cours_testing, idSession, archive, section,letter_grade) 
				value('$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section','X')"; 
				@mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
				
				
			  
						}
		  
			  }
			
 			  ?>
			  <script type="text/javascript" language="JavaScript1.2">
			<!--	
 			window.location.replace('gestion_inscription_gues.php?code_inscription=<?=$code_inscription?>&idSession=<?=$idSession?>');
			//-->
			</script>
			  <?php
 			  }
 			  else{
 			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/classes.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES INSCRIPTIONS <span class="task">[add]</span> </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:return valid_form();"> <div class="save"></div>Add</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_inscription_gues.php" ><div class="cancel"></div>Cancel</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>

 </table>

 <form method="post" action="gestion_inscription_gues.php?full_add=oui" name="f_ajout">

	  	       <table border="0" cellpadding="0" cellspacing="2" width="100%" 
			   style="margin-left:10px" class="cellule_table">
 			 
			 <tr><td colspan="4" height="3px"></td></tr>
          <tr>
   
     
 		 </tr>
 		  <tr><td colspan="4" height="3px"></td></tr>
          <tr>

		  <td width="25%"><label for="code_inscription">Etudiant :</label> </td>

		  <td width="25%">
		  <select name="code_inscription" id="code_inscription" class="input">
				<option value="">Select</option>
		  <?php 
		   $sql6="select code_inscription, nom, prenom from tbl_etudiant_GUES where archive = 0 AND groupe not in (5,7) order by prenom, nom";
		  $req=@mysql_query($sql6);
		  while($row=mysql_fetch_assoc($req)){
		  $name=htmlentities($row['name']);
		  $code_inscription=$row['code_inscription'];

		  ?>
		  <option value="<?=$code_inscription?>"><?=ucfirst($row['prenom']).' '.ucfirst($row['nom'])?></option>
		  <?php
		  }
		  ?>
		  </select>
          
		  </td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		   <td><label for="idSession">Academic Year :</label> </td>

		   <td>
		<select name="idSession" id="idSession" class="input">
		<option value="">Select</option>
 		  <?php 
		  $sql7="select idSession, session, annee_academique,academic_year from $tbl_session  ";
		  $req=@mysql_query($sql7);
		  while($row=mysql_fetch_assoc($req)){
		  $ns=ucfirst($row['session']).' '.$row['annee_academique'];
		  $cs=$row['idSession'];
		  	$cc=$row['academic_year'];
		  ?>
		  <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
		  <?php
		  }
		  ?>
		  </select>
		  </td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
            <tr><td colspan="4" height="3px"></td></tr>
		 
	  </table>
     </form>
<?php
}
?>