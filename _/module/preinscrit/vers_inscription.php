<style type="text/css">
input{width:200px;}
</style>
<?php


			  $code_inscription = $_GET["inscri"];
			  
			  $sql2="select * from tbl_preinscrit  
			  where code_inscription='$code_inscription' limit 1 ";
			  $req2=@mysql_query($sql2) or die("erreur lors du chargements  des données");
			  $row=mysql_fetch_assoc($req2);
			  
			   $code_inscription = $row['code_inscription'];
			  
			   $nom = htmlentities($row['nom']);
			   $prenom = htmlentities($row['prenom']);
 			   $nationalite=htmlentities($row['nationalite']);
			   $adresse = htmlentities($row['adresse']);
			   $sexe = trim($row['sexe']);
			   $code_bac = htmlentities($row['code_bac']);
			   $semestre = $row['semestre'];
			   $serie_bac = htmlentities($row['serie_bac']);
			   $date_inscription = htmlentities($row['date_inscription']);
			   $tel = htmlentities($row['tel']);
			   $email =htmlentities($row['email']);
			   $filiere =html_entity_decode($row['filiere']);
			   $lieu_naissance =htmlentities($row['lieu_naissance']);
			   $cin =htmlentities($row['cin']);
			   $groupe =htmlentities($row['groupe']);
			   //$financeur  =htmlentities($row['financeur']);
			   //$last_diplome =htmlentities($row['last_diplome']);
			   $cinq_photo  =htmlentities($row['cinq_photo']);
			   $buletin = htmlentities($row['buletin']);
			   $copie_cin = htmlentities($row['copie_cin']);
			   $copie_bac  =  htmlentities($row['copie_bac']);
		       $extrait_naissance = htmlentities($row['extrait_naissance']);
		       $test_fr = htmlentities($row['test_fr']) ;
			   $test_eng = htmlentities($row['test_eng']);
			   $test_math = $row['test_math'] ;
			   $test_logique = $row['test_logique'];
			   $original_bac = $row['original_bac'];
			   $english_bac = $row['english_bac'];
			   $trois_lettre = $row['trois_lettre'];
			   $trois_enveloppe = $row['trois_enveloppe'];
			   $aquise_academique = htmlentities($row['aquise_academique']) ;
			   $login = htmlentities($row['login']) ;
			   $pass = $row['cin'] ;
			   $acces = $row['acces'] ;
			   $etat = $row['groupe'] ;
			  $fraisinscription = $row[fraisinscription];
			   $montantbourse = $row[montantbourse];
			   $reglement = html_entity_decode($row['reglement']) ;
               $annee = htmlentities($row['annee']) ;
			   $activite = htmlentities($row['activite']);
			   $y = substr($row['date_naissance'], 0,4);
		       $m = substr($row['date_naissance'], 5,2);
		       $d = substr($row['date_naissance'], 8,2);
			   $yi = substr($date_inscription, 0,4);
		       $mi = substr($date_inscription, 5,2);
		       $di = substr($date_inscription, 8,2);
			   $niveau = htmlentities($row['niveau']);
			   $ville = htmlentities($row['ville']);
			   $elearning = htmlentities($row['elearning']);
			   $piimt = $row['piimt'];
			   $aul = $row['aul'];
			   $umt = $row['umt'];
			   $bba='Bachelor of Business Administration';
			   $mba='Master of Business Administration';
			   $attestations_count = $row['attestations_count'];
			   $attestation_fr = stripslashes($row['attestation_fr']);
			   $attestation_eng = stripslashes($row['attestation_eng']);
			   
			    $sql="insert into tbl_etudiant(`code_inscription`,`nom` ,`prenom`,`date_naissance`,`nationalite`,`adresse`,`sexe`,`code_bac`,`date_inscription`,`tel`,`email`,`annee`,`semestre`,`filiere`,`lieu_naissance`,`cin`,`cinq_photo`,`original_bac`,`copie_bac`,`english_bac`,`trois_lettre`,`trois_enveloppe`,`buletin`,`reglement`,`copie_cin`,`extrait_naissance`,`test_fr`,`test_eng`,`test_logique`,`test_math`,`aquise_academique`,`groupe`,`activite`,`annee_inscription`,`niveau`,`ville`,`elearning`, `piimt`,`aul`,`umt`,`attestation_fr`,`attestation_eng`,`fraisinscription`,`montantbourse`)
				 values('$code_inscription','$nom','$prenom','$date_naissance','$nationalite','$adresse','$sexe','$code_bac','$date_insc','$tel','$email','$annee','$semestre','$filiere','$lieu_naissance','$cin','$cinq_photo','$original_bac','$copie_bac','$english_bac','$trois_lettre','$trois_enveloppe','$buletin','$reglement','$copie_cin','$extrait','$test_fr','$test_eng','$test_logique','$test_math','$aquise','$groupe','$activite','$annee_inscription','$niveau','$ville','$elearning','$piimt','$aul','$umt','$attestation_fr','$attestation_eng','$fraisinscription','$montantbourse');";

             @mysql_query($sql) or die ("erreur lors de l' ajout dans la table etudiant");
			  
			  
			   $sql1="select login,date_naissance,email,groupe
        from $tbl_etudiant 
		where code_inscription='$code_inscription' ";
		$resultat=@mysql_query($sql1)or die ("Error");
		 while ($ligne=mysql_fetch_array($resultat))
{
 $email=$ligne["email"];
		 $groupe=$ligne["groupe"];
		 $login=$ligne["login"];
		 $pass=$ligne["date_naissance"];
}
 if($groupe==2)
 {    $affich="";
     if($copie_cin==0)
         {
		 $affich="<br/>-Copie du Cin,";}
		 if($copie_bac==0)
		 {$affich .= '<br/>-Copie du Bac,'; }
		 if($original_bac==0)
		 {$affich .= '<br/>-Bac Original,'; }
		 if($trois_lettre==0)
		 {$affich .= '<br/>-Trois Lettres de Motivation,'; }
		 if($buletin==0)
		 {$affich .= '<br/>-Buletin des notes,'; }
		 if($extrait==0)
		 {$affich .= '<br/>-Extrait de naissance,'; }
		 if($trois_enveloppe==0)
		 {$affich .= '<br/>-Trois enveloppes,'; }
		  if($cinq_photo==0)
		 {$affich .= '<br/>-Cinq photo,'; }
		if($affich!="")
		 {$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='<html><head><title></title></head><body><p align="left">Bienvenue dans votre espace étudiant, veuillez 

utiliser ce système <a href="http://piimt.us/piimt/">www.piimt.us/piimt</a> pour avoir votre emploi du temps, classes, stages et bulletins de notes.</p><p align="left"> Votre 

username est:'.$login.' </p><p align="left"> Votre password est:'.$pass.'</p> <p align="left"> Veuillez acceder au site à: 

<a href="http://www.piimt.us/">www.piimt.us</a></p><p align="left"> Si vous avez des questions n\'hesitez pas a nous contacter via: 

info@piimt.us</p><p align="left">Merci de nous faire parvenir les pièces manquantes ci-dessous, dans les brefs délais afin de compléter votre dossier:'.$affich.'</p></body></html>';

     if(mail($email, 'Inscription PSI',$message,$headers))
     {
          return 1;
     }
     else
     {
         return 0;
     } 
	 }
	
		 else{
   $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='<html><head><title></title></head><body><p align="left">Bienvenue dans votre espace étudiant, veuillez 

utiliser ce système <a href="http://piimt.us/piimt/">www.piimt.us/piimt</a> pour avoir votre emploi du temps, classes, stages et bulletins de notes.</p><p align="left"> Votre 

username est:'.$login.' </p><p align="left"> Votre password est:'.$pass.'</p> <p align="left"> Veuillez acceder au site à: 

<a href="http://www.piimt.us/">www.piimt.us</a></p><p align="left"> Si vous avez des questions n\'hesitez pas a nous contacter via: 

info@piimt.us</p></body></html>';

     if(mail($email, 'Inscription PSI',$message,$headers))
     {
          return 1;
     }
     else
     {
         return 0;
     } 
	 
	 }}
 
 
 
 else
 
 {
 $affich="";
     if($copie_cin==0)
         {
		 $affich="<br/>-copie du cin,";}
		 if($copie_bac==0)
		 {$affich .= '<br/>-Copie du Bac,'; }
		 if($original_bac==0)
		 {$affich .= '<br/>-Bac Original,'; }
		 if($trois_lettre==0)
		 {$affich .= '<br/>-Trois Lettres de Motivation,'; }
		 if($buletin==0)
		 {$affich .= '<br/>-Buletin des notes,'; }
		 if($extrait==0)
		 {$affich .= '<br/>-Extrait de naissance,'; }
		 if($trois_enveloppe==0)
		 {$affich .= '<br/>-Trois enveloppes,'; }
		  if($cinq_photo==0)
		 {$affich .= '<br/>-Cinq photo,'; }
		if($affich!="")
		 { $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='<html><head><title></title></head><body><p align="left">Welcome to your student Account, Please use this system <a href="http://piimt.us/piimt/">www.piimt.us/piimt</a> to get information
about your schedule, classes, internships and obtain your grades.</p><p align="left">Your username is:'.$login.'</p><p align="left">Your password is:'.$pass.'</p><p align="left"> The website can be reached through: 

<a href="http://www.piimt.us/">www.piimt.us</a></p><p align="left"> If you have any questions, please email us at: 

info@piimt.us</p><p align="left">We inform you that you need to complete your file by the following papers:'.$affich.'</p></body></html>';

     if(mail($email, 'Inscription PSI',$message,$headers))
     {
          return 1;
     }
     else
     {
         return 0;
     } 
 }
 
 else{
 $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='<html><head><title></title></head><body><p align="left">Welcome to your student Account, Please use this system <a href="http://piimt.us/piimt/">www.piimt.us/piimt</a> to get information
about your schedule, classes, internships and obtain your grades.</p><p align="left">Your username is:'.$login.'</p><p align="left">Your password is:'.$pass.'</p><p align="left"> The website can be reached through: 

<a href="http://www.piimt.us/">www.piimt.us</a></p><p align="left"> If you have any questions, please email us at: 

info@piimt.us</p></body></html>';

     if(mail($email, 'Inscription PSI',$message,$headers))
     {
          return 1;
     }
     else
     {
         return 0;
     }
	 
	 
	  }}
           ?>
 <style type="text/css">
input{
width:230px;
}
</style>


 
       