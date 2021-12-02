<?php
 $year=$_GET['alumni'];
 $year1=$year+1;

 $where =" ";

$date11=$year.'-09-01';
  $date22=$year1.'-08-31';




    $sql = " SELECT concat(e.nom, ' ' ,e.prenom)as name,date_inscription,e.prefixe,code_inscription ,graduation_date FROM tbl_etudiant_all as e WHERE   graduation_date  BETWEEN '$date11' AND '$date22'";





?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td class="titre" width="78%"><?php echo 'Listing Students'; ?></td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="right">
		   <a href="Statistiques.php"><div class="cancel"></div><?php echo 'cancel';?></a>
		  </td>
		</tr>

	  </table>

	</td>

  </tr>

 </table>


 <table width="100%" align="center" cellspacing="1"  class="adminlist" style="margin-top:2px">

 <form action="#" method="post" name="adminMenu" >
   <div class="container_search">


		   <input type="checkbox" class="input" name="export" value="1" style="width: 15px;margin-left: 5px;"> Export
	      <input type="submit" vname="Applay" value="submit">
        <?php if (isset($_POST['export']) && $_POST['export'] == 1) { ?>
  			 <a href="statistics.xls" target="_blank">Download</a>
  		 <?php } ?>
    </div>
       <tr align="center">
 <th width="43">#</th>

		 <th width="100"><?php echo 'Code'; ?></th>
		 <th width="272"><?php echo 'Name'; ?></th>

		<!-- <th width="166"><?php echo 'Registration date'; ?></th>-->
		  <th width="166"><?php echo 'Completion Date'; ?></th>

   </tr>

	  <?php
		 $i=0;
		 $total = @mysql_query($sql) or die("Failure to select students");
		 $url = $_SERVER['PHP_SELF']."?alumni=".$year."&niveau=".$niveau."&limit=";
		 $nblignes = mysql_num_rows($total);
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);
		 while ($ligne = mysql_fetch_assoc($result)) {
		 $i++;
		 $etud=$ligne["prefixe"].$ligne["code_inscription"];
		 $ci=$ligne["code_inscription"];
		   ?>

 <td align="center">&nbsp;<?=$i?>
		 <td align="left" >&nbsp;<?=$etud?></td>
		 <td>&nbsp;<?=stripslashes(ucfirst($ligne["name"]))?></td>

	<!--	 <td>&nbsp;<?php

		$date=$ligne["date_inscription"];

		$tab=split('[/.-]',$date);
		echo $tab[1].'-'.$tab[2].'-'.$tab[0];//echo $row['date_paiement']; ?>-->
		<td>&nbsp;<?php

		$date=$ligne["graduation_date"];

		$tab=split('[/.-]',$date);
		echo $tab[1].'-'.$tab[0];//echo $row['date_paiement']; ?>
		</td>
		</tr>
		<?php
		  }
		 ?>

	 </form>

	 </table>
	 <div id='pagination' align='center'>
         <?php
           echo pagination($url,$parpage,$nblignes,$nbpages);

     	 ?>
		    </div>
        <?php
        if (isset($_POST['export']) && $_POST['export'] == 1) {

          $data_exported = array();
          $i=0;
          $data_exported[$i] = array("code","name","registration date","Graduation date");
          while ($ligne = mysql_fetch_assoc($total)) {
            $i++;
            $etud=$ligne["prefixe"].$ligne["code_inscription"];
       		  $ci=$ligne["code_inscription"];

            // export
            $name = stripslashes(ucfirst($ligne["name"]));
            $date=$ligne["date_inscription"];
            $tab=split('[/.-]',$date);
            $date = $tab[1].'-'.$tab[2].'-'.$tab[0];
            $data_exported[$i][] = $etud;
            $data_exported[$i][] = $name;
            $data_exported[$i][] = $date;
            $date=$ligne["graduation_date"];

        		$tab=split('[/.-]',$date);
        		$date= $tab[1].'-'.$tab[0];
            $data_exported[$i][] = $date;
          }


          $excel = new ExportDataExcel('file');
          $excel->filename = "statistics.xls";

          $excel->initialize();
          foreach ($data_exported as $row) {
            $excel->addRow($row);
          }
          $excel->finalize();


        }



         ?>
