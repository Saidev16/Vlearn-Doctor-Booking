<table width="100%" cellpadding="0" cellspacing="1" class="adminlist" style="text-transform:uppercase">
	<tr>
<?php
$id_user = $_SESSION['admin_id_user'];
$query="SELECT * FROM $tbl_admin_menu WHERE publish = 1 AND in_topmeu = 1 AND id IN (SELECT id_menu FROM $tbl_menu_acces WHERE id_user = '$id_user') ORDER BY ordering";
$ressource=@mysql_query($query) or die('Unable to load menu items');
while($row=mysql_fetch_assoc($ressource)){
?>
<td align="center"><a href="<?php echo $row['link'];?>?Itemid=<?php echo $row['id'];?>"><?php echo $row['titre'];?></a></td>
<?php
}
?>
	</tr>
</table>