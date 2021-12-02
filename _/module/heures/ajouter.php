<?php
$id = $_GET['new'];

if (isset($_POST['code_prof'])){
$date=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
$nombre=(int) $_POST['nombre'] ;
$prix=$_POST['select_prix']!= 0 ? $_POST['select_prix'] : $_POST['prix'] ;
$somme=$prix * $nombre;
$etat= $_POST['etat'];
$commentaire=addslashes($_POST['commentaire']);
$code_prof=$_POST['code_prof'];


		$sql="INSERT INTO  tbl_heure (`id` ,`code_prof` ,`date` ,`nombre` ,`prix` ,`somme` ,`etat` ,`commentaire` )
 			VALUES (NULL , '$code_prof', '$date', '$nombre', '$prix', '$somme', '$etat', '$commentaire');";  


 
      // Interface PHP pour mail()

       @mysql_query($sql)or die ("erreur lors de l'enregistrement  de cet enseignant");
	   
	    
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_heures.php?code_prof=<?php echo $code_prof; ?>');
			//-->
			</script>
              <?php
			  }
			  else{
			  $code_prof = $_GET['new'];
			  ?>

<table border="0" width="100%" align="center" class="haut_table">
  <tr>
    	<td>
			<img src="images/icone/etudiants.gif" border="0"/>
		</td>
    	<td width="78%" class="titre">
			&nbsp;GESTION DES HEURES<span class="task">[ajouter]</span> 
	    </td>
		<td width="22%">
	 		 <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:document.f_ajout.submit()"><div class="save"></div>Ajouter</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_heures.php?code_prof=<?php echo $id; ?>"><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
		</td> 
  </tr>
 </table>

 <form method="post" action="gestion_heures.php?new=oui" name="f_ajout" >
 	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		  <tr>
          <td width="15%">Professeur : </td>
		  <td width="30%"> 
		   <select name="code_prof" class="input">
					  <option value="0">S&eacute;l&eacute;ctionner un professeur</option>
					  <?php 
					  $sql="SELECT code_prof, nom_prenom FROM $tbl_professeur WHERE code_prof != 0 ";
					  $res= @mysql_query($sql) or die('ERROR select prof');
					  while($row = mysql_fetch_assoc($res)){
					  
					  ?>
                      <option value="<?php echo $row['code_prof'];?>" <?php echo $code_prof == $row['code_prof'] ? $selected : '';?>><?php echo $row['nom_prenom'];?></option>
                      <?php } ?>
 				  </select>
                  </td>
                  </tr>
		  <td width="15%">Date : </td>
		  <td width="30%"><select name="year_i" id="year_i" class="input">
		  <?php for ($i=date('Y'); $i>2006; $i--){?>
		  <option value="<?=$i?>" <?=(date('Y')==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>
		  &nbsp;<select name="month_i" class="input">
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
				</select></td>
		  <td width="55%"><div id="erreur" class="erreur"></div></td>
		  </tr>

		  <tr><td colspan="3" height="3px"></td></tr>
		   <tr>
		  <td>Nombre : </td>
		  <td><select name="nombre" class="input">					   
					  <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>                                           					   
				  </select> Heure(s)</td>
		   <td>&nbsp;</td>
		   </tr>

		  <tr><td colspan="3" height="3px"></td></tr>
		  
		   <tr>
		  <td>Prix par heure : </td>
		  <td colspan="2">
                  <select name="select_prix" class="input">
					  <option value="00">Prix</option>
					  <option value="200">200</option>
                                          <option value="250">250</option>
                                          <option value="300">300</option>
                                          <option value="350">350</option>
                                          <option value="400">400</option>
                                          <option value="450">450</option>
                                          <option value="500">500</option>
                                          <option value="550">550</option>
                                          <option value="600">600</option>					   
				  </select>
                  <input type="text" name="prix" id="prix" class="input" /></td>

		   </tr>
		  <tr><td colspan="3" height="3px"></td></tr>
 		   <tr>
		  <td>Statut : </td>
		  <td><select name="etat" id="etat" class="search">
          		<option value="1">R&eacute;gl&eacute;</option>
                <option value="0">non r&eacute;gl&eacute;</option>
                </select>
              </td>
		   <td>&nbsp;</td>
		   </tr>

		  <tr><td colspan="3" height="3px"></td></tr>

		   <tr>
		  <td>Commentaire : </td>
		  <td><input type="text" name="commentaire" id="commentaire" class="input input_size" /></td>
		   <td>&nbsp;</td>
		   </tr>
	  </table>

     </form>

<?php

}

?>