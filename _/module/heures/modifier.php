<?php
$id = (int)$_GET['modifier'];

			  $sql= "select code_prof from tbl_heure where id ='$id' ";
			  $req=mysql_query($sql);
			  $row=mysql_fetch_assoc($req);
                           
                          $code_prof=$row['code_prof'];
 

if (isset($_POST['id'])){
$date=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
$nombre=addslashes($_POST['nombre']);
$prix= $_POST['select_prix']!= 0 ? $_POST['select_prix'] : $_POST['prix'] ;
$etat= $_POST['etat'];
$somme=$prix * $nombre;
$commentaire=addslashes($_POST['commentaire']);
$code_prof=$_POST['code_prof'];
$id=$_POST['id'];

		$sql="update  tbl_heure 
 
		set  
		`date` = '$date' ,
		`nombre` = '$nombre' ,
		`prix` ='$prix' ,
		`somme` ='$somme' ,
 		`etat` = '$etat',
		`commentaire` ='$commentaire'
		  WHERE id = '$id' ";  

      // Interface PHP pour mail()

       @mysql_query($sql)or die ("error update hour");
	   
	    
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_heures.php?code_prof=<?php echo $code_prof; ?>');
			//-->
			</script>
              <?php
			  }
			  else{
			  $id= $_GET['modifier'];
			  $sql= "select * from tbl_heure where id =$id ";
			  $req=mysql_query($sql);
			  $row=mysql_fetch_assoc($req);
                          $date =$row['date'];
                          $year= substr($date,0, 4);
                          $month= substr($date,6, 2);
                          $day= substr($date,8, 2);
                          $code_prof=$row['code_prof'];
						  $prix=$row['prix'];
						  $etat=$row['etat'];
						  $commentaire = $row['commentaire'];
			  ?>

<table border="0" width="100%" align="center" class="haut_table">
  <tr>
    	<td>
			<img src="images/icone/etudiants.gif" border="0"/>
		</td>
    	<td width="78%" class="titre">
			&nbsp;GESTION DES HEURES<span class="task">&nbsp;[modifier]</span> 
	    </td>
		<td width="22%">
	 		 <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:document.f_ajout.submit()"><div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_heures.php?code_prof=<?php echo $code_prof; ?>"><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
		</td> 
  </tr>
 </table>

 <form method="post" action="gestion_heures.php?modifier=oui" name="f_ajout" >
 <input type="hidden" name="id" value="<?php echo $id ; ?>" />
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%" >
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
          <tr>
		  <td width="15%">Date : </td>
		  <td width="30%"><select name="year_i" id="year_i" class="input">
		  <?php for ($i=date('Y'); $i>2006; $i--){?>
		  <option value="<?=$i?>" <? echo $year==$i ? $selected : ''; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>
		  &nbsp;<select name="month_i" class="input">
					  <option value="01" <?=($month==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=($month==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=($month==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=($month==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=($month==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=($month==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=($month==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=($month==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=($month==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=($month==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=($month==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=($month==12) ? $selected : '' ?>>12</option>
				  </select>
			  &nbsp;
				  <select name="day_i" class="input">
					  <option value="01" <?=($day==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=($day==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=($day==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=($day==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=($day==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=($day==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=($day==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=($day==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=($day==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=($day==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=($day==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=($day==12) ? $selected : '' ?>>12</option>
					  <option value="13" <?=($day==13) ? $selected : '' ?>>13</option>
					  <option value="14" <?=($day==14) ? $selected : '' ?>>14</option>
					  <option value="15" <?=($day==15) ? $selected : '' ?>>15</option>
					  <option value="16" <?=($day==16) ? $selected : '' ?>>16</option>
					  <option value="17" <?=($day==17) ? $selected : '' ?>>17</option>
					  <option value="18" <?=($day==18) ? $selected : '' ?>>18</option>
					  <option value="19" <?=($day==19) ? $selected : '' ?>>19</option>
					  <option value="20" <?=($day==20) ? $selected : '' ?>>20</option>
					  <option value="21" <?=($day==21) ? $selected : '' ?>>21</option>
					  <option value="22" <?=($day==22) ? $selected : '' ?>>22</option>
					  <option value="23" <?=($day==23) ? $selected : '' ?>>23</option>
					  <option value="24" <?=($day==24) ? $selected : '' ?>>24</option>
					  <option value="25" <?=($day==25) ? $selected : '' ?>>25</option>
					  <option value="26" <?=($day==26) ? $selected : '' ?>>26</option>
					  <option value="27" <?=($day==27) ? $selected : '' ?>>27</option>
					  <option value="28" <?=($day==28) ? $selected : '' ?>>28</option>
					  <option value="29" <?=($day==29) ? $selected : '' ?>>29</option>
					  <option value="30" <?=($day==30) ? $selected : '' ?>>30</option>
					  <option value="31" <?=($day==31) ? $selected : '' ?> >31</option>
				</select></td>
		  <td width="55%"><div id="erreur" class="erreur"></div></td>
		  </tr>

		  <tr><td colspan="3" height="3px"></td></tr>
		   <tr>
		  <td>Nombre : </td>
		  <td><select name="nombre" class="input">					   
					  <option value="1" <?php echo $row['nombre']== 1 ? $selected : '';?>>1</option>
                                          <option value="2" <?php echo $row['nombre']== 2 ? $selected : '';?>>2</option>
                                          <option value="3" <?php echo $row['nombre']== 3 ? $selected : '';?>>3</option>
                                          <option value="4" <?php echo $row['nombre']== 4 ? $selected : '';?>>4</option>
				  </select> Heure(s)</td>
		   <td>&nbsp;</td>
		   </tr>

		  <tr><td colspan="3" height="3px"></td></tr>
		  
		   <tr>
		  <td>Prix par heure : </td>
		  <td colspan="2"><select name="select_prix" class="input">
					  <option value="00">Prix</option>
					  <option value="200" <?php echo $prix==200 ? $selected : '';?>>200</option>
                                          <option value="250" <?php echo $prix==250 ? $selected : '';?>>250</option>
                                          <option value="300" <?php echo $prix==300 ? $selected : '';?>>300</option>
                                          <option value="350" <?php echo $prix==350 ? $selected : '';?>>350</option>
                                          <option value="400" <?php echo $prix==400 ? $selected : '';?>>400</option>
                                          <option value="450" <?php echo $prix==450 ? $selected : '';?>>450</option>
                                          <option value="500" <?php echo $prix==500 ? $selected : '';?>>500</option>
                                          <option value="550" <?php echo $prix==550 ? $selected : '';?>>550</option>
                                          <option value="600" <?php echo $prix==600 ? $selected : '';?>>600</option>					   
				  </select>
                  <input type="text" name="prix" id="prix" class="input" value="<?php echo $prix?>" /></td></td>
		   </tr>
		   
		  <tr><td colspan="3" height="3px"></td></tr>
 			<tr>
  		  <td>Statut : </td>
		  <td>
             <select name="etat" id="etat" class="search" >
          		<option value="1" <?php echo etat==1 ? $selected : ''?>>R&eacute;gl&eacute;</option>
                <option value="0" <?php echo etat==0 ? $selected : ''?>>non r&eacute;gl&eacute; </option>
              </select>
          </td>
		   <td></td>
		   </tr>

		  <tr><td colspan="3" height="3px"></td></tr>

		   <tr>
		  <td>Commentaire : </td>
		  <td><input type="text" name="commentaire" id="commentaire" class="input input_size" value="<?php echo $commentaire;?>" /></td>
		   <td>&nbsp;</td>
		   </tr>
	  </table>

     </form>

<?php

}
 
?>