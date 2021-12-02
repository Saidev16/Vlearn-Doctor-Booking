<?php
 if (isset($_GET['dropProcessus'])){ 
$id_menu=$_GET['dropProcessus'];
$id_user=$_GET['id_user'];
$sql="delete from $tbl_menu_acces  
where id_user='$id_user'
and  id_menu='$id_menu' limit 1"; 
@mysql_query($sql) or die('erreur suppression processus');
?>
<script language="javascript1.2">
window.location.replace('gestion_compte.php?processus=<?=$id_user?>');
</script>
<?php
}
?>
