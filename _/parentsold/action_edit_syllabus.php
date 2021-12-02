<?php
if (isset($_POST['boxchecked'])){
$code_syllabus=$_POST['boxchecked'];
$contenu=addslashes($_POST['contenu']);
$week=addslashes($_POST['week']);
$avancement=addslashes($_POST['avancement']);
$code_cours=$_POST['code_cours'];
$sql="UPDATE $tbl_syllabus SET `week` = '$week',
`contenu` = '$contenu',
`avancement` = '$avancement' 
WHERE `code_sylabus` ='$code_syllabus' limit 1";
 
@mysql_query($sql) or die("erreur lors de la modification du syllabus"); 
?>

<form name="retour" method="post">
	<input type="hidden" value="syllabus" name="task" />
	<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
 </form>
<script language="javascript1.2">
 document.retour.submit();
</script>
<?php
}
?>