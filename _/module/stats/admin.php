<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES STATISTIQUES</td>
	<td width="22%">&nbsp;</td> 
  </tr>
</table>
<table width="100%" align="center" cellspacing="1" class="adminlist" style="text-align:center" >
	<tr align="center">
    	<th>Semestre</th>
        <th>Spring 2008 </th>
        <th>Fall 2008</th>
        <th>Spring 2009 </th>
        <th>Fall 2009</th>
        <th>Spring 2010</th>
    </tr>
    <?php
	$s08=$f08=$s09=$f09=$s10=0;
	$sql = "SELECT DISTINCT code_inscription, idSession
			FROM tbl_note
			WHERE gpa IS NOT NULL
			AND gpa < 1
			AND idSession IN ( 7, 12, 10, 14, 13 )";
	$req = @mysql_query($sql);
	while ($row = mysql_fetch_assoc($req)){
		if ($row['idSession']==7) $s08+=1;
			elseif ($row['idSession']==12) $f08+=1;
				elseif ($row['idSession']==10) $s09+=1;
					elseif ($row['idSession']==14) $f09+=1;
						elseif ($row['idSession']==13) $s10+=1;
										  }
	?>
    <tr>
    	<td align="center">Moins de 1</td>
        <td><?php echo $s08; ?></td>
        <td><?php echo $f08; ?></td>
        <td><?php echo $s09; ?></td>
        <td><?php echo $f09; ?></td>
        <td><?php echo $s10; ?></td>
    </tr>
    <?php
	$s08=$f08=$s09=$f09=$s10=0;
	$sql1 = "SELECT DISTINCT code_inscription, idSession
			FROM tbl_note
			WHERE gpa IS NOT NULL
			AND gpa BETWEEN  1 AND 2
			AND idSession IN ( 7, 12, 10, 14, 13 )";
	$req1 = @mysql_query($sql1);
	while ($row = mysql_fetch_assoc($req1)){
		if ($row['idSession']==7) $s08+=1;
			elseif ($row['idSession']==12) $f08+=1;
				elseif ($row['idSession']==10) $s09+=1;
					elseif ($row['idSession']==14) $f09+=1;
						elseif ($row['idSession']==13) $s10+=1;
										  }
	?>
    <tr>
    	<td align="center">Entre 1-2</td>
        <td><?php echo $s08; ?></td>
        <td><?php echo $f08; ?></td>
        <td><?php echo $s09; ?></td>
        <td><?php echo $f09; ?></td>
        <td><?php echo $s10; ?></td>
    </tr>
    <?php
	$s08=$f08=$s09=$f09=$s10=0;
	$sql2 = "SELECT DISTINCT code_inscription, idSession
			FROM tbl_note
			WHERE gpa IS NOT NULL
			AND gpa BETWEEN  2 AND 3
			AND idSession IN ( 7, 12, 10, 14, 13 )";
	$req2 = @mysql_query($sql2);
	while ($row = mysql_fetch_assoc($req2)){
		if ($row['idSession']==7) $s08+=1;
			elseif ($row['idSession']==12) $f08+=1;
				elseif ($row['idSession']==10) $s09+=1;
					elseif ($row['idSession']==14) $f09+=1;
						elseif ($row['idSession']==13) $s10+=1;
										  }
	?>
    <tr>
    	<td align="center">Entre 2-3</td>
        <td><?php echo $s08; ?></td>
        <td><?php echo $f08; ?></td>
        <td><?php echo $s09; ?></td>
        <td><?php echo $f09; ?></td>
        <td><?php echo $s10; ?></td>
    </tr>
         <?php
	$s08=$f08=$s09=$f09=$s10=0;
	$sql3 = "SELECT DISTINCT code_inscription, idSession
			FROM tbl_note
			WHERE gpa IS NOT NULL
			AND gpa BETWEEN  3 AND 4
			AND idSession IN ( 7, 12, 10, 14, 13 )";
	$req3 = @mysql_query($sql3);
	while ($row = mysql_fetch_assoc($req3)){
		if ($row['idSession']==7) $s08+=1;
			elseif ($row['idSession']==12) $f08+=1;
				elseif ($row['idSession']==10) $s09+=1;
					elseif ($row['idSession']==14) $f09+=1;
						elseif ($row['idSession']==13) $s10+=1;
										  }
	?>
    <tr>
    	<td align="center">Entre 3-4</td>
        <td><?php echo $s08; ?></td>
        <td><?php echo $f08; ?></td>
        <td><?php echo $s09; ?></td>
        <td><?php echo $f09; ?></td>
        <td><?php echo $s10; ?></td>
    </tr>
</table>