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
.style21 {color: #000000}
-->
</style>
</head>
<body>
<blockquote>
  <blockquote>
    <blockquote>
      
    </blockquote>
  </blockquote>
</blockquote>
<tr>
    <td colspan="2" align="left">&nbsp;</td>
</tr>


<div id="titre"><span id="titre_page">&nbsp;Recrutement</span></div>
<table width="750" border="0" align="center" cellspacing="0" style="margin-top:10px" >
 <tr class="entete">
    <th width="10%" align="left"><span class="style5">&nbsp; </span></th>
	 <th width="7%" align="left"><span class="style5">&nbsp; </span></th>
   	    <th width="10%"><span class="style14">Spring 2007 </span></th>
	
  </tr>
   <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>  
 <tr class="entete">

    <th width="10%" align="left">Undergraduate</th>
    
	<th width="7%"><span class="style12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1st year </span></th>
		<th width="10%"><span class="style12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style21">1</span> </span></th>
  </tr>
   <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr class="entete">

    <th width="10%" align="left">&nbsp;</th>
	<th width="7%"><span class="style12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2nd&nbsp;year </span></th>
   	<th width="10%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0</th>
	
 
  </tr>
  <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
   <tr class="entete">

    <th width="10%" align="left">&nbsp;</th>
	<th width="7%"><span class="style12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3d&nbsp;and&nbsp;4th&nbsp;year </span></th>
    
		<th width="10%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0</th>
	  </tr>
   <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr class="entete">

    <th width="10%" align="left">&nbsp;GRAD</th>
	<th width="7%"><span class="style12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1st year </span></th>
    <th width="7%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6</th>
	  </tr>
   <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr class="entete">

    <th width="10%" align="left">&nbsp;</th>
	<th width="7%"><span class="style12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2nd&nbsp;year </span></th>
    <th width="7%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0</th>
	
  </tr>
   <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr class="entete">

    <th width="10%" align="left">&nbsp;Total Admissions</th>
    
	<th width="8%"></th>
	<th width="10%" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7</th>
	
  </tr>
  
  <tr>
    <td colspan="2" align="left">&nbsp;<?php //echo html_entity_decode(stripslashes($row['contenu']))?></td>
  </tr>  
  <tr class="entete">

    <th width="10%" align="left">&nbsp;Total Scholarships awarded</th>
    
	<th width="8%"></th>
	<th width="10%" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1</th>
	
  </tr>
  
  <tr>
    <td colspan="2" align="left">&nbsp;<?php //echo html_entity_decode(stripslashes($row['contenu']))?></td>
  </tr>  
</table>
	<div align="center">
<div id="container">
<div id="actualite"><!-- 3. Add the container -->
</body>
</html>
