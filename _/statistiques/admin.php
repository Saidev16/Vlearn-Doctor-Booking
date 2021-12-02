<script language="javascript">
function change(id){
if(id=='gpa'){
document.getElementById('cgpa').selectedIndex=0
}
else{
document.getElementById('gpa').selectedIndex=0
}
}
</script>
<?php
       $where=$gpa=$cgpa='';
       
 
 
 // end 
 
 
					//gpa comme critère 
					
					  if( (isset($_POST['gpa'])) && (!empty($_POST['gpa'])) ){
						 $gpa= $_SESSION['gpa'] = $_POST['gpa'];
						 $where = $where." and n.gpa ". $gpa."";
					                                                         }

						 else if( (isset($_POST['gpa'])) && (empty($_POST['gpa'])) ){
   	                      unset($_SESSION['gpa']);
  						                                                            }

								else if( (isset($_SESSION['gpa'])) && (!empty($_SESSION['gpa'])) ){
									  $gpa = $_SESSION['gpa'];
									  $where = $where." and n.gpa ". $gpa."";
 						                                                                          }
					//cgpa comme critère
					
					
                   //session comme critère 
 
				  if( isset($_POST['idSession'])  && $_POST['idSession']!=0 ){
  					 $idSession= $_SESSION['IidSession'] = $_POST['idSession'];
   	                 $where = $where." and n.idSession='". $idSession."'";
 					                                                                 }

																			

						 else if( isset($_POST['idSession']) ){
   	                      unset($_SESSION['IidSession']);
  						            $idSession=$_POST['idSession'];                                                            }

																				  

								else if( isset($_SESSION['IidSession']) &&  $_SESSION['IidSession']!=0 ){
								  $idSession = $_SESSION['IidSession'];
								  $where = $where." and n.idSession='". $idSession."'";
  						                                                                   						}
                           			 /*else{
										  $_SESSION['IidSession'] = $idSession;
										  $where = $where." and n.idSession='". $idSession."'";
                                         }*/
 
 	       

 		  $sql="SELECT concat(e.nom,' ', e.prenom) as name, n.code_inscription, n.final_grade, n.letter_grade, n.gpa
		  from  $tbl_note as n, $tbl_etudiant as e 
	      where n.code_inscription = e.code_inscription 
 		  ". $where. " group by n.code_inscription order by name ";

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
    <td width="78%" class="titre">&nbsp;GESTION DES STATISTIQUES 
	 &nbsp;&nbsp;<span class="task">[<?=$session.' '.$annee?>]</span>
 	</td>
	<td width="22%"><a href="gestion_statistiques.php?CGPA=true">CGPA</a></td> 
  </tr>
</table>
<table width="100%" align="center" cellspacing="1"  class="adminlist" >
<form action="#" method="post" name="adminMenu" id="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<div class="container_search">
  <select name="idSession" class="search" >
 <option value="0">&nbsp;SESSION</option>
 <?php 
     $sql1="select idSession, session, annee_academique from $tbl_session ";
	 $req=mysql_query($sql1) or die("erreur lors de la sélection des années academique");

	 while ($row=mysql_fetch_assoc($req)){
	 $cs=$row['idSession'];
	 $ns=$row['session'].' '.$row['annee_academique']
	 ?>
	 <option value="<?=$cs?>" <?=($idSession==$cs) ? $selected : '' ?>><?=$ns?></option>
 <?php
 }
 ?>
 </select>
 <select name="gpa" id="gpa" class="search" onchange="javascript:change(this.id)">
     <option value="0">GPA</option>
     <option value="< 2 and n.gpa != 0" <?php echo $gpa=='< 2 and n.gpa != 0' ? 'selected="selected"' : '' ?>>Less than 2</option>
     <option value=">3 and n.gpa < 3.5 and n.gpa != 0" <?php echo $gpa=='>3 and n.gpa < 3.5 and n.gpa != 0' ? 'selected="selected"' : '' ?>>More than 3 and less than 3.5</option>
     <option value=">3.5 and n.gpa != 0" <?php echo $gpa=='>3.5 and n.gpa != 0' ? 'selected="selected"' : '' ?>>More than 3.5</option>
 </select>
 <select name="cgpa" id="cgpa" class="search" onchange="javascript:change(this.id)" >
     <option value="0" >CGPA</option>
     <option value="<2" <?php echo $cgpa=='<2' ? 'selected="selected"' : '' ?>>Less than 2</option>
     <option value=">3" <?php echo $cgpa=='>3' ? 'selected="selected"' : '' ?>>More than 3</option>
     <option value=">3.5" <?php echo $cgpa=='>3.5' ? 'selected="selected"' : '' ?>>More than 3.5</option>
 </select>
<input type="submit" name="valider" value="valider" class="input"/>
 </div>

  <tr>
     <th width="15" align="center">#</th>
	 <th width="120">code d'inscription</th>
	 <th width="600">Nom et prénom</th>
     <th width="100">Final grade</th>
     <th width="100">Letter grade</th>
     <th width="100">GPA</th>
  </tr>

       <?php
        $i=0;
        $req=@mysql_query($sql) or die ($sql);
  	    while ($ligne = mysql_fetch_assoc($req)) {
	    $i++;
 	    $ci=$ligne["code_inscription"];
      ?>

  <tr>
      <td align="center" width="15px"><?=$i?></td>
	  <td align="left"><?=$ci?></td>
	  <td align="left">&nbsp;<?=htmlentities($ligne["name"])?></td>
      <td align="center">&nbsp;<?=htmlentities($ligne["final_grade"])?></td>
      <td align="center">&nbsp;<?=htmlentities($ligne["letter_grade"])?></td>
       <td align="center">&nbsp;<?=htmlentities($ligne["gpa"])?></td>
  </tr>

<?php
      }
?>
</form>
<tr class="gras">
	<td colspan="6">Nombre d'étudiants  : <?=$i?></td>
</tr>
 </table>

 <?php echo $sql; ?>