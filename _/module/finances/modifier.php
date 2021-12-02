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
		$remarque= $_POST['remarque'];
		$remarquegen= $_POST['remarquegen'];
		$divers= $_POST['divers'];
		$frais_ceremonie= $_POST['frais_ceremonie'];
		$bourse=(int)$_POST['bourse'];
		$frais_inscription=(int)$_POST['frais_insc'];
		$frais_etude=(int)$_POST['frais_etude'];
		
		$annee=$_SESSION['paiement_annee'];

		$sql="UPDATE tbl_finance SET bourse = '$bourse', 
		
		 remarque= '$remarque',
		  remarquegen= '$remarquegen',
		  frais_etude= '$frais_etude',
		 divers= '$divers',
		 frais_ceremonie= '$frais_ceremonie',
		frais_inscription = '$frais_inscription'
		WHERE code_inscription = '$code_inscription' AND annee = '$annee'";
		@mysql_query($sql);
		
		$sql="UPDATE tbl_finance_bak SET bourse = '$bourse', 
	
		 remarque= '$remarque',
		frais_inscription = '$frais_inscription'
		WHERE code_inscription = '$code_inscription' AND annee = '$annee'";
		@mysql_query($sql);
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_finance_burkina.php');
			//-->
			</script>
              <?php
						}
				  else{
				  $id=(int)$_GET['modifier'];  
				  $annee=$_SESSION['paiement_annee'];
				  $sql="SELECT e.nom, e.prenom, f.* 
						 FROM tbl_etudiant_all AS e, tbl_finance AS f 
						 WHERE e.code_inscription = f.code_inscription AND f.id = $id LIMIT 1";
				  $req=@mysql_query($sql) or die("erreur dans la s&eacute;lection de la fiche");
				  $row=mysql_fetch_assoc($req);
				  $code_inscription = $row['code_inscription'];
				  $remarque = $row['remarque'];
				  $remarquegen = $row['remarquegen'];
				  $frais_etude = $row['frais_etude'];
				  $bourse = $row['bourse'];
				  $divers= $row['divers'];
		$frais_ceremonie= $row['frais_ceremonie'];
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
		   <a href="gestion_finance.php" ><div class="cancel"></div>Cancel</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
 <form method="post" action="gestion_finance.php?modifier=oui" name="f_ajout"  >
 <input  type="hidden" name="code_inscription" id="code_inscription" value="<?=$code_inscription?>" />
	 <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
		 
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table"> 
		   	<tr>
			  <td width="8%" class="gras"><label for="name">Name: </label></td>
			  <td width="41%"><?=$name?></td> 
		    </tr>
            <!--<tr>
               <td colspan="2" height="2"></td>
            </tr>
			<tr>
               <td class="gras"><label for="idSession">Ann&eacute;e :</label> </td>
               <td><?php echo $row['annee'] ?> </td>
	       </tr>-->
           <tr>
               <td colspan="2" height="2"></td>
            </tr>
			 <tr>
			   <td class="gras"><label for="frais_insc">Registration Fees:</label> </td>
			   <td><input type="text" name="frais_insc" id="frais_insc" value="<?=$row['frais_inscription']?>" class="input"/></td>
		  </tr>
		  
		   <tr>
			   <td class="gras"><label for="frais_etude">Tuition Fees:</label> </td>
			   <td><input type="text" name="frais_etude" id="frais_etude" value="<?=$row['frais_etude']?>" class="input"/></td>
		  </tr>
		 <!-- <tr>
			   <td class="gras"><label for="divers"> Autres Frais:</label> </td>
			   <td><input type="text" name="divers" id="divers" value="<?=$row['divers']?>" class="input"/></td>
		  </tr>
		   <tr>
			   <td class="gras"><label for="frais_ceremonie">Frais de C&eacute;r&eacute;monie:</label> </td>
			   <td><input type="text" name="frais_ceremonie" id="frais_ceremonie" value="<?=$row['frais_ceremonie']?>" class="input"/></td>
		  </tr>-->
		  
		    <tr>
	  		  <td height="28" class="gras"><label for="bourse">Bourse : </label></td>
		        <td><input type="text" name="bourse" id="bourse" value="<?=$row['bourse']?>" class="input" /></td>
		   </tr>
		 <!--  <tr>
		    <td height="28" class="gras"><label for="remarque">Remarque(Autres Frais): </label></td>
		  <td width="40%" > <TEXTAREA cols="60" rows="3" name="remarque" ><?php echo $row['remarque'] ;?></TEXTAREA></td>
		   </tr>
		   
		   
		   <tr>
		  		
				
			 <td width="11%"   class="gras"><label for="remarquegen">Remarque: </label></td>
	    
		
	 <td width="40%" >	<TEXTAREA cols="60" rows="3" name="remarquegen" ><?php echo $row['remarquegen'] ;?></TEXTAREA></td>
		   </tr>
		  -->
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