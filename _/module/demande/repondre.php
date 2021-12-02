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


<!-- /tinyMCE -->

<?php
			if ( (isset($_POST['response'])) && (!empty($_POST['response'])) ){
			$reponse=addslashes($_POST['response']);
			$id=$_POST['id'];
			
			//$date_reponse=date('Y-m-d').' '.date('H:m:s');
			$date_reponse=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];  
			$id_user = $_SESSION['admin_id_user'];
//	$a="SELECT description FROM `tbl_admin` WHERE `description`='admin' and id =$id_user";
			$reponse_auteur=$_POST['reponse_auteur'];
			if($reponse_auteur=='')
			{
$a="SELECT concat(nom, ' ' ,prenom) as name FROM `tbl_admin` WHERE id =$id_user";
		  $aa= @mysql_query($a) or die ('Failure to select branches');
  	$row = mysql_fetch_assoc($aa);
		  $auteur = $row['name'];
		}
		else { $auteur = $reponse_auteur;}

		


			 $sql="UPDATE $tbl_demande 
			 SET `reponse` = '$reponse',
			 `reponse_date_time` = '$date_reponse',
			`reponse_auteur` = '$auteur'
			 WHERE code_demande = $id LIMIT 1 ;"; 

           @mysql_query($sql)or die ("erreur lors de l'ajout de la réponse");

			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_demande.php');
			//-->
			</script>
              <?php

			  }

			  else{

			  $id=$_GET['repondre'];
			  $sql1="select * from $tbl_demande where code_demande=$id limit 1 ";
			  $req=mysql_query($sql1) or die ("erreur lors de la sélection du demande");
			  $row=mysql_fetch_assoc($req);
			  $objet=stripslashes($row['objet']);
			  $date=$row['date_requette'];
			    $nom_prenom=$row['nom_prenom'];
			   $reponse_auteur=$row['reponse_auteur'];
			  $explication=html_entity_decode(stripslashes($row['explication']));
			  $contenu=html_entity_decode(stripslashes($row['reponse']));

			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/classes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES REQUETES<span class="task">[Answer]</span>
	</td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:valid_form();"><div class="save"></div>Submit</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_demande.php"><div class="cancel"></div>Cancel</a>
		 </td>
	  </tr>
	</table>
	</td> 
  </tr>
</table>

 <form method="post"  action="gestion_demande.php?repondre=oui" name="f_ajout" >
 <input type="hidden" value="<?=$id?>" name="id" />
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
	   <tr>
	     <td height="5"></td>
	   </tr>

       <tr>
         <td valign="top" width="100%">
	       <table border="0" cellpadding="0" cellspacing="0" width="100%" 
		   style="padding-left:10px; font-family:verdana; font-size:11px">
		     <tr>

		  <td width="10%">Name : </td>
		  <td width="90%"><?=$nom_prenom?> </td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
	
		  <tr>

		  <td width="10%">Subject : </td>
		  <td width="90%"><?=$objet?> </td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		  <tr>
      <td > Date :</td>
              <td>
      
     <select name="month_i" class="input">
            <option value="01" <?=(date('m')==1) ? $selected : '' ?>>01</option>
            <option value="02" <?=(date('m')==2) ? $selected : '' ?>>02</option>
            <option value="03" <?=(date('m')==3) ? $selected : '' ?>>03</option>
            <option value="04" <?=(date('m')==4) ? $selected : '' ?>>04</option>
            <option value="05" <?=(date('m')==5) ? $selected : '' ?>>05</option>
            <option value="06" <?=(date('m')==6) ? $selected : '' ?>>06</option>
            <option value="07" <?=(date('m')==7) ? $selected : '' ?>>07</option>
            <option value="08" <?=(date('m')==8) ? $selected : '' ?>>08</option>
            <option value="09" <?=(date('m')==9) ? $selected : '' ?>>09</option>
            <option value="10" <?=(date('m')==10) ? $selected : '' ?>>10</option>
            <option value="11" <?=(date('m')==11) ? $selected : '' ?>>11</option>
            <option value="12" <?=(date('m')==12) ? $selected : '' ?>>12</option>
          </select>
        &nbsp;
          <select name="day_i" class="input">
            <option value="01" <?=(date('d')==1) ? $selected : '' ?>>01</option>
            <option value="02" <?=(date('d')==2) ? $selected : '' ?>>02</option>
            <option value="03" <?=(date('d')==3) ? $selected : '' ?>>03</option>
            <option value="04" <?=(date('d')==4) ? $selected : '' ?>>04</option>
            <option value="05" <?=(date('d')==5) ? $selected : '' ?>>05</option>
            <option value="06" <?=(date('d')==6) ? $selected : '' ?>>06</option>
            <option value="07" <?=(date('d')==7) ? $selected : '' ?>>07</option>
            <option value="08" <?=(date('d')==8) ? $selected : '' ?>>08</option>
            <option value="09" <?=(date('d')==9) ? $selected : '' ?>>09</option>
            <option value="10" <?=(date('d')==10) ? $selected : '' ?>>10</option>
            <option value="11" <?=(date('d')==11) ? $selected : '' ?>>11</option>
            <option value="12" <?=(date('d')==12) ? $selected : '' ?>>12</option>
            <option value="13" <?=(date('d')==13) ? $selected : '' ?>>13</option>
            <option value="14" <?=(date('d')==14) ? $selected : '' ?>>14</option>
            <option value="15" <?=(date('d')==15) ? $selected : '' ?>>15</option>
            <option value="16" <?=(date('d')==16) ? $selected : '' ?>>16</option>
            <option value="17" <?=(date('d')==17) ? $selected : '' ?>>17</option>
            <option value="18" <?=(date('d')==18) ? $selected : '' ?>>18</option>
            <option value="19" <?=(date('d')==19) ? $selected : '' ?>>19</option>
            <option value="20" <?=(date('d')==20) ? $selected : '' ?>>20</option>
            <option value="21" <?=(date('d')==21) ? $selected : '' ?>>21</option>
            <option value="22" <?=(date('d')==22) ? $selected : '' ?>>22</option>
            <option value="23" <?=(date('d')==23) ? $selected : '' ?>>23</option>
            <option value="24" <?=(date('d')==24) ? $selected : '' ?>>24</option>
            <option value="25" <?=(date('d')==25) ? $selected : '' ?>>25</option>
            <option value="26" <?=(date('d')==26) ? $selected : '' ?>>26</option>
            <option value="27" <?=(date('d')==27) ? $selected : '' ?>>27</option>
            <option value="28" <?=(date('d')==28) ? $selected : '' ?>>28</option>
            <option value="29" <?=(date('d')==29) ? $selected : '' ?>>29</option>
            <option value="30" <?=(date('d')==30) ? $selected : '' ?>>30</option>
            <option value="31" <?=(date('d')==31) ? $selected : '' ?> >31</option>
        </select> 
                &nbsp; <select name="year_i" id="year_i" class="input">
      <?php for ($i=date('Y')-5; $i<2025; $i++){?>
      <option value="<?=$i?>" <?=(date('m')==$i) ? $selected : '' ?>><?=$i?></option>
      <?php
      }
      ?>
      </select>
                      </td>
</tr>
		  <!-- <tr>
		  <td>Date : </td>
		  <td><?=$date?></td>
		  </tr>-->
		  <tr><td colspan="2" height="3px"></td>
		  </tr>
		   <td><label for="reponse_auteur">Administrator :</label> </td>
			  <td>
					 <select name="reponse_auteur" id="reponse_auteur" class="input" style="width:200px">
					 	<option value="" <?=$reponse_auteur=='' ? $selected : ''?>></option>
						<option value="Gagnon Chelsea" <?=$reponse_auteur=='Gagnon Chelsea' ? $selected : ''?>>Gagnon Chelsea</option>
						<option value="Otero L.Jose" <?=$reponse_auteur=='Otero L.Jose' ? $selected : ''?>>Otero L.Jose</option>
						<option value="Lahlou Anass" <?=$reponse_auteur=='Lahlou Anass' ? $selected : ''?>>Lahlou Anass</option>
						<option value="Hajar Ouhammou" <?=$reponse_auteur=='Hajar Ouhammou' ? $selected : ''?>>Hajar Ouhammou</option>

					</select>
			  </td>
			  </tr>
			   <tr><td colspan="2" height="3px"></td>
		  </tr>
		   <tr>
		  <td valign="top">Request : </td>
		  <td class="hack"><?=$explication?></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td>
		  </tr>
		   <tr>
		  <td valign="top">Resolution : </td>
		  <td>
		  <textarea cols="80" rows="15" name="response" id="response"><?=$contenu?></textarea>
		  </td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		  </table>
	     </td>
		</tr>  
	  </table>
</form>
	<?php
	}
	?>