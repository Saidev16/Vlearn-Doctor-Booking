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

$date=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
$titre=addslashes(trim($_POST['titre']));
$contenu=addslashes(trim($_POST['contenu']));
$id=(int)$_POST['id'];
$type=$_POST['type'];

$sql_act="UPDATE `tbl_actualite` SET `titre` = '$titre',
`contenu` = '$contenu',
`date` = '$date',
`type` = '$type'
 WHERE `id_actualite` =$id";
 
 @mysql_query($sql_act)or die ("erreur lors de la modification de l'actualité ".$sql_act);

			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_actualite.php');
			//-->
			</script>
              <?php

			  }

			  else{

			  $id=(int)$_GET["modifier"];

			  $sql2="select * from $tbl_actualite where id_actualite=$id";

			  $req2=@mysql_query($sql2) or die("erreur dans la selection de l'actualité");
			  $row=mysql_fetch_assoc($req2);
			  $ia=$row['id_actualite'];
			  $type=$row['type'];
			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>
    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION D'ACTUALITE <span class="task">[modifier]</span></td> 
	  <td width="22%">
	    <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:valid_form();"><div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_actualite.php"><div class="cancel"></div>Annuler</a>
		  </td>
	   </tr>
	  </table>	
	  </td> 
  </tr>
 </table> 
 <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
 <form method="post"  action="gestion_actualite.php?modifier=oui" name="f_ajout" >
 <input type="hidden" name="id" value="<?=$ia?>" />
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="600">
	       <table border="0" cellpadding="0" cellspacing="0" width="70%" 
		   style="padding-left:10px; font-family:verdana; font-size:11px">
		  <tr>
		  <td>Type : </td>
		  <td>
		  <select name="type" class="input">
		  <option value="tous" <?=($type=='tous') ? $selected : '' ; ?>>tous</option>
		  <option value="etudiant" <?=($type=='etudiant') ? $selected : ''?>>etudiant</option>
		  <option value="professeur" <?=($type=='professeur') ? $selected : ''?>>professeur</option>
		  </select>
		  </td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td>
		  </tr>
		  <tr>
		  <td>Date : </td>
		  <td>
		   <select name="year_i" class="input">
		  <option value="<?=date('Y')?>"><?=date('Y')?></option>
		  </select>
		 <select name="month_i" class="input">
		  <?php for ($i=1; $i<13; $i++){
		  ?>
		  <option  value="<?=$i?>" <?=($i==date('m')) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		 </select>
		 <select name="day_i" class="input">
		  <?php for ($i=1; $i<32; $i++){
		  ?>
		  <option value="<?=$i?>" <?=($i==date('d')) ? $selected : '' ?> ><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>		 
		   </td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		   <tr>
		  <td>Titre : </td>
		  <td><input type="text" name="titre" id="titre" 
		  value="<?=htmlspecialchars(stripslashes($row['titre'])); ?>" class="input" style="width:420px"/></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td>
		  </tr>
		   <tr>
		  <td valign="top">Contenu : </td>
		  <td>
		  <textarea cols="90" rows="20" name="contenu" id="contenu">
		  <?=html_entity_decode(stripslashes($row['contenu'])); ?>
		  </textarea>
		  </td>
		   </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		  </table> 
		  </form>
	     </td>
		</tr>  
		 </table>
			<?php
			}
			?>