<?php
if (isset($_POST['nom'])){
$nationalite=addslashes($_POST['nationalite']);
$matiere=addslashes($_POST['matiere']);
$nom=addslashes($_POST['nom']);
$mail=$_POST['email'];
$mail1=addslashes($_POST['mail1']);
$contact=$_POST['contact'];
$ville=$_POST['ville'];
$niveau=addslashes($_POST['niveau']);
$type=$_POST['type'];
$login=$_POST['login'];
$pass=md5(htmlentities($_POST['pass']));
$send_pass=htmlentities($_POST['pass']);
$diplome=addslashes($_POST['diplome']);

		if (!empty($_POST['diplome1'])){
		$diplome = $diplome.';'.addslashes($_POST['diplome1']);
									   }
									   
			if(!empty($_POST['diplome2'])){
			   $diplome=$diplome.';'.addslashes($_POST['diplome2']);
			    						  }
										  
/*function sendMail($n,$m,$nT,$mT,$sujet,$body) {
	 
   // l'émetteur
   $tete = "From: ".$n." <".$m.">\n";
   $tete .= "Reply-To: ".$m."\n";
   // et zou... false si erreur d'émission
   return mail($nT." <".$mT.">",$sujet,$body,$tete);
   }*/


		
		$sql="INSERT INTO tbl_parents (`nom_prenom` , `nationnalite` ,
		`diplome` , `matiere` , `mail` ,  `mail1` , `contact` ,`ville` , `niveau` , `type`,`login` , `mot_pass` )
		 VALUES ( '$nom', '$nationalite', '$diplome','$matiere', '$mail', '$mail1', '$contact', '$ville', 
         '$niveau', '$type', '$login', '$pass')";  

      // Interface PHP pour mail()

       @mysql_query($sql)or die ("erreur lors de l'enregistrement  de cet enseignant");
		  
		  //$email=$mail.','.'zineb@aulm.us'.','.'o.hajar@aulm.us'; 
		    $email=$mail.','.'zineb@aulm.us'; 
		 
		 $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='<html><head><title></title></head><body><p align="left">Bienvenue '.$nom.' dans votre espace enseignant, veuillez 

utiliser ce système <a href="http://piimt.us/piimt/">www.piimt.us/piimt</a> <p align="left"> Votre 

username est:'.$login.' </p><p align="left"> Votre password est:'.$send_pass.'</p> </body></html>';


 mail($email, 'HIS Parents Access',$message,$headers);

      // Interface PHP pour mail()
//$email=$mail.','.'zineb.zagdouni@piimt.us'.','.'b.otmane@piimt.us'.','.'zagdouni.z@gmail.com';
//$email=$mail;
      
	/*   $sujet= 'Votre login et mot de passe';
	  
	   $body='votre login est : '.$login.' et votre mot de passe est :'.$send_pass;*/
	  
	  // sendMail('PIIMT SYSTEM ADMIN',$email,$nom,$email,$sujet,$body);

			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('parents.php');
			//-->
			</script>
              <?php
			  }
			  else{
			  ?>

<table border="0" width="100%" align="center" class="haut_table">
  <tr>
    	<td>
			<img src="images/icone/etudiants.gif" border="0"/>
		</td>
    	<td width="78%" class="titre">
			&nbsp;Listing parents<span class="task">[Add]</span> 
	    </td>
		<td width="22%">
	 		 <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:validate()"><div class="save"></div>Add</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="parents.php"><div class="cancel"></div>Cancel</a>
		  </td>
		</tr>
	  </table>
		</td> 
  </tr>
 </table>

 <form method="post" action="parents.php?new=oui" name="f_ajout" >
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%">
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		  <tr>
		  <td width="15%">Name : </td>
		  <td width="30%"><input type="text" name="nom" id="nom" class="input input_size" /></td>
		  <td width="55%"><div id="er_nom" class="erreur"></div></td>
		  </tr>

		  <tr><td colspan="3" height="3px"></td></tr>
		 <!--   <tr>
		  <td>Nationality : </td>
		  <td><input type="text" name="nationalite" id="nationalite" class="input input_size" /></td>
		   <td>&nbsp;</td>
		   </tr>

		  <tr><td colspan="3" height="3px"></td></tr>
		  
		  <tr>
		  <td>Matirère : </td>
		  <td><input type="text" name="matiere" id="matiere" class="input input_size" /></td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="3" height="3px"></td></tr>-->
		   <tr>
		  <td>E-mail : </td>
		  <td><input type="text" name="email" id="mail" class="input input_size" /></td>
		   <td><div id="er_mail" class="erreur"></div></td>
		   </tr>
			<tr><td colspan="3" height="3px"></td></tr>
			<tr>
		  <td>Phone : </td>
		  <td><input type="text" name="contact" id="contact" class="input input_size" /></td>
		   <td>&nbsp;</td>
		   </tr>
		    <tr>

		  <td width="25%"><label for="code_inscription">Student Name :</label> </td>

		  <td width="25%">
		  <select name="code_inscription" id="code_inscription" class="input">
				<option value="">Select Student</option>
		  <?php 
		   $sql6="select code_inscription, nom, prenom from tbl_etudiant_morocco where archive = 0 AND groupe not in (5,7) order by prenom, nom";
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
		  <!-- <tr>
		  <td>E-mail secondaire : </td>
		  <td><input type="text" name="mail1" id="mail1" class="input input_size" /></td>
		   <td></td>
		   </tr>
		  <tr><td colspan="3" height="3px"></td></tr>

		   
		  <tr><td colspan="3" height="3px"></td></tr>
		  <tr>
		  <td>City : </td>
		  <td>
		  <select name="ville" class=" input input_size"  style="width:280px">
		  <option value="rabat">Rabat</option>
		  <option value="marrakech">Marrakech</option>
          <option value="casablanca">Casa Blanca</option>
		  </select>
		  </td>
		   <td>&nbsp;</td>
		  </tr>

		  <tr><td colspan="3" height="3px"></td></tr>

		   
		  <tr><td colspan="3" height="3px"></td></tr>
		   <tr>
		  <td>Degrees : </td>
		  <td><input type="text" name="diplome" id="diplome" class="input input_size" /></td>
		   <td>&nbsp;</td>
		   </tr>

		  <tr><td colspan="3" height="3px"></td></tr>

		  <tr>
		  <td>&nbsp;</td>
		  <td><input type="text" name="diplome1" id="diplome1" class="input input_size"/></td>
		   <td>&nbsp;</td>
		  </tr>

		  <tr><td colspan="3" height="3px"></td></tr>
		  
		  <tr>
		  <td>&nbsp;</td>
		  <td><input type="text" name="diplome2" id="diplome2" class="input input_size"/></td>
		   <td>&nbsp;</td>
		  </tr>
		  
 		  <tr><td colspan="3" height="3px"></td></tr>
		  <tr>
		  <td>Grade : </td>
		  <td>
		  <select name="niveau" class=" input input_size"  style="width:280px">
		  	  <option value="">Grade </option>
		  <option value="9th grade">9th Grade </option>
		  <option value="10th grade">10th Grade</option>
          <option value="11th grade">11th Grade</option>
           <option value="12th grade">12th Grade</option>
		  </select>
		  </td>
		   <td>&nbsp;</td>
		  </tr>-->

		  <tr><td colspan="3" height="3px"></td></tr>

		  <tr>
			  <td>Login : </td>
			  <td><input type="text" name="login" id="login" class="input input_size"/></td>
			  <td><div id="er_login" class="erreur"></div></td>
		  </tr>

		  <tr><td colspan="3" height="3px"></td></tr>

		  <tr>
			  <td>Password : </td>
			  <td><input type="text" name="pass" id="pass" class="input input_size"/></td>
			  <td><div id="er_pass" class="erreur"></div></td>
		  </tr>
		  </table>
	     </td>

		</tr>  

	  </table>

     </form>

<?php

}

?>