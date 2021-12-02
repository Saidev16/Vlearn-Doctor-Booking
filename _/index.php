<?php session_start(); 
$_SESSION['admin_lang'] = 'eng';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
<meta http-equiv="Content-Type" content="html/css; charset=utf-8" />
<title>HIS ASL - Authentification</title>
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
<script language="javascript1.2" src="js/prototype.js" type="text/javascript"></script>
<script language="javascript1.2" src="js/forms.js" type="text/javascript"></script>
</head>
<body>
<?php require 'administrator/lang/translate.php'; ?>
<div align="center">
	<div id="container">
		<div id="header_intro">
			
		</div>
			<div id="autentification">
				<form name="frmEtu" action="traitement_etu.php" method="post" onsubmit=" return valider_etud();">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                         <tr>
                            <td align="center" valign="top" nowrap class="titre_grand"><?php echo translate('Student area');?>
                                <br /><span class="sous_titre">- <?php echo 'extranet_access';?> -</span> 
                            </td>
                         </tr>
                         <tr>
                
                            <td align="left" valign="top" class="txt_position">
                            <label for="login_etudiant"><?php echo 'login';?> :</label></td>
                        </tr>
                        <tr>
                           <td align="left" valign="top">
                                <input type="text" name="login_etudiant" id="login_etudiant" ></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" class="txt_position">
                          <label for="pass_etudiant"><?php echo 'password';?> :</label></td>
                        </tr>
                        <tr>
                           <td align="left" valign="top">
                                <input type="password" name="pass_etudiant" id="pass_etudiant">
                            </td>
                        </tr>
                        <tr>
                           <td align="left" valign="top">
                            <input type="submit" value="<?php echo translate('connexion');?>">
                            </td>
                        </tr>       
                        </tr>
                
                </table>
              </form> 
		<!-- <form name="frmEtu" action="traitement_etu_fr.php" method="post" onsubmit=" return valider_etud2();">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                         <tr>
                            <td align="center" valign="top" nowrap class="titre_grand"><?php echo translate('French Student area');?>
                                <br /><span class="sous_titre">- <?php echo translate('extranet_access');?> -</span> 
                            </td>
                         </tr>
                         <tr>
                
                            <td align="left" valign="top" class="txt_position">
                            <label for="login_etudiant"><?php echo translate('login');?> :</label></td>
                        </tr>
                        <tr>
                           <td align="left" valign="top">
                                <input type="text" name="login_etudiant" id="login_etudiant" ></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" class="txt_position">
                          <label for="pass_etudiant"><?php echo translate('password');?> :</label></td>
                        </tr>
                        <tr>
                           <td align="left" valign="top">
                                <input type="password" name="pass_etudiant" id="pass_etudiant">
                            </td>
                        </tr>
                        <tr>
                           <td align="left" valign="top">
                            <input type="submit" value="<?php echo translate('connexion');?>">
                            </td>
                        </tr>       
                        </tr>
                
                </table>
              </form>  -->                 
			  <form action="traitement_prof.php" method="post" name="frmProf" onSubmit="return valider_prof()">		
                  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                       <td align="center" valign="top" nowrap class="titre_grand"><?php echo translate('professor_area');?><br />
                      <span class="sous_titre">- <?php echo translate('extranet_access');?> -</span> </td>
                
                    </tr>
                    <tr>
                       <td align="left" valign="top" class="txt_position"><label for="login_prof"><?php echo translate('login');?> :</label></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top"><input type="text" name="login_prof" id="login_prof"  /></td>
                   </tr>
                   <tr>
                      <td align="left" valign="top" class="txt_position"><label for="pass_prof"><?php echo translate('password');?> :</label></td>
                   </tr>
                   <tr>
                      <td align="left" valign="top"><input type="password" name="pass_prof" id="pass_prof" /></td>
                   </tr>
                   <tr>
                     <td align="left" valign="top"><input type="submit" value="<?php echo translate('connexion');?>"  /></td>
                  </tr>
                
                </table>
</form>                          
</div>
<div id="actualite">
<!--<div id="titre"><span id="titre_page"><?php echo translate('news');?></span></div>-->
<?php
require 'administrator/config/config.php';
$sql="select * from $tbl_actualite where archive=22 and type = 'tous' order by date DESC LIMIT 0 , 5 ";
$req=@mysql_query($sql) or die ('Failure to select news');
if (mysql_num_rows($req)==0){
?>
<div id="no_data">The list is empty</div>
<?php
}
else{
?>
<table width="550" border="0" align="center" cellspacing="0" style="margin-top:10px" >
<?php
while($row=mysql_fetch_assoc($req)){
?>
 <tr class="entete">
    <th width="80%" align="left">&nbsp;<?php echo stripslashes(ucfirst($row['titre']))?></th>
    <th width="20%"><?php //echo $row['date']?></th>
  </tr>
  <tr>
    <td colspan="2" align="left"><?php echo html_entity_decode(stripslashes($row['contenu']))?></td>
  </tr>
 <tr>&nbsp;</tr>
 <tr>&nbsp;</tr>
 <tr>&nbsp;</tr>
  <tr>
    <td colspan="2" align="left"></td>
  </tr>

<?php
}
?>
</table>
<br/>
<br/>
<br/>
<br/>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<?php
}
?>
</div>
</div>
</div>
</body>
</html>
