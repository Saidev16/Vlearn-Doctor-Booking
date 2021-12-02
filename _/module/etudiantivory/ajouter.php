<style type="text/css">
input{width:200px;}
</style>
<?php
//if (isset($_POST['ci'])){
if (isset($_POST['nom'])){

//$code_inscription = $_SESSION['num_inscription'] = $_POST['ci'];
$nom=addslashes(trim($_POST['nom']));
$prenom=addslashes(trim($_POST['prenom']));
$date_naissance=$_POST['year_n'].'-'.$_POST['month_n'].'-'.$_POST['day_n'];
$date_insc=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
$lieu_naissance=addslashes($_POST['lieu_naissance']);
$tel=addslashes($_POST['tel']);
$adresse=addslashes($_POST['adresse']);
$serie_bac=$_POST['serie_bac'];
$cs=$_POST['idSession'];
$filiere=$_POST['filiere'];
$cin=$_POST['cin'];
$pass=md5(trim(strtolower($_POST['year_n'].'-'.$_POST['month_n'].'-'.$_POST['day_n'])));

$mail=$_POST['mail'];
$nationalite=addslashes($_POST['nationalite']);
$sexe=$_POST['sexe'];
$code_bac=$_POST['code_bac'];
$serie_bac=$_POST['serie_bac'];
$cinq_photo=$_POST['cinq_photo'];
$copie_bac=$_POST['copie_bac'];
$buletin_note=$_POST['buletin'];
$copie_cin=$_POST['copie_cin'];
$extrait=$_POST['extrait'];
$note_etudesoc=$_POST['note_etudesoc'];
$note_fr=$_POST['note_fr'];
$note_sciences=$_POST['note_sciences'];
$note_math=$_POST['note_math'];
$buletin=$_POST['buletin'];
$reglement=$_POST['reglement'];
$trois_lettre=$_POST['trois_lettre'];
$trois_enveloppe=$_POST['trois_enveloppe'];
$aquise=addslashes($_POST['aquise']);
$groupe=$_POST['groupe'];
$annee=$_POST['annee'];
$activite=addslashes($_POST['activite']);
$annee_inscription=date('Y');
$ville = $_POST['ville'];
$niveau = $_POST['niveau'];
$elearning = $_POST['elearning'];
$original_bac = $_POST['original_bac'];
$english_bac = $_POST['english_bac'];
$piimt = $_POST['piimt'];
$aul = $_POST['aul'];
$umt = $_POST['umt'];
$idSession = $_POST['idSession'];
$codep=$_POST['codepays'];
$type=$_POST['type'];
$parentname=$_POST['parentname'];
$parentemail=$_POST['parentemail'];
$parentphone=$_POST['parentphone'];
 $sqlzin="SELECT max(`code_inscription`) as max FROM tbl_etudiant_ivory";
$sqlzin1 =mysql_query($sqlzin) or die("erreur lors de traitement de F*");

$ab= mysql_fetch_assoc($sqlzin1);
$cu= $ab["max"];
$code_inscription= $cu+1;
  $sql_insert="INSERT INTO tbl_etudiant_ivory (`prefixe` ,code_inscription,`nom` , `prenom` , `date_naissance` , `nationalite` , `adresse` , `sexe` , `code_bac` , `serie_bac` ,
`date_inscription` , `tel` , `email` , `annee` , `semestre` , `filiere` , `lieu_naissance` , `cin` , `cinq_photo` , `original_bac` ,
`copie_bac` , `english_bac` , `trois_lettre` , `trois_enveloppe` , `buletin` , `reglement` , `copie_cin` ,
`extrait_naissance` , `test_etudesoc` , `test_fr` , `test_sciences` , `test_math` , `aquise_academique` , `login` , `mot_pass` ,
`acces` , `groupe` , `activite` , `annee_inscription`, `niveau` , `ville` , `elearning`, `piimt`, `aul`, `umt`, `type`,`parentname`, `parentphone`, `parentemail`, `login_parent`, `mot_pass_parent`)
VALUES ('IC','$code_inscription','$nom', '$prenom', '$date_naissance', '$nationalite', '$adresse', '$sexe', '$code_bac', '$serie_bac', '$date_insc', '$tel', '$mail', '$annee', '$idSession', '$filiere', '$lieu_naissance', '$cin', '$cinq_photo', '$original_bac', '$copie_bac', '$english_bac', '$trois_lettre', '$trois_enveloppe', '$buletin_note',  '$reglement', '$copie_cin', '$extrait', '$note_etudesoc', '$note_fr', '$note_sciences', '$note_math', '$aquise', '$nom', '$pass', 1, '$groupe', '$activite', '$annee_inscription', '$niveau', '$ville', '$elearning', '$piimt', '$aul', '$umt', '$type','$parentname', '$parentphone', '$parentemail', '$parentname', '$pass');";
	  @mysql_query($sql_insert)or die ("Error save student");

    $sql_insert="INSERT INTO tbl_etudiant_all (`prefixe` ,code_inscription,`nom` , `prenom` , `date_naissance` , `nationalite` , `adresse` , `sexe` , `code_bac` , `serie_bac` ,
`date_inscription` , `tel` , `email` , `annee` , `semestre` , `filiere` , `lieu_naissance` , `cin` , `cinq_photo` , `original_bac` ,
`copie_bac` , `english_bac` , `trois_lettre` , `trois_enveloppe` , `buletin` , `reglement` , `copie_cin` ,
`extrait_naissance` , `test_etudesoc` , `test_fr` , `test_sciences` , `test_math` , `aquise_academique` , `login` , `mot_pass` ,
`acces` , `groupe` , `activite` , `annee_inscription`, `niveau` , `ville` , `elearning`, `piimt`, `aul`, `umt`, `type`,`parentname`, `parentphone`, `parentemail`, `login_parent`, `mot_pass_parent`)
VALUES ('IC','$code_inscription','$nom', '$prenom', '$date_naissance', '$nationalite', '$adresse', '$sexe', '$code_bac', '$serie_bac', '$date_insc', '$tel', '$mail', '$annee', '$idSession', '$filiere', '$lieu_naissance', '$cin', '$cinq_photo', '$original_bac', '$copie_bac', '$english_bac', '$trois_lettre', '$trois_enveloppe', '$buletin_note',  '$reglement', '$copie_cin', '$extrait', '$note_etudesoc', '$note_fr', '$note_sciences', '$note_math', '$aquise', '$nom', '$pass', 1, '$groupe', '$activite', '$annee_inscription', '$niveau', '$ville', '$elearning', '$piimt', '$aul', '$umt', '$type','$parentname', '$parentphone', '$parentemail', '$parentname', '$pass');";
    @mysql_query($sql_insert)or die ("Error save student");



if($type=='Transfer')
{$tuition=2500;}
else if($type=='9th Grade')
{$tuition=3600;}
else if($type=='10th Grade')
{$tuition=3600;}
else if($type=='11th Grade')
{$tuition=3600;}
else if($type=='12th Grade')
{$tuition=4200;}


/*$sqlfinance="insert into tbl_finance (`prefixe` ,code_inscription,frais_etude) values('MOR','$code_inscription',$tuition)";
 @mysql_query($sqlfinance)or die ("Error save finance");*/
 $sqlfinance="insert into tbl_finance_ivory (`prefixe` ,code_inscription) values('IC','$code_inscription')";
 @mysql_query($sqlfinance)or die ("Error save finance");


                           $_SESSION['search'] = $nom;

           ?>
 			<script type="text/javascript" language="JavaScript1.2">
 			<!--
                       window.location.replace('/module/api_testing/create_user.php?code_inscription=<?php echo $code_inscription; ?>&prefixe=IC');
 			//-->
 			</script>
               <?php
                   }

			  else{
			  ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="80%" class="titre">&nbsp;New Student <span class="task">[Add]</span></td>
	<td width="20%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="return validate1()"><div class="save"></div>Create</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_des_etudiants_ivory.php"><div class="cancel"></div>Cancel</a>
		  </td>
		</tr>
	  </table>
	</td>
  </tr>
 </table>


  <form method="post" action="gestion_des_etudiants_ivory.php?new=oui" name="f_ajout" >
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
	   <tr>
	     <td height="5"></td>
	   </tr>
       <tr>
         <td valign="top" width="100%"><table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
           <tr>
             <td colspan="4" height="3px"><div id="er_code" class="erreur"></div></td>
           </tr>
           <!--  <tr>
			  <td width="25%"><label for="ci">Num�ro d'inscription :</label> </td>
			  <td width="25%">
				<input type="text" name="ci" id="ci" class="input" onkeyup="onAddVerify()" onchange="onAddVerify()" />
			  </td>
			  <td width="25%"><label for="buletin">Buletin de notes : </label></td>
			  <td>
				   <select name="buletin" id="buletin" class="combobox">
				       <option value="0" selected="selected">non</option>
					   <option value="1">oui</option>
				   </select>
			   </td>
		  </tr>-->
           <tr>
             <td colspan="4" height="3px"><div id="er_nom" class="erreur"></div></td>
           </tr>

		  <!-- <tr>
		   <td>
             <select name="codepays" class="input">
                 <option value="MOR">MOR</option>
                  <option value="ASL">ASL</option>
                 <option value="BF">BF</option>
				 <option value="AG">AG</option>
				 <option value="BN">BN</option>
			</select>
			</td>
           </tr>-->

           <tr>
             <td><label for="prenom">First Name : </label></td>
             <td><input type="text" name="prenom" id="prenom" class="input"/>             </td>
             <td></td>
             <td><label for="nom">Last Name  :</label>             </td>
             <td><input type="text" name="nom" id="nom" class="input" /></td>
           </tr>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
             <td><label for="year_n">Date of Birth : </label></td>
             <td>
			  <select name="month_n" class="input">
                 <option value="00">00</option>
                 <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 <option value="05">05</option>
                 <option value="06">06</option>
                 <option value="07">07</option>
                 <option value="08">08</option>
                 <option value="09">09</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 <option value="12">12</option>
               </select>
               &nbsp;
               <select name="day_n" class="input">
                 <option value="00">00</option>
                 <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 <option value="05">05</option>
                 <option value="06">06</option>
                 <option value="07">07</option>
                 <option value="08">08</option>
                 <option value="09">09</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 <option value="12">12</option>
                 <option value="13">13</option>
                 <option value="14">14</option>
                 <option value="15">15</option>
                 <option value="16">16</option>
                 <option value="17">17</option>
                 <option value="18">18</option>
                 <option value="19">19</option>
                 <option value="20">20</option>
                 <option value="21">21</option>
                 <option value="22">22</option>
                 <option value="23">23</option>
                 <option value="24">24</option>
                 <option value="25">25</option>
                 <option value="26">26</option>
                 <option value="27">27</option>
                 <option value="28">28</option>
                 <option value="29">29</option>
                 <option value="30">30</option>
                 <option value="31">31</option>
               </select>     &nbsp;
			   <select name="year_n" id="year_n" class="input">
                 <option value="0000">0000</option>
                 <?php
			  $cur=date('Y')-10;
			  for ($i=1960; $i<$cur; $i++){
			  ?>
                 <option value="<?=$i?>">
                 <?=$i?>
                 </option>
                 <?php
			  }
			  ?>
               </select>

                 </td>
             <td></td>
             <td><label for="sexe">Gender :</label>             </td>
             <td><select name="sexe" id="sexe" class="input" style="width:200px">
                 <option value="male">Male</option>
                 <option value="female">Female</option>
               </select>             </td>
           </tr>
           <tr>
             <td><label for="adresse">Adress :</label>             </td>
             <td><input type="text" name="adresse" id="adresse" class="input"/>             </td>
             <td></td>
             <td><label for="tel">Cell :</label>             </td>
             <td><input type="text" name="tel" id="tel" class="input"/>             </td>
           </tr>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
             <td><label for="cin">ID,Passport or Driver's Licence :</label>             </td>
             <td><input type="text" name="cin" id="cin" class="input" onchange="onAddVerifyCin()" onkeyup="onAddVerifyCin()"/></td>
             <td></td>
             <td><label for="year_i">Registration date :</label></td>
             <td>
			   <select name="month_i" class="input">
                 <option value="01" <?=(date('m')==1) ? $selected : '' ?>>01</option>
                 <option value="02" <?=(date('m')==2) ? $selected : '' ?>>02</option>
                 <option value="03" <?=(date('m')==3) ? $selected : '' ?>>03</option>
                 <option value="04" <?=(date('m')==4) ? $selected : '' ?>>04</option>
                 <option value="05" <?=(date('m')==5) ? $selected : '' ?>>05</option>
                 <option value="06" <?=(date('m')==6) ? $selected : '' ?>>06</option>
                 <option value="07" <?=(date('m')==7) ? $selected : '' ?>>07</option>
                 <option value="08" <?=(date('m')==8) ? $selected : '' ?>>08</option>
                 <option value="09" <?=(date('m')==9) ? $selected : '' ?>>09</option>
                 <option value="10" <?=(date('m')==10) ? $selected : '' ?>>10</option>
                 <option value="11" <?=(date('m')==11) ? $selected : '' ?>>11</option>
                 <option value="12" <?=(date('m')==12) ? $selected : '' ?>>12</option>
               </select>
               &nbsp;
               <select name="day_i" class="input">
                 <option value="01" <?=(date('d')==1) ? $selected : '' ?>>01</option>
                 <option value="02" <?=(date('d')==2) ? $selected : '' ?>>02</option>
                 <option value="03" <?=(date('d')==3) ? $selected : '' ?>>03</option>
                 <option value="04" <?=(date('d')==4) ? $selected : '' ?>>04</option>
                 <option value="05" <?=(date('d')==5) ? $selected : '' ?>>05</option>
                 <option value="06" <?=(date('d')==6) ? $selected : '' ?>>06</option>
                 <option value="07" <?=(date('d')==7) ? $selected : '' ?>>07</option>
                 <option value="08" <?=(date('d')==8) ? $selected : '' ?>>08</option>
                 <option value="09" <?=(date('d')==9) ? $selected : '' ?>>09</option>
                 <option value="10" <?=(date('d')==10) ? $selected : '' ?>>10</option>
                 <option value="11" <?=(date('d')==11) ? $selected : '' ?>>11</option>
                 <option value="12" <?=(date('d')==12) ? $selected : '' ?>>12</option>
                 <option value="13" <?=(date('d')==13) ? $selected : '' ?>>13</option>
                 <option value="14" <?=(date('d')==14) ? $selected : '' ?>>14</option>
                 <option value="15" <?=(date('d')==15) ? $selected : '' ?>>15</option>
                 <option value="16" <?=(date('d')==16) ? $selected : '' ?>>16</option>
                 <option value="17" <?=(date('d')==17) ? $selected : '' ?>>17</option>
                 <option value="18" <?=(date('d')==18) ? $selected : '' ?>>18</option>
                 <option value="19" <?=(date('d')==19) ? $selected : '' ?>>19</option>
                 <option value="20" <?=(date('d')==20) ? $selected : '' ?>>20</option>
                 <option value="21" <?=(date('d')==21) ? $selected : '' ?>>21</option>
                 <option value="22" <?=(date('d')==22) ? $selected : '' ?>>22</option>
                 <option value="23" <?=(date('d')==23) ? $selected : '' ?>>23</option>
                 <option value="24" <?=(date('d')==24) ? $selected : '' ?>>24</option>
                 <option value="25" <?=(date('d')==25) ? $selected : '' ?>>25</option>
                 <option value="26" <?=(date('d')==26) ? $selected : '' ?>>26</option>
                 <option value="27" <?=(date('d')==27) ? $selected : '' ?>>27</option>
                 <option value="28" <?=(date('d')==28) ? $selected : '' ?>>28</option>
                 <option value="29" <?=(date('d')==29) ? $selected : '' ?>>29</option>
                 <option value="30" <?=(date('d')==30) ? $selected : '' ?>>30</option>
                 <option value="31" <?=(date('d')==31) ? $selected : '' ?> >31</option>
               </select>   &nbsp;<select name="year_i" id="year_i" class="input">
                 <?php for ($i=date('Y'); $i>1996; $i--){?>
                 <option value="<?=$i?>" <?=(date('m')==$i) ? $selected : '' ?>>
                 <?=$i?>
                 </option>
                 <?php
		  }
		  ?>
               </select>

                         </td>
           </tr>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
             <td><label for="mail">Email : </label></td>
             <td><input type="text" name="mail" id="mail" class="input" /></td>
             <td></td>
             <td><label for="nationalite">Nationality :</label>             </td>
             <td><input type="text" name="nationalite" id="nationalite" class="input" /></td>
           </tr>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
             <td><label for="lieu_naissance">Name of Lasted School attented: </label></td>
             <td><input type="text" name="lieu_naissance" id="lieu_naissance" class="input"/>             </td>
             <td></td>
             <td><label for="code_bac">School Adress  :</label>             </td>
             <td><input type="text" name="code_bac" id="code_bac" class="input" /></td>
           </tr>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
              <td><label for="english_bac">Last completed level : </label></td>
             <td><select name="english_bac" id="english_bac" class="combobox">
                 <option value="0" selected="selected"></option>
                 <option value="5">5th Grade</option>
                 <option value="6">6th Grade</option>
                 <option value="7">7th Grade</option>
                 <option value="8">8th Grade</option>
                 <option value="1">9th Grade</option>
                 <option value="2">10th Grade</option>
                 <option value="3">11th Grade</option>
                 <option value="4">12th Grade</option>
               </select>             </td>
             <td></td>
			  <td><label for="ville"><?php echo 'Country';?> : </label></td>

				          <td> <select name="ville" id="ville" class="input" style="width:200px">
				  <option value="" selected="selected">Select Country</option>


<option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antarctica">Antarctica</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Bouvet Island">Bouvet Island</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
<option value="Brunei Darussalam">Brunei Darussalam</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote D'ivoire">Cote D'ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Territories">French Southern Territories</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guinea-bissau">Guinea-bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
<option value="Korea, Republic of">Korea, Republic of</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macao">Macao</option>
<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
<option value="Moldova, Republic of">Moldova, Republic of</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montenegro">Montenegro</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="Netherlands Antilles">Netherlands Antilles</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Northern Mariana Islands">Northern Mariana Islands</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russian Federation">Russian Federation</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Helena">Saint Helena</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
<option value="Saint Lucia">Saint Lucia</option>
<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
<option value="South Sudan">South Sudan</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syrian Arab Republic">Syrian Arab Republic</option>
<option value="Taiwan, Republic of China">Taiwan, Republic of China</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
<option value="Thailand">Thailand</option>
<option value="Timor-leste">Timor-leste</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States">United States</option>
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="Viet Nam">Viet Nam</option>
<option value="Virgin Islands, British">Virgin Islands, British</option>
<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
<option value="Wallis and Futuna">Wallis and Futuna</option>
<option value="Western Sahara">Western Sahara</option>
<option value="Yemen">Yemen</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select></td>
           </tr>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
             <td><label for="trois_lettre">ASL application form :</label></td>
             <td><select name="trois_lettre" id="trois_lettre" class="combobox">
                 <option value="0" selected="selected">No</option>
                 <option value="1">Yes</option>
             </select></td>
             <td></td>
             <td><label for="copie_cin">2 Notarized copy of Your ID :</label>             </td>
             <td><select name="copie_cin" id="copie_cin" class="combobox">
                 <option value="0" selected="selected">No</option>
                 <option value="1">Yes</option>
               </select>             </td>
           </tr>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
             <td><label for="cinq_photo">2 Pictures :</label>             </td>
             <td><select name="cinq_photo" id="cinq_photo" class="combobox">
                 <option value="0" selected="selected">No</option>
                 <option value="1">Yes</option>
               </select>             </td>
             <td></td>
             <td><label for="trois_enveloppe">3 years High school transcripts: </label></td>
             <td><select name="trois_enveloppe" id="trois_enveloppe" class="combobox">
                 <option value="0" selected="selected">No</option>
                 <option value="1">Yes</option>
               </select>             </td>
           </tr>
         <tr>
             <td colspan="4" height="3px"></td>
           </tr>

           <tr>
             <td><label for="extrait"> Exam fee payment : </label></td>
             <td><select name="extrait" id="extrait" class="combobox">
                 <option value="0" selected="selected">No</option>
                 <option value="1">Yes</option>
               </select>             </td>
             <td></td>
			 <td><label for="copie_bac">A scholastic certificate with mention <br />
             of 12th grade
             /or baccalaureate level :</label>             </td>
             <td><select name="copie_bac" id="copie_bac" class="combobox">
                 <option value="0" selected="selected">No</option>
                 <option value="1">Yes</option>
               </select>             </td>
           <!--    <td><label for="note_fr">Grade of French:</label>             </td>
             <td><input type="text" name="note_fr" id="note_fr" class="input"/></td>
           </tr>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
            <td><label for="filiere">filiere : </label></td>
             <td><select name="filiere" id="filiere" style="width:200px" class="input">
                 <option value="8">S�lectionnner</option>
                 <?php /*
				  $sql3="select  id_filiere, nom_filiere from $tbl_filiere ";
				 $req=mysql_query($sql3) or die("erreur lors de la s�lection des filiere");
				 while ($row=mysql_fetch_assoc($req)){
				 ?>
                 <option value="<?=$row['id_filiere']?>">
                   <?=$row['nom_filiere']?>
                </option>
                 <?php
				 }*/
				 ?>
               </select>             </td>-->
             <td></td>
           </tr>
		   <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
             <!--<td><label for="note_sciences">Grade of Sciences:</label>             </td>
             <td><input type="text" name="note_sciences"  id="note_sciences" class="input"/>             </td>
             <td></td>-->

           </tr>
		   <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
             <td><label for="groupe">Section</label></td>
			  <td>
					<select name="groupe" id="groupe" style="width:200px" class="input"
					onchange="get_selected()" >
					<?php
					$sql4="select * from tbl_groupe where archive = 0 ";
					$req=mysql_query($sql4);
					while($row=mysql_fetch_assoc($req)){
					?>
				  <option value="<?=$row['id']?>">&nbsp;<?=$row['title']?></option>
					<?php }?>
				  </select>			  </td>
				   <td></td>

                  <td><label for="reglement">Student Signature: </label></td>
            	 <td><select name="reglement" id="reglement" class="combobox">
                 <option value="0" selected="selected">No</option>
                 <option value="1">Yes</option>
               </select>             </td>

           </tr>
		     <tr>
             <td colspan="4" height="3px"></td>
           </tr>
		     <tr>
		   <td><label for="idSession">Session :</label> </td>

		   <td>
		<select name="idSession" id="idSession" class="input">
		<option value="">Select Session</option>
 		  <?php
		  $sql7="select idSession, session, annee_academique from $tbl_session  ";
		  $req=@mysql_query($sql7);
		  while($row=mysql_fetch_assoc($req)){
		  $ns=ucfirst($row['session']).' '.$row['annee_academique'];
		  $cs=$row['idSession'];
		  ?>
		  <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
		  <?php
		  }
		  ?>
		  </select>
		  </td>
		   <td>&nbsp;</td>

        <td><label for="type ">Type of student: </label></td>
             <td><select name="type" id="type" class="combobox">
                 <option value="0" selected="selected"></option>
                 <option value="Transfer">Transfer</option>
                 <option value="9th Grade">9th Grade</option>
                 <option value="10th Grade">10th Grade</option>
                 <option value="11th Grade">11th Grade</option>
                 <option value="12th Grade">12th Grade</option>
               </select>             </td>
		   </tr>

           <tr>
           </tr>
          <tr>
             <td><label for="parentname">Parent Name :</label>             </td>
             <td><input type="text" name="parentname" id="parentname" class="input"/>             </td>
             <td></td>
             <td><label for="parentphone">Parent Phone :</label>             </td>
             <td><input type="text" name="parentphone" id="parentphone" class="input"/>             </td>
           </tr>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
             <td><label for="parentemail">Parent Email :</label>             </td>
             <td><input type="text" name="parentemail" id="parentemail" class="input"/>             </td>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr> </tr>
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
           <tr>
           <!--  <td><label for="note_math">Grade of Mathematics :</label>             </td>
             <td><input type="text" name="note_math" id="note_math" class="input"/>             </td>
             <td></td>
             <td><label for="elearning">Elearning:</label></td>
             <td><select name="elearning" id="elearning" style="width:200px" class="input">
                 <option value="0"> </option>
                 <option value="1">No</option>
                 <option value="2">Yes</option>
               </select>             </td>
           </tr>-->
           <tr>
             <td colspan="4" height="3px"></td>
           </tr>
         </table></td>
       </tr>
	  </table>
</form>
<?php
}

?>
