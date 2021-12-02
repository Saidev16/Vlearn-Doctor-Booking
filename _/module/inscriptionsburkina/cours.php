<?php

		if( (isset($_GET['code_cours'])) && (!empty($_GET['code_cours'])) ){



		  $code_cours=$_SESSION['cours']=trim($_GET['code_cours']);
 		  $idSession=(int)$_SESSION['NidSession'];


		  $sql1="select session, annee_academique
				from $tbl_session where idSession=$idSession limit 1";


  		$req=@mysql_query($sql1) ;
  		$row=mysql_fetch_assoc($req);
   		$session = $row['session'];
  		$annee = $row['annee_academique'];

  		//get cours title

  		$sql2="select titre from $tbl_cours  where code_cours='$code_cours' limit 1";

  		$req=@mysql_query($sql2) or die ("erreur lors de la s�lection du titre du cours");
  		$row=mysql_fetch_assoc($req);
  		$titre=substr(stripslashes($row['titre']), 0, 65);


	?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/horraires.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Listing Registration
		<span class="sub_title">Course Title :<?=$titre?></span>

		<span class="sub_title">Session : <?=$session.'  '.$annee?></span>
	</td>
</table>
		<!--<td valign="top" align="center"><a href="gestion_inscription_burkina.php?new=oui">
		  <div class="ajouter"></div>Nouveau</a>
		  </td>
		  <td valign="top" align="center">
		  <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s�lectionner un �tudiant ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_inscription_burkina.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   "  >


		  <div class="modifier"></div>Modifier</a>
		  </td> -->
<form action="?supprimer" method="post" name="adminMenu">
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-success btn-sm"  href="gestion_inscription_burkina.php">Back</a>
        <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
    </div>
  </div>
  <input type="hidden" name="code_cours" value="<?php echo $_GET['code_cours']; ?>">

  <table class="table table-bordered" id="example" >
    <thead>
      <tr>
       <th width="15">#</th>
       <th width="15"></th>
       <th width="740">Name</th>
       <th width="175" align="center">Registration Date</th>
      </tr>
    </thead>
    <tbody>

      <?php
           $i=0;
           $sql="select e.code_inscription, concat(e.nom,' ', e.prenom) as name,
                i.id, i.date_inscription
                from tbl_inscription_cours_burkina as i, tbl_etudiant_burkina as e, $tbl_cours as c
               where
             i.code_cours='$code_cours'
             and i.code_inscription=e.code_inscription
             and i.code_cours= c.code_cours
             and i.idSession=$idSession
             and i.archive=0

             order by name";
             $res=@mysql_query($sql) or die ("erreur lors de la s�lection des cours");
             while ($row = mysql_fetch_array($res)) {
             $i++;
             $cn=$row["code_inscription"];
        ?>
          <tr>
           <td align="center"><?=$i?></td>
           <td align="center" width="25px">
                 <input type="checkbox" name="id[]" value="<?=$cn?>" />

           </td>
           <td align="left"><a href="gestion_inscription_burkina.php?code_inscription=<?=$cn?>">&nbsp;<?=ucfirst($row["name"])?></a></td>
           <td align="left"><?=$row["date_inscription"]?></td>
          </tr>
        <?php
              }
        ?>

    </tbody>
</table>
  </form>

<?php
}
?>

<script type="text/javascript">
$(document).ready(function() {

  $('#example').DataTable( {
  "paging": false
} );
  $('#example_1').DataTable();
} );
</script>
