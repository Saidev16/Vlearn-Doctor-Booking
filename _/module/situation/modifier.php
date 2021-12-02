<style type="text/css">
input{
width:200px;
}
</style>
<script language="javascript1.2">
function valid_form(){
if ($F('replicat').match(/^[-]?\d*\.?\d*$/) == null){
alert('replicat doit être enchiffre');
$('replicat').focus();
return false;
}
if ($F('espece').match(/^[-]?\d*\.?\d*$/) == null){
alert('espece doit être enchiffre');
$('espece').focus();
return false;
}
if ($F('cheque').match(/^[-]?\d*\.?\d*$/) == null){
alert('cheque doit être enchiffre');
$('cheque').focus();
return false;
}
if ($F('reste').match(/^[-]?\d*\.?\d*$/) == null){
alert('le reste doit être enchiffre');
$('reste').focus();
return false;
}
else {
document.f_ajout.submit();
return true;
}
}
</script>
<?php
if (isset($_POST['replicat'])){
$replicat=$_POST['replicat'];
$frais_etude_dossier=addslashes($_POST['frais_etude_dossier']);
$date_f_e_d=$_POST['year_f'].'-'.$_POST['month_f'].'-'.$_POST['day_f'];
$frais_inscription=addslashes($_POST['frais_inscription']);
$date_i=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
$cheque=addslashes($_POST['cheque']);
$date_cheque=$_POST['year_c'].'-'.$_POST['month_c'].'-'.$_POST['day_c'];
$espece=addslashes($_POST['espece']);
$date_espece=$_POST['year_e'].'-'.$_POST['month_e'].'-'.$_POST['day_e'];
$reste=addslashes($_POST['reste']);
$id=$_POST['id'];

											$sql="UPDATE $tbl_situation_financiere SET `replicat` = '$replicat',
`frais_etude_dossier` = '$frais_etude_dossier',
`f_date` = '$date_f_e_d',
`frais_inscription` = '$frais_inscription',
f_i_date='$date_i',
`cheque` = '$cheque',
`cheque_date` = '$date_cheque',
`espece` = '$espece',
`espece_date` = '$date_espece',
`reste` = '$reste' WHERE code_inscription ='$id' ";

                                            @mysql_query($sql)or die ("erreur lors de la modification du situation financiere ");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_situation.php');
			//-->
			</script>
              <?php
			  }
			  else{
			    $id=$_GET["modifier"];
			  $sql2="select s.*, e.nom, e.prenom from $tbl_situation_financiere as s, $tbl_etudiant as e where s.code_inscription=e.code_inscription and s.code_inscription='$id' limit 1";
			  $req2=@mysql_query($sql2) or die($sql2);
			  $row=mysql_fetch_assoc($req2);
			  ?>
			   

<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES SITUATIONS FINANCIERES <span style="font-size:12px">[modifier]</span> </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" >
	    <tr>
		 
		  <td valign="top" align="center">
		   <a href="#" 
		   onclick="javascript:valid_form();" id="lien_msj">
		   <div style="background:top url(images/save.png); width:32; height:34;"></div>
		   Valider</a>		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_situation.php" id="lien_msj" >
		  <div style="background:top url(images/annule.png); width:32; height:34;"></div>
		  Annuler</a>		  </td>
		</tr>
	  </table>	</td> 
  </tr>
 </table>
 <form method="post" ENCTYPE="multipart/form-data" action="gestion_situation.php?modifier=oui" name="f_ajout"  >
 <input type="hidden" name="id" value="<?=$row['code_inscription']?>" />
	  <table border="0" width="1000" cellpadding="0" cellspacing="0" align="center">
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="600">
	       <table border="0" cellpadding="0" cellspacing="0" width="70%" style="margin-left:10px; font-size:11px">
		  <tr>
		  <td>Nom : </td>
		  <td>
		 <input type="text" readonly="yes" name="nom" id="nom" value="<?=htmlspecialchars($row['nom']); ?>&nbsp;<?=htmlspecialchars($row['prenom']); ?>" />
		  </td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		   <tr>
		  <td>Replicat : </td>
		  <td><input type="text" name="replicat" id="replicat" value="<?=htmlspecialchars($row['replicat']); ?>" /></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td>
		  </tr>
		  <td valign="top">Frais d'etude de dossier : </td>
		  <td>
<input type="text" name="frais_etude_dossier" id="frais_etude_dossier" value="<?=htmlspecialchars($row['frais_etude_dossier']); ?>" /></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr> 
		    <tr>
		  <td valign="top">Date : </td>
		  <td><?php 
		  $y=substr($row['f_date'], 0,4);
		  $m=substr($row['f_date'], 5,2);
		  $d=substr($row['f_date'], 8,2);
		  ?>
		 <select name="year_f" class="input">
		  <option value=" <?=date('Y')?>" selected="selected"><?=date('Y')?></option>
		  &nbsp;</select>
		  &nbsp;<select name="month_f" class="input">
		  <?php for ($i=1; $i<13; $i++){
		  ?>
		  <option value="<?=$i?>" <?php if ($m==$i) echo "selected=\"selected\""; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		 </select>
		  &nbsp;<select name="day_f" class="input">
		  <?php for ($i=1; $i<32; $i++){
		  ?>
		  <option value="<?=$i?>" <?php if ($d==$i) echo "selected=\"selected\""; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr> 
		    <tr>
		  <td valign="top">Frais d'inscription : </td>
		  <td><input type="text" name="frais_inscription" id="frais_inscription" value="<?=htmlspecialchars($row['frais_inscription']); ?>" /></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>   
		  <tr>
		  <td valign="top">Date : </td>
		  <td><?php 
		  $y=substr($row['f_i_date'], 0,4);
		  $m=substr($row['f_i_date'], 5,2);
		  $d=substr($row['f_i_date'], 8,2);
		  ?>
		  <select name="year_i" class="input">
		  <option value=" <?=date('Y')?>" selected="selected"><?=date('Y')?></option>
		  &nbsp;</select>
		  &nbsp;<select name="month_i" class="input">
		  <?php for ($i=1; $i<13; $i++){
		  ?>
		  <option value="<?=$i?>" <?php if ($m==$i) echo "selected=\"selected\""; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		 </select>
		  &nbsp;<select name="day_i" class="input">
		  <?php for ($i=1; $i<32; $i++){
		  ?>
		  <option value="<?=$i?>" <?php if ($d==$i) echo "selected=\"selected\""; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		  <tr>
		  <td valign="top">Chèque : </td>
		  <td><input type="text" name="cheque" id="cheque" value="<?=htmlspecialchars($row['cheque']); ?>" /></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		  <tr>
		  <td valign="top">Date : </td>
		  <td><?php 
		  $y=substr($row['cheque_date'], 0,4);
		  $m=substr($row['cheque_date'], 5,2);
		  $d=substr($row['cheque_date'], 8,2);
		  ?>
		  <select name="year_c" class="input">
		  <option value=" <?=date('Y')?>" selected="selected"><?=date('Y')?></option>
		  &nbsp;</select>
		  &nbsp;<select name="month_c" class="input">
		  <?php for ($i=1; $i<13; $i++){
		  ?>
		  <option value="<?=$i?>" <?php if ($m==$i) echo "selected=\"selected\""; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		 </select>
		  &nbsp;<select name="day_c" class="input">
		  <?php for ($i=1; $i<32; $i++){
		  ?>
		  <option value="<?=$i?>" <?php if ($d==$i) echo "selected=\"selected\""; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		  <tr>
		  <td valign="top">Espèce : </td>
		  <td><input type="text" name="espece" id="espece" value="<?=htmlspecialchars($row['espece']); ?>" /></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		  <tr>
		  <td valign="top">Date : </td>
		  <td><?php 
		  $y=substr($row['espece_date'], 0,4);
		  $m=substr($row['espece_date'], 5,2);
		  $d=substr($row['espece_date'], 8,2);
		  ?>
		  <select name="year_e" class="input">
		  <option value=" <?=date('Y')?>" selected="selected"><?=date('Y')?></option>
		  &nbsp;</select>
		  &nbsp;<select name="month_e" class="input">
		  <?php for ($i=1; $i<13; $i++){
		  ?>
		  <option value="<?=$i?>" <?php if ($m==$i) echo "selected=\"selected\""; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		 </select>
		  &nbsp;<select name="day_e" class="input">
		  <?php for ($i=1; $i<32; $i++){
		  ?>
		  <option value="<?=$i?>" <?php if ($d==$i) echo "selected=\"selected\""; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select></td>
		  </tr>
		  <tr><td colspan="2" height="3px"></td></tr>
		  <tr>
		  <td valign="top">Reste : </td>
		  <td><input type="text" name="reste" id="reste" value="<?=htmlspecialchars($row['reste']); ?>" /></td>
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