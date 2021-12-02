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
		spellchecker_languages : "+English=en,French=fr"
	});

</script>
<!-- /tinyMCE -->
<script language="javascript1.2">
function valid_form(){
if($F('titre')==''){
alert('veuillez saisir le titre ');
$('titre').focus();
return false;
}
else{
document.f_ajout.submit();
return true;
}

}
</script>

<?php

if (isset($_POST['titre'])){

$titre=addslashes($_POST['titre']);
$date=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
$description=addslashes($_POST['description']);



				$sql="INSERT INTO $tbl_offre_emploi( `title`, `created_on`, `body` )
                 VALUES ('$titre', '$date', '$description');";
 

                @mysql_query($sql)or die ("erreur lors de l'ajout d'une offre ");

			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

					window.location.replace('gestion_offre_emploi.php');

			//-->

			</script>

              <?php

			  }

			  else{

			  ?>


<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;Ajout  d' une offre d'emploi </td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		  <td valign="top" align="center">

		   <a href="#" 

		   onclick="javascript:valid_form();"><div class="ajouter"></div>Ajouter</a>
		  </td>

		  <td valign="top" align="center">

		   <a href="gestion_offre_emploi.php"><div class="cancel"></div>  Annuler</a>
		
		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

 </table>

 <form method="post"  action="gestion_offre_emploi.php?new=oui" name="f_ajout">
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">

		  

		  <tr>

    		  <td width="25%">Titre : </td>

    		  <td width="25%"><input type="text" name="titre" id="titre" style="width:600px" class="input" /></td>

    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          <tr>

              <td height="5px"></td>

          </tr>
           <tr>

    		  <td width="25%">Date : </td>

    		  <td width="25%"><select name="year_i" class="input">
		  	<option value="<?=date('Y')?>"><?=date('Y')?></option>
		  </select>
		 <select name="month_i" class="input">
		  <?php for ($i=1; $i<13; $i++){ ?>
		  <option value="<?=$i?>" <?=($i==date('m')) ? $selected : ''?>><?=$i?></option>
		  <?php
		  }
		  ?>
		 </select>
		  <select name="day_i" class="input">
		  <?php for ($i=1; $i<32; $i++){ ?>
		  <option value="<?=$i?>" <?=($i==date('d')) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select></td>

    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          
            <tr>

    		  <td width="25%" valign="top">Description : </td>

    		  <td width="25%"><textarea style="height:400px"  name="description" ></textarea></td>

    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          <tr>

              <td height="5px"></td>

          </tr>
	  </table>

	  

     </form>



<?php

}



?>