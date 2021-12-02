<?php

  $id=$_GET["supprimer"];
  $sql="select code_prof from tbl_heure where id = $id";  
  $req= @mysql_query($sql);
  $row=mysql_fetch_assoc($req); 
  $code_prof= $row['code_prof'];
   $sql="DELETE FROM tbl_heure  WHERE id  = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to delete hour");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_heures.php?code_prof=<?php echo $code_prof; ?>');
//-->
</script>



