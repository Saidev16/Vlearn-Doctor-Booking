<?php  
$sqlm="select nom, link from tbl_item_menu where type='enseignant' and publie=1  and archive=1 order by ordre";
$req=@mysql_query($sqlm) or die ("erreur lors de génération du menu");
while($row=mysql_fetch_assoc($req)){
echo"<span class=\"item_menu\"><a href=\"".$row['link']."\">".$row['nom']."</a></span>";
}
?>
