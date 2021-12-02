<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/classes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Advising/Resolutions </td>
	<td width="22%">
	  <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner une demande dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_demande.php?repondre='+chemin;

				     window.location.replace(chemin);

				   }

				   " > <div class="modifier"></div>Answer</a>
		  </td>

		    <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner une demande dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_demande.php?supprimer='+chemin;

				     window.location.replace(chemin);

				   }

				   " > <div class="modifier"></div>Delete</a>
		  </td>
		<!-- <td valign="top" align="center" width="90">
		   <a href="gestion_demande.php?supprimer=oui"><div class="delete"></div>Delete</a>
		  </td>-->
		</tr>
	  </table>
	</td> 
  </tr>
</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<div class="container_search">
  <select name="objet" class="search" onchange="document.adminMenu.submit()"> 
		 <option value="0">OBJECT</option>
 <?php 

     $sql1="select objet  from tbl_demande where objet!='' and archive= 0 group by objet";
	 $req1=@mysql_query($sql1) or die("erreur lors de la sélection des objets");
	 while ($row = mysql_fetch_assoc($req1)){
	 ?>
	 <option value="<?=stripslashes($row['objet'])?>"><?=$row['objet']?></option>
	 <?php
	 }
	 ?>
 </select>

 <select name="code_inscription" class="search" onchange="document.adminMenu.submit()">
<option value="0">STUDENT</option>
 <?php 
    echo $sql2="select d.code_inscription, concat(e.nom,' ', e.prenom ) as name 
	 from tbl_demande as d, tbl_etudiant_all as e 
	 where trim(d.code_inscription)=trim(e.code_inscription) and e.prefixe=d.prefixe
	 and  d.archive= 0 group by name";
	 $req2=@mysql_query($sql2) or die("erreur lors de la sélection des étudiants");
	 while ($row = mysql_fetch_assoc($req2)){
	 ?>
	 <option value="<?=$row['code_inscription']?>"><?=htmlentities($row['name'])?></option>
 <?php
 }
 ?>

 </select>
<!--
 <select name="code_prof" class="search" onchange="document.adminMenu.submit()"> 
 <option value="0">PROFESSEUR</option>
 <?php 
     $sql1="select d.code_prof, p.nom_prenom  from tbl_demande as d, 
	 tbl_professeur as p where d.code_prof=p.code_prof and d.archive= 0 group by nom_prenom";
	 $req1=@mysql_query($sql1) or die("erreur lors de la sélection des enseignants");
	 while ($row = mysql_fetch_assoc($req1)){
	 ?>
	 <option value="<?=$row['code_prof']?>"><?=$row['nom_prenom']?></option>
 <?php
 }
 ?>
 </select>
-->
   <input type="submit" value="All" name="tous" class="input"  />
  </div>

  <tr>
     <th width="10">#</th>
	 <th width="15"></th>
	 <th width="150">Name</th>
	 <th width="100">Subject</th>
	 <th width="100">Date</th>
	 <th width="200">Request</th>
	 <th width="200">Resolution</th>
	 <th width="75">Date</th>
	 <th width="75">Administrator</th>
	<!-- <th width="75">Attachement</th>-->
  </tr>

     <?php
 	  if( (isset($_POST['objet'])) && (!empty($_POST['objet'])) ){
	  $objet=addslashes($_POST['objet']);
	  $sql="SELECT * from tbl_demande where objet like '%$objet%' and  archive = 0 
	  order by date_requette desc ";
	 }

	  else if( (isset($_POST['code_inscription'])) && (!empty($_POST['code_inscription'])) ){
	  $code_inscription=$_POST['code_inscription'];
	  $sql="SELECT * from tbl_demande where code_inscription='$code_inscription' 
	  and  archive = 0 order by date_requette desc";
	 }

	 else if( (isset($_POST['code_prof'])) && (!empty($_POST['code_prof'])) ){
	  $code_prof=$_POST['code_prof'];
	  $sql="SELECT * from tbl_demande where code_prof='$code_prof' and  archive = 0 
	  order by date_requette desc";
	 }

	 else{
	 $sql="SELECT * from tbl_demande where archive = 0 order by date_requette desc";
	  }

      $i=0;

     $total = @mysql_query($sql) or die("erreur lors de la sélection des requettes"); 
	 $url = $_SERVER['PHP_SELF']."?limit=";
     $nblignes = mysql_num_rows($total);
	 $parpage=10;
     $nbpages = ceil($nblignes/$parpage);
     $result = validlimit($nblignes,$parpage,$sql);
 	 while ($ligne = mysql_fetch_array($result)) {
	 $i++;
	 $cc=$ligne["code_demande"];
	    if($ligne["fichier"]!=''){
	    $link=$_SERVER['REMOTE_ADDR']."/ilcs/module/demande/fichier/";
		$link="<a href=\"".$link.htmlentities($ligne["fichier"])."\">[Télécharger]</a>";
	 		}
		else{
		$link='-';
			}
      ?>

<tr style="vertical-align:top">

     <td>&nbsp;<?=$i?></td>
	 <td width="20px"><input type="radio" id="<?=$cc?>" name="id" value="<?=$cc?>" 
	 onClick="document.adminMenu.boxchecked.value=<?=$cc?>" /></td>
	 <td>&nbsp;<?=htmlentities($ligne["nom_prenom"])?></td>
	 <td>&nbsp;<?=htmlentities($ligne["objet"])?></td>
	 <td>&nbsp;<?php $date=$ligne["date_requette"];
		$tab=split('[/.-]',$date); 
		echo $tab[1].'-'.$tab[2].'-'.$tab[0]; ?></td>
	 <td id="hack">&nbsp;<?=html_entity_decode(stripslashes($ligne["explication"]))?></td>
	 <td id="hack">&nbsp;<?=html_entity_decode(stripslashes($ligne["reponse"]))?></td>
	 <td>&nbsp;<?php $date1=$ligne["reponse_date_time"];
		$tab=split('[/.-]',$date1); 
		echo $tab[1].'-'.$tab[2].'-'.$tab[0];?></td>
	 <td>&nbsp;<?=htmlentities($ligne["reponse_auteur"])?></td>
<!--	 <td align="center">&nbsp;<?=$link?></td>-->
	  </tr>
	<?php
		  }
	?>
 	</form>
 	</table>
     <?php
     echo "<div id='pagination' align='center'>";
     echo pagination($url,$parpage,$nblignes,$nbpages);
     echo "</div>";
	 ?>

