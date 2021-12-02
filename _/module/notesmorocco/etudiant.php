<?php
	$idSession=$_SESSION['IidSession'];
    $code_inscription=$_SESSION['code_inscription']=trim($_GET['code_inscription']);

   	$sql1="select concat(e.nom, ' ', e.prenom) as name ,niveau
	from tbl_etudiant_morocco as e
	where code_inscription='$code_inscription' limit 1";

	$req=@mysql_query($sql1) or die("erreur lors de la sélection du nom et filière");

	$row=mysql_fetch_assoc($req);
	$name=$row['name'];
	$filiere=$row['nom_filiere'];
	$niveau=$row['niveau'];
   
	if(isset($_POST['idSession'])){
	
	  $idSession=$_SESSION['IidSession']=$_POST['idSession'];
	  
	 $sql="SELECT c.titre,c.code_cours, n.* FROM
	 $tbl_cours AS c, tbl_note_morocco AS n WHERE
	 n.code_inscription='$code_inscription'
	 AND n.code_cours=c.code_cours
	 AND n.archive=0
	 AND n.idSession='$idSession'
	 ORDER BY c.titre";
	 
	}
	else{

     $sql="SELECT c.titre ,c.code_cours, n.* FROM
	 $tbl_cours AS c, tbl_note_morocco AS n WHERE
	 n.code_inscription='$code_inscription'
	 AND n.code_cours=c.code_cours
	 AND n.archive=0
	 
	 order BY c.code_cours";
	
		}
		//show the session 
		
                      
		  $sql1="select idSession, session, annee_academique,academic_year 
				from $tbl_session where idSession=$idSession limit 1";
				
				
		$req=@mysql_query($sql1) ;
		$row=mysql_fetch_assoc($req);
		$idSession=$_SESSION['IidSession']=$row['idSession'];
		$session = $row['session'];
		$annee = $row['annee_academique'];
	$cc=$row['academic_year'];
?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Listing Grades 
		<span class="sub_title">Name :<?=$name?></span>
		<!--<span class="sub_title">Concentration :<?=$filiere?></span>-->
		<span class="sub_title">Academic Year :<?=$cc?></span>
 	</td>

	<td width="22%">

	  <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		  <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez une note ??');

				   }

				   else

				   {
			     chemin=document.adminMenu.boxchecked.value;
				     xyz=document.adminMenu.notefoupasf.value;
					 chemin='gestion_notes_morocco.php?modifier='+chemin+'&foupasf='+xyz;


				     window.location.replace(chemin); 

				   }

				   " >
				   

		  <div class="modifier"></div>Edit </a>

		  </td>

		  <td valign="top" align="center" >

		  <a href="#" title="Imprimer"><div class="imprimer"></div>Print</a>

		  </td>

		  <td valign="top" align="center" width="90">

		   <a href="gestion_notes_morocco.php"><div class="retour"></div>Back</a>

		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

</table>

<table width="100%" align="center" cellspacing="1" border="0"  class="adminlist">

<form action="#" method="post" name="adminMenu">

<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="notefoupasf" value="0" />

<div class="container_search">

  <select name="idSession" class="search" >
 <?php 
     $sql1="SELECT idSession, session, annee_academique ,academic_year
	 FROM $tbl_session WHERE idSession IN (select distinct idSession 
	 FROM tbl_note_morocco WHERE code_inscription = '$code_inscription') 
	 ORDER BY idSession desc ";
	 $req=mysql_query($sql1) or die("erreur lors de la sélection des années academique");

	 while ($row=mysql_fetch_assoc($req)){
	 $cs=$row['idSession'];
	 $ns=$row['session'].' '.$row['annee_academique'];
	 $cc=$row['academic_year'];
	 ?>
	 <option value="<?=$cs?>" <?=($idSession==$cs) ? $selected : '' ?>><?=$ns?></option>
 <?php
 }
 ?>
 </select>
 <input type="submit" value="Submit" class="input"  />

 </div>



  <tr>
     <th align="center" width="10px">#</th>
	 <th width="10px">&nbsp;</th>
	 <th width="65">Course Code</th>
	 <th width="400">Title Course</th>
	
     <th width="75">Final exam</th>
   <!--  <th width="75">Final grade</th>-->
	 <th width="75">Letter grade</th>
	
     <!-- <th width="30">GPA</th>-->
   </tr>


     

 	 <?php
      $code_inscription=$_GET['code_inscription'];
      $req = @mysql_query($sql) or die("erreur lors de sélection des notes");
  	  $i = 0;
  	  while ($row = mysql_fetch_array($req)) {
	  $cc=$row["code_cours"];
	  $cn=$row["code_note"];
	  $i++;
	  $sql12="select code_cours from $tbl_cours where code_cours='$cc' ";
	$req12=@mysql_query($sql12) or die("erreur lors de la sélection du nom et filière");
	$row1=mysql_fetch_assoc($req12);
	
	 $cr=$row1['code_cours'];

	

	?>
   <tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$cn?>" name="id" value="<?=$cn?>" onClick="document.adminMenu.boxchecked.value=<?=$cn?>" onmousedown="document.adminMenu.notefoupasf.value=<?php echo "'".$fStart."'";?>" /></td>
	 <td align="left"><a href="gestion_notes_morocco.php?code_cours=<?=$cc?>"><?=$cr?></a></td>
	 <td align="left">&nbsp;<?=trim($row['titre'])?></td>
	
    
   <td align="center">&nbsp;<?=$row['final_grade']?></td>
       <!-- <td align="center">&nbsp;<?=$row['final_grade']?></td>-->
	 <td align="center">&nbsp;<?=$row['letter_grade']?></td>
	 
    
   </tr>
   <?php
   }
   
  
   ?>
 </form>
    </table>
 
