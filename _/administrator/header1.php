<style type="text/css">
#nav {
width:128px;
background: #94B050;
margin:0;
padding:0;
}
#nav ul{
list-style:none;
margin:O;
padding:2px;
}
#nav ul a{
color:#000;
font-size:11px;
text-decoration:none;
}
#nav li{
	padding-left: 3px;
	cursor: pointer;
	margin:0;
}
#nav li a{
	font-size:11px;
	color:#fff;
	text-decoration:none;
	text-transform:lowercase;
}
#nav a:visited{
	font-size:11px;
}
</style>
<script language="javascript1.2">
function mouseover(){
alert('over');
}
function mouseout(){
alert('out');
}
</script>
    <div id="nav"> 
		<?php
$id_user=(int)$_SESSION['id_user'];
require_once 'config/config.php';
$primarymenu="select m.id, m.titre, m.link 
from tbl_menu as m, tbl_menu_acces as ma where 
m.type='staf' 
and m.parent=0 
and m.publie=0 
and archive=0
and m.id=ma.id_menu
and id_user=$id_user
order by ordre";
$req=mysql_query($primarymenu) or die ('erreur lors de la création du menu ');
$table=array();
while($row=mysql_fetch_assoc($req)){
$link=$row['link'];
$titre=$row['titre'];
$element=$row['id'];
?>
<ul id="<?=$element?>" >
<a href="<?=$link?>">&raquo;&nbsp;<?=$titre?></a>
<?php
$secondmenu="select id, titre, link 
from tbl_menu 
where type='staf' 
and parent!=0 
and publie=0 
and archive=0
and parent=$element
order by ordre ";
$reqsecondmenu=mysql_query($secondmenu) or die('erreur');
if(mysql_num_rows($reqsecondmenu)){
while($row=mysql_fetch_assoc($reqsecondmenu)){
?>
<li><a href="<?=$row['link']?>">&raquo;&nbsp;<?=$row['titre']?></a></li>
<?php
}
echo '</ul>';
}

}
?>

</div>