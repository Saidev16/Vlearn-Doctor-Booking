<?php require './config/config.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PIIMT - Statistique</title>

		
		<!-- 1. Add these JavaScript inclusions in the head of your page -->
		<script type="text/javascript" src="./js/jquery.min.js"></script>
		<script type="text/javascript" src="./js/highcharts.js"></script>
		
<script type="text/javascript">
var chart;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'container1',
         defaultSeriesType: 'line',
         marginRight: 130,
         marginBottom: 25
      },
      title: {
         text: 'Rate of Scholarships/Students',
         x: -20 //center
      },
      subtitle: {
         text: '',
         x: -20
      },
      xAxis: {
         categories: ['F:06/07', 'S:06/07', 'F:07/08', 'S:07/08', 'F:08/09', 'S:08/09','F:09/10', 'S:09/10' ]
      },
      yAxis: {
         title: {
            text: ''
         },
         plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
         }]
      },
      tooltip: {
         formatter: function() {
                   return '<b>'+ this.series.name +'</b><br/>'+
               this.x +': '+ this.y ;
         }
      },
      legend: {
         layout: 'horizontal',
         align: 'right',
         verticalAlign: 'top',
         x: 10,
         y: 100,
         borderWidth: 0
      },
      series: [{
         name: 'Undergraduates',
         data: [3, 0, 5, 1, 7, 4, 20, 2]
      }, {
         name: 'Graduates',
         data: [1, 0, 2, 0, 1, 0, 5, 1]
      }, {
         name: 'repeat Scholarships',
         data: [0, 0, 3, 0, 5, 0, 4, 0]
      }, {
         name: 'Free interest monthly financing',
         data: [0, 0, 6, 0, 10, 2, 35, 3]
      }]
   });
   
   
});
</script>
		<script type="text/javascript">
		var chart;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'container2',
         defaultSeriesType: 'line',
         marginRight: 130,
         marginBottom: 25
      },
      title: {
         text: 'Admission Grades',
         x: -20 //center
      },
      subtitle: {
         text: '',
         x: -20
      },
      xAxis: {
         categories: ['Fall 2007', 'Spring 2008', 'Fall 2008', 

'Spring 2009', 'Fall 2009', 'Spring 2009']
      },
      yAxis: {
         title: {
            text: ''//'Temperature (°C)'
         },
         plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
         }]
      },
      tooltip: {
         formatter: function() {
                   return '<b>'+ this.series.name +'</b><br/>'+
               this.x +': '+ this.y +'°C';
         }
      },
      legend: {
         layout: 'horizontal',
         align: 'left',
         verticalAlign: 'top',
         x: 10,
         y: 100,
         borderWidth: 1
      },
      series: [{
         name: 'Entre 60 et 65',
         data: [6, 0, 12, 2, 44, 7]
      }, {
         name: 'Entre 66 et 79',
         data: [30 , 6, 36, 6, 50, 13]
      }, {
         name: 'de 80 � 100',
         data: [12, 2, 11, 9, 33, 6]
      } 
         
      ]
   });
   
   
});
</script>

		
		<!--[if IE]>
			<script type="text/javascript" src="./js/excanvas.compiled.js"></script>
		<![endif]-->
		
		<!-- 2. Add the JavaScript to initialize the chart on document ready -->
		
<link rel="stylesheet" type="text/css" href="../css/main.css" media="screen">
<!--<link rel="stylesheet" type="text/css" href="css/global.css">-->
<script language="javascript1.2" src="js/prototype.js" type="text/javascript"></script>
<script language="javascript1.2" src="js/forms.js" type="text/javascript"></script>
<style type="text/css">
<!--
.style5 {font-size: 14px; color: #FFFFFF; }
.style9 {color: #000099}
.style10 {font-size: 18px}
.style12 {font-size: 12px; color: #FFFFFF; }
.style14 {font-size: 10px; color: #FFFFFF; }
.style16 {font-weight: bold; font-size: larger;}
.style17 {font-size: larger}
.style19 {font-size: 9px; color: #FFFFFF; }
.style20 {font-size: 9px; }
-->
</style>
</head>
<body>
<blockquote>
  <blockquote>
    <blockquote>
      <p align="center">
        <a href= "index.php" class="style16"><< Retour</a></p>
    </blockquote>
  </blockquote>
</blockquote>
<tr>
    <td colspan="2" align="left">&nbsp;</td>
</tr>

<div align="center">
<div id="container">




<div id="header_intro"></div>
<div align="center" class="style9" id="titre">
<div align="center" class="style10"><br>Statistique Decisionnelles<br></div>
</div>
<div align="center">
<div id="container">
<div id="actualite">
<div id="titre"><span id="titre_page"></span></div>
<table width="750" border="0" align="center" cellspacing="0" style="margin-top:10px" >
  <tr class="entete">
    <th width="7%"><span class="style19">Fall 2006 </span></th>
    <th width="8%"><span class="style19">Fall 2007 </span></th>
    <th width="9%"><span class="style19">Spring 2007 </span></th>
    <th width="9%"><span class="style19">Fall 2008 </span></th>
    <th width="9%"><span class="style19">Spring 2008 </span></th>
    <th width="8%"><span class="style19">Fall 2009 </span></th>
    <th width="10%"><span class="style19">Spring 2009 </span></th>
    <th width="10%"><span class="style19"> Fall 2010 </span></th>
    <th width="10%"><span class="style19">Spring 2010 </span></th>
    
    <th width="11%"><span class="style19">Spring 2011 </span></th>
  </tr>
  <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr class="entete">
    <th width="9%"><span class="style19"><a href= "tab1.php"  target="cible1" class="style17">Tableau</a></span></th>
    <th width="9%"><span class="style19"><a href= "tab2.php"  target="cible1" class="style17">Tableau</a></span></th>
	<th width="9%"><span class="style19"><a href= "tab3.php"  target="cible1" class="style17">Tableau</a></span></th>
	<th width="9%"><span class="style19"><a href= "tab4.php"  target="cible1" class="style17">Tableau</a></span></th>
	<th width="9%"><span class="style19"><a href= "tab5.php"  target="cible1" class="style17">Tableau</a></span></th>
    <th width="9%"><span class="style19"><a href= "tab6.php"  target="cible1" class="style17">Tableau</a></span></th>
    <th width="9%"><span class="style19"><a href= "tab7.php"  target="cible1" class="style17">Tableau</a></span></th>
	<th width="9%"><span class="style19"><a href= "tab8.php"  target="cible1" class="style17">Tableau</a></span></th>
	<th width="9%"><span class="style19"><a href= "tab9.php"  target="cible1" class="style17">Tableau</a></span></th>
	<th width="9%"><span class="style19"><a href= "tab10.php" target="cible1" class="style17">Tableau</a></span></th>
	
  </tr>
  <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr class="entete">
  <th width="9%"><span class="style19"><a href= "G1.html" target="cible1" class="style17">Graphe</a></span></th>
  <th width="9%"><span class="style19"><a href= "G2.html" target="cible1" class="style17">Graphe</a></span></th>
  <th width="9%"><span class="style19"><a href= "G3.html" target="cible1" class="style17">Graphe</a></span></th>
  <th width="9%"><span class="style19"><a href= "G4.html" target="cible1" class="style17">Graphe</a></span></th>
  <th width="9%"><span class="style19"><a href= "G5.html" target="cible1" class="style17">Graphe</a></span></th>
  <th width="9%"><span class="style19"><a href= "G6.html" target="cible1" class="style17">Graphe</a></span></th>
  <th width="9%"><span class="style19"><a href= "G7.html" target="cible1" class="style17">Graphe</a></span></th>
  <th width="9%"><span class="style19"><a href= "G8.html" target="cible1" class="style17">Graphe</a></span></th>
  <th width="9%"><span class="style19"><a href= "G9.html" target="cible1" class="style17">Graphe</a></span></th>
  <th width="9%"><span class="style19"><a href= "G10.html" target="cible1" class="style17">Graphe</a></span></th>
  
    
  </tr>
  <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left">&nbsp;
        <?php //echo html_entity_decode(stripslashes($row['contenu']))?></td>
  </tr>
</table>
<br />
<center>
<iframe src="" frameborder="0" width="740px" height="1500px" id="cible1" name="cible1" marginwidth="0" marginheight="0" scrolling="no" ></iframe>

</center>
</body>
</html>
