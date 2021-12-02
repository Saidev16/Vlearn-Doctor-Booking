<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");

require '../administrator/config/config.php';

$data = $_POST['data'];

if ($data != array()) {




  $name  = $data['name'];
  $id  = $data['id'];
  $email  = $data['email'];
  $tel  = $data['tel'];
  $birth  = $data['birth'];
  $address  = $data['address'];
  $city  = $data['city'];
  $country  = $data['country'];
  $zip = $data['zip'];
  $campus = $data['campus'];
  $type = $data['type'];

  $application_fee = $data['app_fee'];
   // $application_fee = $data['application_fee'];
  $annual_registration = $data['annual_registration'];
  $grade = $data['grade'];
  
  $semester = $data['semester'];
  $price_semester = $data['price_semester'];

  $year = $data['year'];
  $price_year = $data['price_year'];

  $other_amount = $data['other_amount'];
  $other_description = $data['other_description'];
  $other = $data['other'];
  $reinstatement = $data['reinstatement'];
  $change_of_program = $data['change_of_program'];
  $returned_check = $data['returned_check'];
  $replacement_diploma = $data['replacement_diploma'];
  $postal = $data['postal'];
  $officialTranscript = $data['officialTranscript'];
  $copyTranscript = $data['copyTranscript'];

  $json = array();


  if ($name == "" || $id == "" || $email == "" || $tel == "" || $birth == ""  || $address == "" || $city == "" || $country == "" || $zip == "") {
    $json['persoInfo'] = 0;
  }else{
    $headers .='Content-Type: text/html; charset="UTF-8"'."\n";
    $headers .='Content-Transfer-Encoding: 8bit'."\r\n";
    $headers .= 'From: American School of Leadership <Billing@americanhigh.us>' . "\r\n";



    $message_student = "<tr class='heading'><td>Item</td><td>Price</td></tr>
    ";

    $message_administartion =	"
    <html><head><title></title></head><body>
    <p></p>
    <table style='border-collapse: collapse;border: 1px solid #e9ecef;margin-bottom: 1rem;background-color: transparent;' >
    <tbody>
    <tr>
    <th scope='row' style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>Student ID</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$id."</td>
    </tr>
    <tr>
    <th scope='row' style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>Student Name</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$name."</td>
    </tr>
    <tr>
    <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Student Email</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$email."</td>
    </tr>
    <tr>
    <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Phone Number</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$tel."</td>
    </tr>
    <tr>
    <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Birth Day</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$birth."</td>
    </tr>
    <tr>
    <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Address</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$address."</td>
    </tr>
    <tr>
    <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>City</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$city."</td>
    </tr>
    <tr>
    <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Country</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$country."</td>
    </tr>
    <tr>
    <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Zip</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$zip."</td>
    </tr>";
    $tt = 0;
    if($campus != ""){
      $message_student .= "<tr class='item'>
      <td colspan='2'>
      Tuition
      </td>
      </tr>";
      $message_student .= "<tr class='item'>
      <td colspan='2'>
      Campus : ".$campus."
      </td>
      </tr>";
      $message_administartion .= "<tr>
      <th colspan = '2' style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Tuition</th>
      </tr><tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Campus</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$campus."</td>
      </tr>";
    }
    if ($type != "") {
      if ($type == "us") {
        $type = "US Citizens and Residents";
      }else{
        $type = "International Students";
      }
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Type</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$type."</td>
      </tr>";
      $message_student .= "<tr class='item'>
      <td colspan = '2'>
      Type : ".$type."
      </td>
      </tr>";
    }
   
    if ($annual_registration != "") {
      $tt += $annual_registration;
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Annual Registration</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$annual_registration."</td>
      </tr>";
      $message_student .= "<tr class='item'><td>Annual Registration</td><td>$".$annual_registration."</td></tr>";
    }else{
      $annual_registration = 0;
    }
    if ($grade != "") {
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Grade</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$grade."th</td>
      </tr>";
      $message_student .= "<tr class='item'>
      <td colspan= '2'>
      Grade : ".$grade."th
      </td>
      </tr>";
    }else{
      $grade = 0;
    }

    if ($semester != "") {
      $tt += $price_semester;
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Payment Semester</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$price_semester."</td>
      </tr>";
      $message_student .= "<tr class='item'><td>Payment Semester</td><td>$".$price_semester."</td></tr>";
    }else{
      $price_semester = 0;
    }
    if ($year != "") {
      $tt += $price_year;
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Payment Year</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$price_year."</td>
      </tr>";
      $message_student .= "<tr class='item'><td>Payment Year</td><td>$".$price_year."</td></tr>";
    }else{
      $price_year = 0;
    }

    if ($other_amount != "") {
      $tt += $other_amount;
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Other Amount</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$other_amount."</td>
      </tr>
      <tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Description</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>".$other_description."</td>
      </tr>";
      $message_student .= "<tr class='item'><td>Other Amount</td><td>$".$other_amount."</td></tr>";
      $message_student .= "<tr class='item'><td colspan='2'>Description : ".$other_description."</td></tr>";

    }else{
      $other_amount = 0;
    }
      
    if ($other != "") {
      $tt += $other;
      $other_amount = $other;
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Other Amount</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$other."</td>
      </tr>";
      
      $message_student .= "<tr class='item'><td>Other Amount</td><td>$".$other."</td></tr>";

    }else{
      $other = 0;
    }
      

    if ($reinstatement != 0 || $change_of_program != 0 || $application_fee != 0 || $returned_check != 0 || $replacement_diploma != 0 || $copyTranscript != 0 || $officialTranscript != 0){
      $message_administartion .= "<tr>
      <th colspan = '2' style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Fees</th>
      </tr>";
      $message_student .= "<tr class='item'><td colspan='2'>Fees</td></tr>";

    }

     if ($application_fee != "") {
      $tt += $application_fee;
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Application Fee</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$application_fee."</td>
      </tr>";
      $message_student .= "<tr class='item'>
      <td>
      Application Fee
      </td>
      <td>
      $".$application_fee."
      </td>

      </tr>";
    }else{
      $application_fee = 0;
    }
    if ($reinstatement != "") {
      $tt += $reinstatement;
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Reinstatement</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$reinstatement."</td>
      </tr>";
      $message_student .= "<tr class='item'><td>Reinstatement</td><td>$".$reinstatement."</td></tr>";

    }else{
      $reinstatement = 0;
    }

    if ($change_of_program != "") {
      $tt += $change_of_program;
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Change of Program</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$change_of_program."</td>
      </tr>";
      $message_student .= "<tr class='item'><td>Change of Program</td><td>$".$change_of_program."</td></tr>";

    }else{
      $change_of_program = 0;
    }

    if ($returned_check != "") {
      $tt += $returned_check;
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Returned Check</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$returned_check."</td>
      </tr>";
      $message_student .= "<tr class='item'><td>Returned Check</td><td>$".$returned_check."</td></tr>";

    }else{
      $returned_check = 0;
    }


    if ($replacement_diploma != "") {
      $tt += $replacement_diploma;
      $message_administartion .= "<tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Replacement Diploma</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$replacement_diploma."</td>
      </tr>";
      $message_student .= "<tr class='item'><td>Replacement Diploma</td><td>$".$replacement_diploma."</td></tr>";
      

    }else{
      $replacement_diploma = 0;
    }

    if ($postal != "") {
      $tt += $postal;
      $message_administartion .= "
      <tr>
      <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Postal Charge</th>
      <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$ ".$postal."</td>
      </tr>";
      $message_student .= "<tr class='item'><td>Postal Charge</td><td>$".$postal."</td></tr>";

    }else{
      $postal = 0;
    }

    $pr = round($tt*0.02,2);
    $ttc = round($tt+$pr,2);
    $message_administartion .= "
    <tr>
    <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Total without Paypal Charge</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$".$tt."</td>
    </tr>
    <tr>
    <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'> 2% Surcharge Processing</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$".$pr."</td>
    </tr>
    <tr>
    <th style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;' scope='row'>Total</th>
    <td style='padding: 10px;border: 1px solid #e9ecef;text-align: left;padding: .75rem;border-bottom-width: 2px;vertical-align: top;border-bottom: 2px solid #e9ecef;'>$".$ttc."</td>
    </tr>
    </tbody>
    </table>";
    $message_student .= "<tr class='total'>
    <td></td>

    <td>
    Total: $".$ttc."
    </td>
    </tr>
    </table>
    </div>
    </body>
    </html>";
    $message_administartion .= "</body></html>";
    //echo $message_administartion;
    //die();zineb@aulm.us,ounsa@aulm.us
    $to = 'zineb@aulm.us,ounsa@aulm.us';
     //$to = 'mehdi@aulm.us,ounsa@americahigh.us,zineb@aulm.us';


    $created = date("Y-m-d");


    /// add to database


    $sql = "INSERT INTO `aslPayment`(`student_id`, `name`, `phone`, `email`, `birth`, `address`, `city`, `country`, `zip`, `campus`, `type`, `application_fee`, `annual_registration`, `grade`, `price_semester`, `price_year`, `other_amount`, `other_description`,
    `reinstatement`, `change_of_program`, `returned_check`, `replacement_diploma`, `postal`, `tt`, `por`, `ttc`, `payement`, `click_payement`, `created`) VALUES (\"$id\",\"$name\",$tel,\"$email\",\"$birth\",\"$address\",\"$city\",\"$country\",\"$zip\",\"$campus\",\"$type\",$application_fee,$annual_registration,$grade,$price_semester,$price_year,$other_amount,\"$other_description\",$reinstatement,$change_of_program,$returned_check,$replacement_diploma,$postal,$tt,$pr,$ttc,0,0,\"$created\")";
    //echo $sql;
    @mysql_query($sql) or die ('Database error: ' . mysql_error());


    $maxId = 0;
    $sql2 = "SELECT MAX(id) as idMax FROM `aslPayment` WHERE 1";
    $req2 = @mysql_query($sql2) ;
    
    if (! $req2){
            die('Database error: ' . mysql_error());
    }
    
    
    $row2 = mysql_fetch_assoc($req2);
    $maxId = $row2['idMax'];


    $message_studentHeader = "<!doctype html>
    <html>
    <head>
    <meta charset='utf-8'>
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
    .invoice-box {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, .15);
      font-size: 16px;
      line-height: 24px;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color: #555;
    }

    .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
    }

    .invoice-box table td {
      padding: 5px;
      vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
      text-align: right;
    }

    .invoice-box table tr.top table td {
      padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
      font-size: 45px;
      line-height: 45px;
      color: #333;
    }

    .invoice-box table tr.information table td {
      padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
      background: #eee;
      border-bottom: 1px solid #ddd;
      font-weight: bold;
    }

    .invoice-box table tr.details td {
      padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
      border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
      border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
      border-top: 2px solid #eee;
      font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
      .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
      }

      .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
      }
    }

    /** RTL **/
    .rtl {
      direction: rtl;
      font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
      text-align: right;
    }

    .rtl table tr td:nth-child(2) {
      text-align: left;
    }
    </style>
    </head>
    <body>
    <div class='invoice-box'>
    <table cellpadding='0' cellspacing='0'>
    <tr class='top'>
    <td colspan='2'>
    <table>
    <tr>
    <td class='title'>
    <img src='https://americanhigh.us/tuition/asl.png' style='width:100%; max-width:300px;'>
    </td>

    <td>
    Invoice #: ".$maxId."<br>
    Created: ".date("F j, Y")."
    </td>
    </tr>
    </table>
    </td>
    </tr>

    <tr class='information'>
    <td colspan='2'>
    <table>
    <tr>
    <td>
    ".$name."<br>
    #".$id."<br>
    ".$email."
    </td>
    <td style='text-align: right;'>
        <a href='https://his.americanhigh.us/aslPayment/pay.php?i=".$maxId."&tt=".$tt."' target='_blank' style='color: #fff;
    background-color: #ffc107;
    border-color: #ffc107;
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    text-decoration: none;
    text-align: center;'>Pay Now </a>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    ";

    $message = $message_studentHeader.$message_student;
    //echo $message;
    $emailSendStudent = 0;
    if (mail($email,'ASL Payment #invoice Id '.$maxId,$message,$headers)) {
      $emailSendStudent = 2;
    }

    $emailSend = 0;
    if (mail($to,'Invoice #'.$maxId.' ASL Payment from '.$name.' Created '.$created.'',$message_administartion,$headers)) {
      $emailSend = 1;
    }



    $json['persoInfo'] = 1;
    $json['status'] = 1;
    $json['id'] = $maxId;
    $json['email'] = $emailSend;
    $json['emailStudent'] = $emailSendStudent;
    $json['price'] = $tt;
    // $json[]['sql_v_1'] = "$sql_v_1";
    // $json[]['sql2'] = "$sql2";
    // $json[]['sql3'] = "$sql3";

  }

  echo json_encode($json);



}


?>
