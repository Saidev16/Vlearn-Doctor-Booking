<?php
if ( (isset($_GET['addProcessus'])) && (isset($_GET['id_user'])) ){
$id_menu=$_GET['addProcessus'];
$id_user=$_GET['id_user'];
$sql="insert into $tbl_menu_acces(id_user, id_menu) values('$id_user', '$id_menu')"; 
@mysql_query($sql) or die ('erreur activation ');
?>
<script language="javascript1.2">
window.location.replace('gestion_compte.php?processus=<?=$id_user?>');
</script>
<?php
}
?>
