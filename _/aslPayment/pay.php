<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");

require '../administrator/config/config.php';


if ($_GET['i'] > 0 && $_GET['tt'] > 0){
    $id = $_GET['i'];
    $tt = $_GET['tt'];
    $sql2 = "SELECT id,ttc FROM `aslPayment` WHERE id = $id and tt = $tt";
    $req2 = @mysql_query($sql2) ;
    
    if (! $req2){
            die('Database error: ' . mysql_error());
    }
    
    
    $row2 = mysql_fetch_assoc($req2);
    $ttc = $row2['ttc'];
    if ($ttc != null){
        header("Location: https://americanhigh.us/tuition/processing.php?price=$tt");
        exit();
    }else{
        header("Location: https://americanhigh.us");
        exit();
    }
}else{
        header("Location: https://americanhigh.us");
        exit();
    }