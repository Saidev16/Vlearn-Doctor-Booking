<style type="text/css">
input{width:200px;}
</style>
<?php


if (isset($_POST['ci'])){
$ci=htmlentities($_POST['ci']);
$code_inscription = $_SESSION['num_inscription'] = $_POST['ci'];
 $prefixe = $_POST['prefixe'];
$comments=addslashes(trim($_POST['comments']));
$advising=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];


  
                    // ça sera exécuté en cas l'utilisateur change le code d'inscription           
                    if($code_inscription!=$ci){

 
					// update table etudiant

                     $sql="UPDATE tbl_etudiant_all SET 
 						`comments` = '$comments',						
						`advising` = '$advising'						
						
						 WHERE `code_inscription` ='$code_inscription' and prefixe='$prefixe' limit 1 ";

             @mysql_query($sql) or die ("erreur lors de la mise à jour dans la table etudiant");
         
			
											?>

			<script type="text/javascript" language="JavaScript1.2">
			<!--
				window.location.replace('gestion_des_etudiants_all.php');
			//-->
			</script>
				
              <?php
                                                          }
                                         else{

                     $sql2="UPDATE tbl_etudiant_all SET 
 						`comments` = '$comments',						
						`advising` = '$advising'						
						
						 WHERE `code_inscription` ='$code_inscription' and prefixe='$prefixe' limit 1 ";
//die($sql);
         @mysql_query($sql2)or die ("erreur lors de la mise à jour de cet étudiant");


         }
               if( (!isset($_SESSION['tri_par_code'])) && (!isset($_SESSION['niveau'])) 
			   && (!isset($_SESSION['filiere'])) && (!isset($_SESSION['annee'])) ){

                          $_SESSION['search']=$nom;

                      }

			?>

			<script type="text/javascript" language="JavaScript1.2">
			<!--
				   window.location.replace('gestion_des_etudiants_all.php');
			//-->
			</script>

              <?php

			  }

			  else{

			  $code_inscription = $_GET["modifier"];
			   $prefixe = $_GET["foupasf"];
			  $sql2="select * from tbl_etudiant_all  
			  where code_inscription='$code_inscription' and prefixe='$prefixe' limit 1 ";
			  $req2=@mysql_query($sql2) or die("erreur lors du chargements  des données");
			  $row=mysql_fetch_assoc($req2);
			  
			   $code_inscription = $row['code_inscription'];
			   $prefixe = $row['prefixe'];
			   $nom = htmlentities($row['nom']);
			   $prenom = htmlentities($row['prenom']);
			   $comments = $row['comments'];
 			   
			  
			   $yi = substr($row['advising'], 0,4);
		       $mi = substr($row['advising'], 5,2);
		       $di = substr($row['advising'], 8,2);

			 			 
			  ?>
 <style type="text/css">
input{
width:230px;
}
</style>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/etudiants.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;Advising / Resolutions
	<span class="task">[EDIT]</span></td>
	<td width="22%">
	  <table border="0" align="right" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:validate();"> <div class="save"></div>Submit</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_des_etudiants_all.php" ><div class="cancel"></div>Cancel</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>

 <form method="post" action="gestion_des_etudiants_all.php?modifier=Yes" name="f_ajout" >
 <input type="hidden" value="<?=$code_inscription?>" name="id" id="id" />
  <input type="hidden" name="prefixe" value="<?php echo $prefixe ; ?>" />
	 <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
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
		    		 <td width="25%"><span class="gras"><label for="ci">Registration Code :</label> </td>
			  <td width="25%">
				<input type="text" name="ci" id="ci" class="input" value="<?=$code_inscription?>"  onchange="onUpdateVerify()" onkeyup="onUpdateVerify()" />
			  </td>
	<!--	<td><span class="gras">Registration Code</span> :&nbsp;<?=$row['code_inscription']?></td>
		<td><span class="gras"></span>&nbsp;</td>-->
    </tr>
    <tr>
                          <td colspan="4" height="3px"></td>
                        </tr>
   <tr>
   <td ><span class="gras">First Name </span> :&nbsp;<?=$row['prenom']?></td>
       <td><span class="gras">Last Name</span> :&nbsp;<?=$row['nom']?></td>
       
  </tr>
		 <tr>
                          <td colspan="4" height="3px"></td>
                        </tr>
		  <tr>
		 
			   <td><span class="gras"><label for="year_i">Date :</label></td>
		   <td>
		   <select name="month_i" class="input">
		   	 <option value="00" <?=($mi==0) ? $selected : '' ?>>00</option>
					  <option value="01" <?=($mi==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=($mi==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=($mi==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=($mi==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=($mi==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=($mi==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=($mi==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=($mi==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=($mi==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=($mi==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=($mi==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=($mi==12) ? $selected : '' ?>>12</option>
				  </select>
			  &nbsp;
				  <select name="day_i" class="input">
				  	 <option value="00" <?=($di==0) ? $selected : '' ?>>00</option>
					  <option value="01" <?=($di==1) ? $selected : '' ?>>01</option>
					  <option value="02" <?=($di==2) ? $selected : '' ?>>02</option>
					  <option value="03" <?=($di==3) ? $selected : '' ?>>03</option>
					  <option value="04" <?=($di==4) ? $selected : '' ?>>04</option>
					  <option value="05" <?=($di==5) ? $selected : '' ?>>05</option>
					  <option value="06" <?=($di==6) ? $selected : '' ?>>06</option>
					  <option value="07" <?=($di==7) ? $selected : '' ?>>07</option>
					  <option value="08" <?=($di==8) ? $selected : '' ?>>08</option>
					  <option value="09" <?=($di==9) ? $selected : '' ?>>09</option>
					  <option value="10" <?=($di==10) ? $selected : '' ?>>10</option>
					  <option value="11" <?=($di==11) ? $selected : '' ?>>11</option>
					  <option value="12" <?=($di==12) ? $selected : '' ?>>12</option>
					  <option value="13" <?=($di==13) ? $selected : '' ?>>13</option>
					  <option value="14" <?=($di==14) ? $selected : '' ?>>14</option>
					  <option value="15" <?=($di==15) ? $selected : '' ?>>15</option>
					  <option value="16" <?=($di==16) ? $selected : '' ?>>16</option>
					  <option value="17" <?=($di==17) ? $selected : '' ?>>17</option>
					  <option value="18" <?=($di==18) ? $selected : '' ?>>18</option>
					  <option value="19" <?=($di==19) ? $selected : '' ?>>19</option>
					  <option value="20" <?=($di==20) ? $selected : '' ?>>20</option>
					  <option value="21" <?=($di==21) ? $selected : '' ?>>21</option>
					  <option value="22" <?=($di==22) ? $selected : '' ?>>22</option>
					  <option value="23" <?=($di==23) ? $selected : '' ?>>23</option>
					  <option value="24" <?=($di==24) ? $selected : '' ?>>24</option>
					  <option value="25" <?=($di==25) ? $selected : '' ?>>25</option>
					  <option value="26" <?=($di==26) ? $selected : '' ?>>26</option>
					  <option value="27" <?=($di==27) ? $selected : '' ?>>27</option>
					  <option value="28" <?=($di==28) ? $selected : '' ?>>28</option>
					  <option value="29" <?=($di==29) ? $selected : '' ?>>29</option>
					  <option value="30" <?=($di==30) ? $selected : '' ?>>30</option>
					  <option value="31" <?=($di==31) ? $selected : '' ?> >31</option>
				</select>
					  &nbsp;
		   <select name="year_i" id="year_i" class="input">
		   	 <option value="0000" <?=($yi==0000) ? $selected : '' ?> >0000</option>
		  <?php for ($i=date('Y'); $i>2005; $i--){?>
		  <option value="<?=$i?>" <?=($yi==$i) ? $selected : '' ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select>
		  </td>	  
		  
		  </tr>
		  
		 <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
	
		   <td ><span class="gras"><label for="comments"> Comments:</label></td>
           <td colspan="1"><textarea cols="20" rows="20" name="comments" id="comments" style="width:170; height:20;"><?php echo $comments; ?></textarea></td>
		
		  </tr>
		         
		  </table>
	     </td>
		</tr>  
	  </table>
</form>
        <?php
         }
        ?>