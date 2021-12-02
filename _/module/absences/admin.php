<?php
        $where=$code_cours=$search_student_absence='';
        
 	   if((isset($_POST['code_cours'])) && (!empty($_POST['code_cours'])) ){
 	   $code_cours = trim($_POST['code_cours']);
 	   ?>
	   <script language="javascript1.2">
		    <!--
			   window.location.replace("gestion_absences.php?code_cours=<?=$code_cours?>");
		   -->	   
		</script>
	   <?php
 	   }
	   
	   if(isset($_POST['tous']) && $_POST['tous']=='tous'){
			   $where=$search_student_absence=$idSession='';
			   unset($_SESSION['search_student_absence']);
	   														}
																	

		
  	   else{
	   
	           if(isset($_POST['search_student_absence']) && !empty($_POST['search_student_absence'])){
					$search_student_absence = $_SESSION['search_student_absence'] = addslashes(trim($_POST['search_student_absence']));
					$where =" and  e.nom like '%".$search_student_absence."%' or e.prenom like '%".$search_student_absence."%'";
																									  }
			 
			elseif(isset($_SESSION['search_student_absence']) && !empty($_SESSION['search_student_absence']) ){
				$search_student_absence = addslashes(trim($_SESSION['search_student_absence']));
				$where =" and  e.nom like '%".$search_student_absence."%' or e.prenom like '%".$search_student_absence."%'";
				 
																										      }

                   //session comme crit�re 

				  if( (isset($_POST['idSession'])) && (!empty($_POST['idSession'])) ){
 					 $idSession = $_SESSION['idSession'] = $_POST['idSession'];
  	                 $where.=  " and a.idSession='". $idSession."'";
					                                                                 }
  																				  

					  else if( (isset($_SESSION['idSession'])) && ($_SESSION['idSession']!='') ){
					  			$idSession=$_SESSION['idSession'];
  	                            $where.=  " and a.idSession='".$idSession."'";  
 						                                                   						}
                         else{
						 		$_SESSION['idSession']=$idSession;
                                $where.=  " and a.idSession='".$idSession."'" ; 
                             }
  	      }

		  
			
		
                      
		  $sql1="select idSession, session, annee_academique 
				from $tbl_session where idSession='$idSession' limit 1";
				
				
		$req=@mysql_query($sql1) ;
		$row=mysql_fetch_assoc($req);
		$idSession=$_SESSION['idSession']=$row['idSession'];
		$session = $row['session'];
		$annee = $row['annee_academique'];

 ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/absence.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES ABSENCES  
	&nbsp;&nbsp;<span class="task">[<?=$session.' '.$annee?>]</span>
	</td>
	<td width="22%">
      <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>


		  <td valign="top" align="center" >
		   <a href="gestion_absences.php?new"><div class="ajouter"></div> Ajouter</a>
		  </td>

		</tr>

	  </table>
	</td> 
	
  </tr>
</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist" >

<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />

<div class="container_search">
    <select name="idSession" class="search" >
 <?php 
     $sql1="select idSession, session, annee_academique from $tbl_session where archive = 1";
	 $req1=mysql_query($sql1) or die("erreur lors de la selection des sessions");
	 while ($row=mysql_fetch_assoc($req1)){
	 $cs=$row['idSession'];
	 $ns=$row['session'].' '.$row['annee_academique'];
	 ?>
	 <option value="<?=$cs?>" <?=($idSession==$cs) ? $selected : '' ?>><?=$ns?></option>
	 <?php
	 }
	 ?>
 </select>
     <select name="code_cours" class="search"  style="width:450px" >
 <option value="0">&nbsp;TITRE DU COURS</option>
 <?php 
     $sql2="select distinct code_cours, titre_eng from $tbl_cours where archive=0 and 
	 code_cours in (select distinct code_cours from $tbl_absence where idSession='$idSession') ";
 	 $req=mysql_query($sql2) or die("erreur lors de la selection des titres");
	 while ($row=mysql_fetch_assoc($req)){
	 $cc=$row['code_cours'];
	 $nc=strtoupper($row['titre_eng']);
	 ?>
	 <option value="<?=$cc?>"><?=$cc.':'.$nc?></option>
 <?php
 }
 ?>
 </select>
           <input type="text" class="input" name="search_student_absence" style="width:125px" value="<?php echo $search_student_absence?>" />
           <input type="submit" name="valider" value="valider" class="input"/>
		   <input type="submit" value="tous" name="tous" class="input"  />&nbsp;
  </div>

  <tr align="center">
     <th width="15">#</th>
	 <th width="100">code</th>
	 <th width="300">Nom et pr&eacute;nom</th> 
	 <th width="200">Absences comptabilis&eacute;</th> 
	 <th width="200">Absences non comptabilis&eacute;</th>
	 <th width="75">Nombre</th>    
  </tr>
       <?php
       $i=$j=$k=$l=0;
 	   $sql="SELECT e.code_inscription, concat(nom, ' ', prenom) AS name, e.code_inscription, 
	   sum(n_comptabilise) as n_comptabilise, sum(n_incomptabilise) as n_incomptabilise  
	   FROM $tbl_etudiant  as e, $tbl_absence as a
	   WHERE e.code_inscription = a.code_inscription 
	   AND a.idSession='$idSession'
	   AND a.archive = 0 " . $where ."
	   GROUP BY a.code_inscription ORDER BY name"; 
       $req=@mysql_query($sql) or die ('erreur lors de la selection des étudiants');
   	   while ($row = mysql_fetch_assoc($req)) {
	   $i++;
	   $ci = $row['code_inscription'];
	  
	   $j+=$row['n_comptabilise'];
	   $k+=$row['n_incomptabilise'];
      ?>
<tr>
     <td align="center" width="15px"><?=$i?></td>
	 <td align="left"><a href="gestion_absences.php?code_inscription=<?=$ci?>&idSession=<?=isset($_POST['idSession'])? $_POST['idSession'] : $idSession?>">&nbsp;<?=$ci?></a></td>
	 <td align="left">&nbsp;<?=ucfirst($row["name"])?></td>
	 <td align="center">&nbsp;<?=$row['n_comptabilise']?></td>
	 <td align="center">&nbsp;<?=$row['n_incomptabilise'] ?></td>
	 <td align="center">&nbsp;<?=$row['n_comptabilise']+$row['n_incomptabilise']?></td>
  </tr>

<?php
      }
?>
</form>
<tr>
	<td colspan="3" class="gras">Nombre d'&eacute;tudiants qui ont des absences dans cette session : <?=$i?></td>
	<td align="center"><?=$j?></td>
	<td align="center"><?=$k?></td>
	<td align="center"><?=$j+$k?></td>
</tr>
 </table>
