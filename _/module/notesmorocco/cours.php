<?php
    $idSession=$_SESSION['IidSession'];
    $code_cours=trim($_GET['code_cours']);
    $code_inscription=$_SESSION['code_inscription'];
    $idSession= isset($_POST['idSession']) ?  $_POST['idSession'] = $_SESSION['IidSession'] : $_SESSION['IidSession'];

	$sql_notes="SELECT concat(e.nom,' ', e.prenom) as name, n.* FROM
     $tbl_etudiant as e, $tbl_note as n where
	 n.code_cours='$code_cours'
	 and e.code_inscription = n.code_inscription
     and n.idSession = '$idSession'
	 order by name "; 
      //show the session 
		
                      
		$sql1="select idSession, session, annee_academique from $tbl_session where idSession=$idSession limit 1";
				
		$req=@mysql_query($sql1) ;
		$row=mysql_fetch_assoc($req);
		$idSession=$_SESSION['IidSession']=$row['idSession'];
		$session = $row['session'];
		$annee = $row['annee_academique'];
	 
	 
	
 			$i = 0;
 		?>   

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" >

  <tr>

    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>

    <td width="78%" class="titre"><?php echo translate('select_session'); ?> 
		<span class="sub_title"><?php echo translate('title'); ?> :<?=$titre?></span>
	    <span class="sub_title"><?php echo translate('professor'); ?> :<?=$nom?></span>
		<span class="sub_title"><?php echo translate('session'); ?> :<?=ucfirst($session).' '.$annee?></span>
	</td>

	<td width="22%">

	  <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		  <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Please select a student in the list');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_notes.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   " > 

		  <div class="modifier"></div><?php echo translate('edit'); ?></a>

	      		  </td>
		  <td valign="top" align="center" >
		  <a href="#" onclick="window.print()" title="Imprimer">
		  <div class="imprimer"></div><?php echo translate('print'); ?></a>
		  </td>

		  <td valign="top" align="center" width="90">
		   <a href="gestion_notes.php<?=($code_inscription!='') ? '?code_inscription='.$code_inscription : ''?>">
		  <div class="retour"></div><?php echo translate('back'); ?></a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
<table width="100%" align="center" cellspacing="1" border="0"  class="adminlist" >

<form action="#" method="post" name="adminMenu">

<input type="hidden" name="boxchecked" value="0" />
     <div class="container_search">
	 <select name="idSession" class="search">
  
 <?php 
     $sql2="SELECT idSession, session, annee_academique FROM $tbl_session ";
 	 $req=mysql_query($sql2) or die("erreur lors de la sélection des années academique");
 	 while ($row=mysql_fetch_assoc($req)){
	 $cs=$row['idSession'];
	 $ns=$row['session'].' '.$row['annee_academique']
	 ?>
	 <option value="<?=$cs?>" <?=($idSession==$cs) ? $selected : '' ?>><?=$ns?></option>
 <?php
 }
 ?>
 </select>
 <input type="submit" value="<?php echo translate('submit'); ?>" />
 </div>
  <tr>
     <th align="center" width="10px">#</th>
	 <th width="10">&nbsp;</th>
	 <th width="65">Code</th>
	 <th width="400"><?php echo translate('title'); ?></th>
     <th width="75"><?php echo translate('mid_term'); ?></th>
	 <th width="75"><?php echo translate('project'); ?></th>
     <th width="75"><?php echo translate('participation'); ?></th>
     <th width="75"><?php echo translate('final_exam'); ?></th>
     <th width="75"><?php echo translate('final_grade'); ?></th>
	 <th width="75"><?php echo translate('letter_grade'); ?></th>
	 <th width="75"><?php echo translate('performance_designation'); ?></th>
   </tr>
  <?php
       $req = @mysql_query($sql_notes) or die("Failure to select marks"); 
  	  while ($row = mysql_fetch_array($req)) {
  				 $i++;
 ?>

<tr>

     <td align="center"><?=$i?></td>

	 <td align="center"><input type="radio" id="<?=$row['code_note']?>" name="id" value="<?=$row['code_note']?>" onClick="document.adminMenu.boxchecked.value=<?=$row['code_note']?>" /></td>
 	 <td align="left"><a href="gestion_notes.php?code_inscription=<?=$row['code_inscription']?>"><?=$row['code_inscription']?></a></td>
	 <td align="left">&nbsp;<?=ucfirst($row['name'])?></td>
     <td align="center">&nbsp;<?=$row['mid_term']?></td>
     <td align="center">&nbsp;<?=$row['project']?></td>
      <td align="center">&nbsp;<?=$row['participation']?></td>
     <td align="center">&nbsp;<?=$row['final_exam']?></td>
     <td align="center">&nbsp;<?=$row['final_grade']?></td>
	 <td align="center">&nbsp;<?=$row['letter_grade']?></td>
	 <td align="center"><?=$row['performance_designation']?></td>
 	  </tr>
		<?php
         }
	  	?>

		 
</form>

 </table>
