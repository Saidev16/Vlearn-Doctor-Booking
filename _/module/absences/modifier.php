	<?php
	/*if(isset($_SESSION['idSession'])){
	$idSession=$_SESSION['idSession'];
	}*/
	?>

	<script language="javascript1.2">
	function valid_form(){
 	document.f_ajout.submit();
 	return true;
 						}
	</script>

	<?php 

        if (isset($_POST['comptabilise'])){

			$idAbsence=$_POST['idAbsence'];

			$code_inscription=$_POST['code_inscription'];

			$code_cours=$_POST['code_cours'];

			$n_incomptabilise=(int)$_POST['incomptabilise'];

			$n_comptabilise=(int)$_POST['comptabilise'];

 			$ex_incomptabilise=$_POST['ex_incomptablise'];

			$nombre = $_POST['nombre'];
			
			$idSession = $_POST['idSession'];
			
    

	 //traitement mise à jour



     if($n_comptabilise-$n_incomptabilise==0){

	 $jeton='NC';

	 }

     else{

	 $jeton='A';

	 }

    

      $new_comptabilise=$nombre-$n_incomptabilise;

	  if($ex_incomptabilise > $n_incomptabilise){

	  $dif=$ex_incomptabilise-$n_incomptabilise;

	  }

	  else{

	  $dif=$n_incomptabilise-$ex_incomptabilise;

	  }

      



     //mise à jour de la table absence



        $sql="update $tbl_absence set n_comptabilise=$new_comptabilise, 

        n_incomptabilise=$n_incomptabilise,  

        jeton='$jeton' 

        where idAbsence='$idAbsence' limit 1";
		

        @mysql_query($sql) or die ("erreur lors de la mise à jour de l'absence");

      

    // mise à jour note



        $sql1="update $tbl_note set n_comptabilise=n_comptabilise-$dif,

        n_incomptabilise=n_incomptabilise+$dif, nbr_absence=n_comptabilise-$dif
		
			
		where 

		code_cours='$code_cours'

        and code_inscription='$code_inscription'

        and idSession='$idSession' limit 1";

         @mysql_query($sql1) or die ("erreur lors de la mise à jour de l'absence des notes");



    

        //mise à jour de la note 



                $sql2="select *  from $tbl_note where code_cours='$code_cours' 

                and code_inscription='$code_inscription' 

                and idSession='$idSession' limit 1";

                 

                $req=@mysql_query($sql2);

                $row=mysql_fetch_assoc($req);

                $controle1=$row['controle1'];

                $controle2=$row['examen_mi_semestre'];

                $controle3=$row['controle3'];

                $controle4=$row['examen_final'];

                $controle5=$row['participation'];

                $controle6=$row['devoirs_projets'];

                $code_inscription=$row['code_inscription'];
 
                $n_comptabilise=$row['n_comptabilise'];

                $n_incomptabilise=$row['n_incomptabilise'];
				
				$absence=$row['nbr_absence'];

         $notess=array($controle1, $controle2, $controle3, $controle4, $controle5, $controle6);
		
		//selection des coeficients
	
		$sql_desc="SELECT pourcentage from $tbl_descriptif 
		WHERE code_cours='$code_cours' 
		AND idSession='$idSession'";
		$req_desc=@mysql_query($sql_desc) or die('erreur de selection des coeficientsx');
		$row_desc=mysql_fetch_assoc($req_desc); 
		$percent=explode(';', $row_desc['pourcentage']);
				
		require  '../include/note.php';
		
		 //appel de la fonction de calcule du coeficient 
			 $moyen= factory($notess, $percent );	
		     
			 // verifier absence
			 $notes= verifyAbsence($moyen, $absence, $n_comptabilise);
			 
 			 $note_final = $notes['note_final'];
			 $note_chiffre = $notes['note_chiffre'];
 			 $note_lettre = noteConvertor($note_chiffre); 
			      
				  
				  ## debugage 
 				/*  echo $sql.'<br>';
				  echo $sql1.'<br>';
				  echo $sql2.'<br>';
				  echo $code_inscription.'<br>';
				  print_r($notess);echo '<br>';
 				  print_r($percent);echo '<br>';
 			      echo $note_final.'<br>';
			 	  echo $note_chiffre.'<br>';
				  echo $note_lettre.'<br>';
				  echo $absence.'<br>';
				  echo $n_comptabilise.'<br>';*/
		  
			//build query
				 
				 

		$sql4="UPDATE $tbl_note SET 

		`note_finale` = '$note_final',

		`note_finale_chiffre` = '$note_chiffre',

		`note_finale_lettre` = '$note_lettre'

		 WHERE  `code_cours`='$code_cours' 

		 and `code_inscription`='$code_inscription'

		 and idSession='$idSession' limit 1";  

 
		   @mysql_query($sql4) or die("erreur lors de la mise à jour des notes"); 

						

								?>

								<script type="text/javascript" language="JavaScript1.2">

								<!--        

		window.location.replace('gestion_absences.php?code_inscription=<?=$_SESSION['cc']?>');

										

							//-->

							</script>

				  <?php

							  }

														else{

							   $idAbsence=$_GET["modifier"];

			$sql5="SELECT e.code_inscription, concat(e.nom,' ', e.prenom) as name, 
			c.titre, h.nom_horaire,
			a.code_cours, a.date, a.idAbsence, 
			a.n_comptabilise, a.n_incomptabilise, a.nombre, a.idSession  
			FROM $tbl_cours AS c, $tbl_absence AS a, $tbl_etudiant AS e, $tbl_horaire as h
			WHERE a.code_inscription = e.code_inscription
			and   a.code_cours = c.code_cours
			and   a.idHoraire=h.code_horaire 
			and   a.idAbsence='$idAbsence' limit 1"; 

		 $req=@mysql_query($sql5) or die("erreur lors de la sélection de l'absence");

				 $row=mysql_fetch_assoc($req);
				 
				 $code_inscription= $_SESSION['cc'] = $row['code_inscription'];

																		?>

        <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center"

class="haut_table">

  <tr>

    <td><img src="images/icone/cours.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES ABSENCES <span

style="font-size:12px">[modifier]</span></td>

        <td width="22%">

          <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

            <tr>

                  <td valign="top" align="center">

                <a href="#"onclick="javascript:valid_form();"><div class="save"></div>  Valider</a> 

                  </td>

                  <td valign="top" align="center">

              <a href="gestion_absences.php?code_inscription=<?=$code_inscription?>" >

                  <div class="cancel"></div>Annuler</a>

                  

                  </td>

                </tr>

          </table>

        </td> 

  </tr>

</table>

       <form method="post"  action="gestion_absences.php?modifier=oui" name="f_ajout">
 			<input type="hidden" name="idAbsence" value="<?=$row['idAbsence']?>" />
 			<input type="hidden" name="code_inscription" value="<?=$row['code_inscription']?>" />
 			<input type="hidden" name="code_cours" value="<?=$row['code_cours']?>" />
 			<input type="hidden" name="ex_incomptablise" value="<?=$row['n_incomptabilise']?>" />
			<input type="hidden" name="idSession" value="<?=$row['idSession']?>" />


           <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">

                <tr>

                  <td width="300">Intitulé du cours : </td>

                  <td colspan="3"><?=htmlentities($row['titre'])?></td>

                </tr>

                <tr>

				  <td colspan="4" height="3px"></td>

				</tr>

                <tr>

                  <td width="25%">Nom et prénom de l'étudiant : </td>

                  <td width="25%"><?=$row['name']?> 

                  </td>

                  <td width="25%"> </td>

                  <td width="25%"></td>

                  </tr>

                  <tr>

				  <td colspan="4" height="3px"></td>

                  </tr>

                   <tr>

                  <td>Date  : </td>

                <td><?=$row['date']?></td>

                   <td>&nbsp;</td>

                   <td>&nbsp;</td>

                   </tr>

                  <tr><td colspan="4" height="3px"></td></tr>

                  <tr>

                  <td>Horaire : </td>

                  <td>&nbsp;<?=$row['nom_horaire']?></td>

                   <td>&nbsp;</td>

                   <td>&nbsp;</td>

                   </tr>

                  <tr><td colspan="4" height="3px"></td></tr>

                   <tr>

                  <td>Nombre d'absence comptabilisé : </td>

                  <td>

                  <input type="text" name="comptabilise"  value="<?=$row['n_comptabilise']?>" readonly="yes" size="2" class="input"  /> 

                  </td>

                   <td>&nbsp;</td>

                   <td>&nbsp;</td>

                   </tr>

                  <tr><td colspan="4" height="3px"></td></tr>

                   <tr>

                  <td>Nombre d'absence incomptabilisé : </td>

                  <td>

                  <input type="text" name="incomptabilise" value="<?=$row['n_incomptabilise']?>" size="2" class="input" />

                  <input type="hidden" name="ex_incomptabilise" value="<?=$row['n_incomptabilise']?>" size="2" class="input" />

                  </td>

                   <td>&nbsp;</td>

                   <td>&nbsp;</td>

                   </tr>

                  <tr><td colspan="4" height="3px"></td></tr>

                  <tr>

                  <td>Nombre d'absence : </td>

                  <td>

                  <input type="text" name="nombre" id="nombre" value="<?=$row['nombre']?>" size="2" readonly="yes" class="input"/> 

                  </td>

                   <td>&nbsp;</td>

                   <td>&nbsp;</td>

                   </tr>

                  <tr><td colspan="4" height="3px"></td></tr>

          </table>

</form>

<?php

}

?>

