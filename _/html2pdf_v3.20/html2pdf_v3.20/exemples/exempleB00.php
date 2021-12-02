<?php
 
/**
 * Logiciel : exemple d'utilisation de HTML2PDF
 * 
 * Convertisseur HTML => PDF, utilise fpdf de Olivier PLATHEY 
 * Distribué sous la licence GPL. 
 *
 * @author		Laurent MINGUET <webmaster@spipu.net>
 * 
 * isset($_GET['vuehtml']) n'est pas obligatoire
 * il permet juste d'afficher le résultat au format HTML
 * si le paramètre 'vuehtml' est passé en paramètre _GET
 */
 	// récupération du contenu HTML
 	ob_start();
 	include(dirname(__FILE__).'/res/exempleB00.php');
	$content = ob_get_clean();
	
	// conversion HTML => PDF
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
	$html2pdf = new HTML2PDF('P','A4','fr');
	//$html2pdf->AddPage();
	$html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
	//echo  $content;
	$html2pdf->Output('transcript.pdf');
	
	//echo "<br>vuehtml=".$_GET['vuehtml'];

/*
require("html2fpdf.php"); 
$htmlFile = "http://www.dancrintea.ro"; 
$buffer = file_get_contents($htmlFile); 
$pdf = new HTML2FPDF('P', 'mm', 'Letter'); 
$pdf->AddPage(); 
$pdf->WriteHTML($buffer); 
$pdf->Output('test.pdf', 'F');
*/


?>
