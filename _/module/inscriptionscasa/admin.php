<?php
        $where=$groupe=$search=$pci=$type='';

	   if((isset($_POST['search_par_code'])) && (!empty($_POST['search_par_code'])) ){
		   $search = addslashes(trim($_POST['search_par_code']));
		   $where ="  AND c.code_cours like '".$search."%'";
 	                                                                                 }

	   if((isset($_POST['search_par_title'])) && (!empty($_POST['search_par_title'])) ){
		   $search = addslashes(trim($_POST['search_par_title']));
		   $where ="  AND c.titre like '".$search."%'";
                                                                                        }
	   if((isset($_POST['code_inscription'])) && (!empty($_POST['code_inscription'])) ){
	   $pci=trim($_POST['code_inscription']);
	   ?>
	   <script language="javascript1.2">
	   <!--
	   		window.location.replace('gestion_inscription_burkina.php?code_inscription=<?=$pci?>');
	   -->
	   </script>
	   	<?php																   }


	   else{

                   //session comme crit�re

 			 if( (isset($_POST['idSession'])) && (!empty($_POST['idSession'])) ){
  					 $idSession = $_SESSION['NidSession'] = $_POST['idSession'];
   	                 $where = $where." AND i.idSession='". $idSession."'";
 					                                                        }

				else if( (isset($_POST['idSession'])) && (empty($_POST['idSession'])) ){
   	                      unset($_SESSION['NidSession']);
  						                                                          }

					else if( (isset($_SESSION['NidSession'])) && (!empty($_SESSION['NidSession'])) ){
						   $idSession=$_SESSION['NidSession'];
   	                       $where = $where." AND i.idSession='".$idSession."'";
  						                                                   }
							   else{
							            $_SESSION['NidSession']=$idSession;
										$where=$where." AND i.idSession='".$idSession."'";
								   }


									//fili�re comme crit�re



						if( (isset($_POST['groupe'])) && (!empty($_POST['groupe'])) ){
 							$Igroupe = $_SESSION['Igroupe'] = $_POST['groupe'];
							$where = $where." AND c.type='". $Igroupe."'";
 																					   }


							else if( (isset($_POST['groupe'])) && (empty($_POST['groupe'])) ){
   	                          unset($_SESSION['Igroupe']);
  						                                                                       }



							else if( (isset($_SESSION['Igroupe'])) && (!empty($_SESSION['Igroupe'])) ){
								$Igroupe=$_SESSION['Igroupe'];
   	                            $where = $where." AND c.type='".$Igroupe."'";
 						                                                                            }


							//type comme crit�re



						if( (isset($_POST['type'])) && (!empty($_POST['type'])) ){
 							$type = $_SESSION['type'] = $_POST['type'];
							$where = $where." AND e.groupe='". $type."'";
 																					   }


							else if( (isset($_POST['type'])) && (empty($_POST['type'])) ){
   	                          unset($_SESSION['type']);
  						                                                                       }



							else if( (isset($_SESSION['type'])) && (!empty($_SESSION['type'])) ){
								$type=$_SESSION['type'];
   	                            $where = $where." AND e.groupe='".$type."'";
 						                                                                            }



	      }

 	  $sql="SELECT c.titre, i.code_cours, count(i.code_inscription) as inscription from
 		tbl_cours as c, tbl_inscription_cours_burkina as i, tbl_etudiant_burkina as e
		where i.code_cours = c.code_cours
		AND i.code_inscription=e.code_inscription ". $where." GROUP BY c.code_cours ORDER BY c.titre";

		//show the session


		  $sqlsql="select  session, annee_academique
				from $tbl_session where idSession='$idSession' limit 1";


		$reqreq=mysql_query($sqlsql) ;
		$rows=mysql_fetch_assoc($reqreq);
 		$session = $rows['session'];
		$annee = $rows['annee_academique'];

 	 ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/horraires.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Listing Registration
	 &nbsp;&nbsp;<span class="task">[<?=$session.' '.$annee?>]</span>
	</td>
	<td width="22%">
	 <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
     <td valign="top" align="center"><a href="gestion_inscription_burkina.php?transfer_courses"><div class="ajouter"></div>Transfer Courses</a></td>
		 <td valign="top" align="center"><a href="gestion_inscription_burkina.php?full_add=oui"><div class="ajouter"></div>Add Testing Course</a></td>
     <td valign="top" align="center"><a href="gestion_inscription_burkina.php?course_inscription"><div class="ajouter"></div>Add Course new</a></td>
     <td valign="top" align="center"><a href="gestion_inscription_burkina.php?full_addc=oui"><div class="ajouter"></div>Add Course</a></td>
		 <td valign="top" align="center"><a href="gestion_inscription_burkina.php?full_addch=oui"><div class="ajouter"></div>Add Challenge Course</a></td>
		 <td valign="top" align="center"><a href="gestion_inscription_burkina.php?full_addT=oui"><div class="ajouter"></div>Add Transfer Course</a></td
		></tr>
	</table>
    </td>
</table>



<form action="#" method="post" name="adminMenu">

<div class="container_search">

  <select name="idSession" class="search" >
 <?php
      $sql2="select idSession, session, annee_academique,academic_year   from $tbl_session  order by annee_academique, session";
 	  $req2=@mysql_query($sql2) or die("erreur lors de la s�lection des sessions");
 	  while ($row = mysql_fetch_assoc($req2)){
	  $is=$row['idSession'];
	  $ns=$row['session'].' '.$an=$row['annee_academique'];
	  	$cc=$row['academic_year'];
 	  ?>
 	  <option  value="<?=$is?>" <?=($idSession==$is) ? $selected : ''?>><?=$ns?></option>
	  <?php
	  }
	  ?>
  </select>
<!-- <select name="type" class="search" >
 <?php
      $sql2="SELECT id, title FROM $tbl_groupe";
 	  $req2=@mysql_query($sql2) or die("erreur lors de la s�lection des groupes");
 	  while ($row = mysql_fetch_assoc($req2)){
	  $id=$row['id'];
	  $title=$row['title'];
 	  ?>
 	  <option  value="<?=$id?>" <?=($type==$id) ? $selected : ''?>><?=$title?></option>
	  <?php
	  }
	  ?>
  </select>
  <select name="groupe" class="search" title="Recherchez par le nom du groupe du cours">
    	<option value="0">GROUPE</option>
        <option value="bachelor" <?=($groupe=='bachelor') ? $selected : ""?>>BACHELOR</option>
        <option value="master" <?=($groupe=='master') ? $selected : ""?>>MASTER</option>
        <option value="MBA" <?=($groupe=='MBA') ? $selected : ""?>>MBA</option>
        <option value="BBA" <?=($groupe=='BBA') ? $selected : ""?>>BBA</option>
    </select>

    <select name="code_inscription" class="search" onchange="javascript:document.adminMenu.submit()" title="S&eacute;l&eacute;ctionnez un &eacute;tudiant pour voir ses cours">
   		<option value="">CODE INSCRIPTION</option>
		<?php
		$query="select distinct i.code_inscription, concat(e.nom,' ', e.prenom) as name
		from tbl_etudiant_burkina as e, tbl_inscription_cours_burkina as i
		where i.code_inscription=e.code_inscription
		AND i.idSession=$idSession
		order by name";
 		$resultat=@mysql_query($query) or die('erreur lors de la selection des etudiants');
		while($row=mysql_fetch_assoc($resultat)){
		$ci=$row['code_inscription'];
		$np=$row['name'];
		?>
		<option value="<?=$ci?>" <?=($pci==$ci) ? $selected : '' ?>><?=$np?></option>
		<?php
		}
		?>
		</select>
          <input type="text" class="input" name="search_par_code" size="12" title="Rechercher par le code du cours" />&nbsp;
		  <input type="text" class="input" name="search_par_title" size="30" title="Rechercher par le titre du cours"  />&nbsp; -->
		  <input type="submit" name="valider" value="Submit"  class="input" title="Lancer la recherche"   />&nbsp;
   </div>
          <input type="hidden" name="boxchecked" value="0" />
          </form>
          <table class="table table-bordered" id="example_1">
            <thead>
              <tr>
                <th width="15" align="center">#</th>
            	  <th width="70" align="center" nowrap="nowrap">Course Code</th>
           	    <th width="900" align="center" >Course Title</th>
              </tr>
            </thead>
            <tbody>
       <?php
       $i=0;
       $res=@mysql_query($sql) or die ('erreur de selection des cours');
 	   while ($row = mysql_fetch_assoc($res)) {
	   $i++;
	   $cc=$row['code_cours'];
      ?>

  <tr height="16px">
     <td align="center" width="15px"><?=$i?></td>
	 <td align="left"><a href="gestion_inscription_burkina.php?code_cours=<?=$cc?>" title="Cliquez pour voir les &eacute;tudiants inscrits dans ce cours">&nbsp;<?=$cc?></a></td>
 	 <td align="left">&nbsp;<?=stripslashes(trim($row["titre"]))?></td>
	 <?php
	/* $inscri="select count(*) as nbre from tbl_inscription_cours_burkina_burkina where code_cours='$cc' and idSession='$idSession'";*/
	$inscri="select count(*) as nbre  from tbl_inscription_cours_burkina as c, tbl_note_burkina as n
              where c.code_cours=n.code_cours and c.code_inscription = n.code_inscription
              and c.code_cours='$cc' and c.idSession='$idSession' and c.archive=0 and
              n.letter_grade !='t' ";
	 $inscrires=@mysql_query($inscri) or die('erreur lors de la selection des etudiants');
	 $ii=mysql_fetch_assoc($inscrires);
	 ?>
	 <!--<td align="center" title="Nombre d'�tudiant inscrit dans ce cours "><?php echo $ii['nbre'];/*$row['inscription']*/?></td>-->
  </tr>
<?php
      }
?>
</tbody>
<!-- <tr><td colspan="5" class="gras">Nombre de cours : <?=$i?></td></tr>-->
 </table>

<script type="text/javascript">
$(document).ready(function() {

  $('#example').DataTable( {
  "paging": false
} );
  $('#example_1').DataTable();
} );
</script>
