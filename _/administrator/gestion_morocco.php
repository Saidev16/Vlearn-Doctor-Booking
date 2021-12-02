<?php require 'secure.php';?>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Administration</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<script language="javascript1.2" src="script/prototype.js"></script>
</head>
<body>
<div align="center">
<div id="container">
			<?php require 'includes/main_menu.php'; ?>
	<div id="banner">
		Login :<?=(isset($_SESSION['admin_login'])) ? $_SESSION['admin_login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;<br><a href="deconexion.php">Logout</a>&nbsp;&nbsp;&nbsp;
	</div>
        <table width="100%" class="adminlist">
        <?php
		$id_user = $_SESSION['admin_id_user'];
        $query="SELECT * FROM $tbl_admin_menu 
		WHERE type='international' and publish = 1 AND  id IN (SELECT id_menu FROM $tbl_menu_acces WHERE id_user = '$id_user') 
		ORDER BY ordering"; 
        $ressource=@mysql_query($query) or die('unable to load menu items');
        $i=0;
        while($row=mysql_fetch_assoc($ressource)){
          if($i==4){ 
            echo '</tr><tr>';
            $i=0;   
                  }
                  $i++;
        ?>
        <td align="center" width="25%" height="50">
        	<a href="<?php echo $row['link'];?>?Itemid=<?php echo $row['id'];?>"><?php echo ucfirst($row['titre']);?></a>
        </td>
        <?php
        }
        ?>
        </table>
</div>
</div>
  
</body>

</html>