<?php
       $where=$code_cours=$code_cour="";
   	   if((isset($_POST['code_cours'])) && (!empty($_POST['code_cours'])) ){
  	   $code_cours = $_POST['code_cours'];
  	   ?>
 	   <script language="javascript1.2">
 	   window.location.replace("gestion_notes_gues.php?code_cours=<?=$code_cours?>");
 	   </script>
 	   <?php
 	                                                                         }

 	   if((isset($_POST['code_cour'])) && (!empty($_POST['code_cour'])) ){
  	   $code_cour = $_POST['code_cour'];
  	   ?>
 	   <script language="javascript1.2">
 	   window.location.replace("gestion_notes_gues.php?code_cours=<?=$code_cour?>");
 	   </script>
 	   <?php
 	                                                                     }

 
  	   else{

                   //session comme critère 
 
				  if( (isset($_POST['idSession'])) && (!empty($_POST['idSession'])) ){

 					 $idSession= $_SESSION['MidSession'] = $_POST['idSession'];

  	                $where = $where." and n.idSession='". $idSession."'";

					                                                                 }

																			

						 else if( (isset($_POST['idSession'])) && (empty($_POST['idSession'])) ){

  	                      unset($_SESSION['MidSession']);

 						                                                                        }

																				  

			else if( (isset($_SESSION['MidSession'])) && (!empty($_SESSION['MidSession'])) ){

							  $idSession = $_SESSION['MidSession'];
   	                          $where = $where." and n.idSession='". $idSession."'";

 						                                                                   }
                            else{
							
 							      $_SESSION['MidSession'] = $idSession;
                                  $where = $where." and n.idSession='". $idSession."'";
                                }
 
 	      }

 		  $sql="SELECT concat(e.nom,' ', e.prenom) as name, e.annee, n.code_inscription
		  from  tbl_note_GUES as n, tbl_etudiant_GUES as e 
	      where n.code_inscription = e.code_inscription 
		  ". $where. " group by name ";

 		 //show the session 
		
                      
		  $sql1="select idSession, session, annee_academique 
				from $tbl_session where idSession=$idSession limit 1";
				
				
		$req=@mysql_query($sql1) ;
		$row=mysql_fetch_assoc($req);
		$idSession=$_SESSION['IidSession']=$row['idSession'];
		$session = $row['session'];
		$annee = $row['annee_academique'];

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre"><?php echo 'listing_grades' ; ?></td>
	<td width="22%">&nbsp;</td> 
  </tr>
</table>
<table width="100%" align="center" cellspacing="1"  class="adminlist" >
<form action="#" method="post" name="adminMenu" id="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<div class="container_search">
  <select name="idSession" class="search" >
 <option value="0"><?php echo 'Select Academic Year'; ?></option>
 <?php 
     $sql1="select * from $tbl_session  ";
	 $req=mysql_query($sql1) or die("Failure to select SESSIONS");

	 while ($row=mysql_fetch_assoc($req)){
	 $cs=$row['idSession'];
	 $ns=$row['session'].' '.$row['annee_academique'];
	 $cc=$row['academic_year'];
	 ?>
	 <option value="<?=$cs?>" <?=($idSession==$cs) ? $selected : '' ?>><?=$cc?></option>
 <?php
 }
 ?>
</select> 
<!--<select name="code_cour" class="search"  style="width:400px" >
 <option value="0"><?php echo 'select_course'; ?></option>
 <?php 
     $sql2="select distinct code_cours, titre_eng from $tbl_cours where code_cours in 
	 (select code_cours from tbl_note_GUES where idSession='$idSession') ";
 	 $req=mysql_query($sql2) or die("Failure to select COURSES");
	 while ($row=mysql_fetch_assoc($req)){
	 $cc=$row['code_cours'];
	 $tc=strtoupper($row['titre_eng']);
	 ?>
	 <option value="<?=$cc?>" <?=($code_cours==$cc) ? $selected : '' ?>><?=$tc?></option>
 <?php
 }
 ?>
 </select>-->
<input type="submit" name="valider" value="<?php echo 'submit'; ?>" />
<input type="submit" value="<?php echo 'all'; ?>" name="tous" /> 
 </div>

  <tr >
     <th width="15" align="center">#</th>
	 <th width="100">code</th>
	 <th width="600"><?php echo 'name'; ?></th>
	
  </tr>

       <?php
        $i=0;
        $req=@mysql_query($sql) or die ('Failure to select STUDENTS');
  	    while ($ligne = mysql_fetch_assoc($req)) {
	    $i++;
 	    $ci=$ligne["code_inscription"];
      ?>

  <tr>
      <td align="center" width="15px"><?=$i?></td>
	  <td align="left"><a href="gestion_notes_gues.php?code_inscription=<?=$ci?>"><?=$ci?></a></td>
	  <td align="left">&nbsp;<?=ucfirst($ligne["name"])?></td>
	 <!-- <td align="center">&nbsp;<?=ucfirst(strtolower($ligne['annee']))?></td>-->
  </tr>

<?php
      }
?>
</form>
<tr class="gras">
	<td colspan="5"><?php echo translate('registrations'); ?>  : <?=$i?></td>
</tr>
 </table>
 