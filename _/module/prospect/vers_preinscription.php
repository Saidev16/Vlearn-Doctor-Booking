<style type="text/css">
input{width:200px;}
</style>
<?php


			  $code_inscription = $_GET["preinscri"];
			  
			  $sql2="select * from tbl_prospect  
			  where code_inscription='$code_inscription' limit 1 ";
			  $req2=@mysql_query($sql2) or die("erreur lors du chargements  des données");
			  $row=mysql_fetch_assoc($req2);
			  
			   $code_inscription = $row['code_inscription'];
			  
			   $nom = htmlentities($row['nom']);
			   $prenom = htmlentities($row['prenom']);
			   $date_inscription = htmlentities($row['date_inscription']);
			   $tel = htmlentities($row['tel']);
			   $email =htmlentities($row['email']);
			   $niveau = htmlentities($row['niveau']);
			   $ville = htmlentities($row['ville']);
			   $observation = htmlentities($row['observation']);
			   $groupe = htmlentities($row['groupe']);
			  
			   
			    $sql="insert into tbl_preinscrit (`code_inscription`,`nom`,`prenom`,`date_inscription`,`tel`,`email`,`groupe`,`niveau`,`ville`)
				 values('$code_inscription','$nom','$prenom','$date_inscription','$tel','$email','$groupe','$niveau','$ville');";

             @mysql_query($sql) or die ("erreur lors de l' ajout dans la table preinscrit");
			 
			  ?>
 <style type="text/css">
input{
width:230px;
}
</style>


 
       