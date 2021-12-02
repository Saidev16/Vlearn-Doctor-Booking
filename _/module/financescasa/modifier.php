<script language="javascript" type="text/javascript" src="../module/editeur/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,spellchecker,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,pagebreak,imagemanager,filemanager",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,spellchecker,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		content_css : "example_data/example_word.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		external_link_list_url : "example_data/example_link_list.js",
		external_image_list_url : "example_data/example_image_list.js",
		flash_external_list_url : "example_data/example_flash_list.js",
		template_external_list_url : "example_data/example_template_list.js",
		theme_advanced_resize_horizontal : false,
		theme_advanced_resizing : true,
		apply_source_formatting : true,
		spellchecker_languages : "+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,Portuguese=pt,Spanish=es,Swedish=sv"
	});

</script>

<?php

	if (isset($_POST['code_inscription'])){
	    
		
		$code_inscription= $_POST['code_inscription'] ;	
		
		$frais_inscription=(int)$_POST['frais_insc'];
		$frais_etude=(int)$_POST['frais_etude'];
		$Replacement= $_POST['Replacement'];
		$nbre=$_POST['nbre'];
		$change = $_POST['change'];
		$Returned = $_POST['Returned'];
		$Diploma =$_POST['Diploma'];
		$uspostal =$_POST['uspostal'];
		$fedex =$_POST['fedex'];
		$Reinstatement=$_POST['Reinstatement'];	

	 	 $sql="UPDATE tbl_finance_casa SET

		 frais_inscription = '$frais_inscription',
		 frais_etude= '$frais_etude',		
		 Replacement = '$Replacement',
		nbre = '$nbre',
		 Returned = '$Returned',
		 Diploma = '$Diploma',
		 uspostal = '$uspostal',
		 fedex = '$fedex',
		 Reinstatement = '$Reinstatement'
		WHERE code_inscription = '$code_inscription'";
		@mysql_query($sql);
		

		
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_finance_casa.php');
			//-->
			</script>
              <?php
						}
				  else{
				   $id=(int)$_GET['modifier'];  
				 // $annee=$_SESSION['paiement_annee'];
				   $sql="SELECT e.nom, e.prenom, f.* 
						 FROM tbl_etudiant_casa AS e, tbl_finance_casa AS f 
						 WHERE e.code_inscription = f.code_inscription and f.code_inscription=$id LIMIT 1";
				  $req=@mysql_query($sql) or die("erreur dans la s&eacute;lection de la ficheeeeeee");
				  $row=mysql_fetch_assoc($req);
				  $code_inscription = $row['code_inscription'];				 			
				  $frais_etude = $row['frais_etude'];
				  $frais_inscription=$row['frais_inscription'];	
				   $Replacement=$row['Replacement'];	
				    $change=$row['change'];	
				     $Returned=$row['Returned'];	
				      $Diploma=$row['Diploma'];	
				       $uspostal=$row['uspostal'];	
				        $fedex=$row['fedex'];
				        $nbre=$row['nbre'];	
				         $Reinstatement=$row['Reinstatement'];			  
				  $name = ucfirst($row['prenom']). '  '.ucfirst($row['nom']);
			  ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/cours.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Tuition and Fees<span class="task">[Edit]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="document.f_ajout.submit();"><div class="save"></div>Submit</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_finance_casa.php" ><div class="cancel"></div>Cancel</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
 <form method="post" action="gestion_finance_casa.php?modifier=oui" name="f_ajout"  >
 <input  type="hidden" name="code_inscription" id="code_inscription" value="<?=$code_inscription?>" />
	 <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="10"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
		 
	       <table border="0" cellpadding="0" cellspacing="5" width="100%" class="cellule_table"> 
		   	<tr>
			  <td width="20%" class="gras"><label for="name">Name: </label></td>
			  <td width="41%"><?=$name?></td> 
		    </tr>
           
           <tr>
               <td colspan="2" height="2"></td>
            </tr>
             <tr>
			   <td class="gras"><label for="frais_etude">Tuition Fees:</label> </td>
			   <td><input type="text" name="frais_etude" id="frais_etude" value="<?=$row['frais_etude']?>" class="input"/></td>
		  </tr>
		   <tr>
               <td colspan="2" height="2"></td>
            </tr>
			 <tr>
			   <td class="gras"><label for="frais_insc">Number of Courses :</label> </td>
			   <td><input type="text" name="frais_insc" id="frais_insc" value="<?=$row['frais_inscription']?>" class="input"/></td>
		  </tr>
		   <tr>
               <td colspan="2" height="2"></td>
            </tr>
		  		
		  		 <tr>
             <td height="40" class="gras"><label for="Reinstatement">Reinstatement : </label></td>
            <td>30$
              <input type="checkbox" name="Reinstatement"  value="30" <?php echo $Reinstatement==30 ? $checked : ''?> /></td>
		   	  </tr>
 <tr>
               <td colspan="2" height="2"></td>
            </tr>
		   	<!--   <tr>
             <td height="28" class="gras"><label for="change">Change-of-Program : </label></td>
            <td>30$
              <input type="checkbox" name="change"  value="30" <?php echo $change==30 ? $checked : ''?> /></td>
		   	  </tr>-->
		   <tr>
               <td colspan="2" height="2"></td>
            </tr>
		  <tr>
             <td height="28" class="gras"><label for="Returned">Returned Check : </label></td>
            <td>100$
              <input type="checkbox" name="Returned"  value="100" <?php echo $Returned==100 ? $checked : ''?> /></td>
		   	  </tr>
		   	   <tr>
               <td colspan="2" height="2"></td>
            </tr>
		   	   <tr>
			 <td class="gras"><label for="Replacement">Transcript: </label></td>
			   <td>
				<select name="Replacement" id="Replacement"   class="input" />
				<option value="" <?=($Replacement =='') ? $selected : '' ?>></option>
				<option value="10" <?=($Replacement ==10) ? $selected : '' ?>>Official:10$</option>
				<option value="5" <?=($Replacement ==5) ? $selected : '' ?>>Student Copy:5$</option>
			   </select>
					
				<select name="nbre" id="nbre"   class="input" />
				<option value="" <?=($nbre =='') ? $selected : '' ?>></option>
				<option value="1" <?=($nbre ==1) ? $selected : '' ?>>1</option>
				<option value="2" <?=($nbre ==2) ? $selected : '' ?>>2</option>
				<option value="3" <?=($nbre ==3) ? $selected : '' ?>>3</option>
				<option value="4" <?=($nbre ==4) ? $selected : '' ?>>4</option>
				<option value="5" <?=($nbre ==5) ? $selected : '' ?>>5</option>
				<option value="6" <?=($nbre ==6) ? $selected : '' ?>>6</option>
				<option value="7" <?=($nbre ==7) ? $selected : '' ?>>7</option>
				<option value="8" <?=($nbre ==8) ? $selected : '' ?>>8</option>
				<option value="9" <?=($nbre ==9) ? $selected : '' ?>>9</option>
			   </select>
					</td>   
			    </tr>

			     <tr>
               <td colspan="2" height="2"></td>
            </tr>
		   	   <tr>
             <td height="28" class="gras"><label for="Diploma">Diploma : </label></td>
            <td>100$
              <input type="checkbox" name="Diploma"  value="100" <?php echo $Diploma==100 ? $checked : ''?> /></td>
		   	  </tr>
 <tr>
               <td colspan="2" height="2"></td>
            </tr>

		   	   <tr>
			 <td class="gras"><label for="uspostal">Postal charges/US Postal Service: </label></td>
			   <td>
				<select name="uspostal" id="uspostal"   class="input" />
				<option value="" <?=($uspostal =='') ? $selected : '' ?>></option>
				<option value="25" <?=($uspostal ==25) ? $selected : '' ?>>US Domestic (6-10 days):$25</option>
				<option value="40" <?=($uspostal ==40) ? $selected : '' ?>>US Express (2-3 days):$40</option>
				<option value="120" <?=($uspostal ==120) ? $selected : '' ?>>International (5-20 days):$120</option>
			   </select>
					   
			    </tr>
			     <tr>
               <td colspan="2" height="2"></td>
            </tr>
			     <tr>
			 <td class="gras"><label for="fedex">Postal charges/Fedex Service- with Tracking: </label></td>
			   <td>
				<select name="fedex" id="fedex"   class="input" />
				<option value="" <?=($fedex =='') ? $selected : '' ?>></option>
				<option value="45" <?=($fedex ==45) ? $selected : '' ?>>Domestice ( 2 days):$45</option>
				<option value="200" <?=($fedex ==200) ? $selected : '' ?>>International (4-10 days):$200</option>
				
			   </select>
					   
			    </tr>
		  
	  </table>
	  			</td>
	  		</tr>
		</table>
        <input type="hidden" name="ex_frais_insc"  value="<?=$row['frais_inscription']?>" />
        <input type="hidden" name="ex_bourse" value="<?=$row['bourse']?>" />
</form>
<?php
}
?>