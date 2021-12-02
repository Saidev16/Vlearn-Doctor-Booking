<span id="titre_page">Request</span>
<div id="contenu"><br />
<table width="575s" border="0" cellspacing="0" cellpadding="0" id="tbl_demande">
<form name="demande" action="student.php" method="post" >
<input type="hidden" name="code" value="<?=$code_etudiant?>" />
<input type="hidden" name="action" value="requette">
<input type="hidden" name="token" value="<?=$_SESSION['token']?>">

  <tr>
    <td colspan="4" style="text-align:justify; padding-top:5px">
	To address effectively your requests for certain administrative services, and to monitor them, please fill out this form before sending it to the administration. Thank you.
	<hr align="center" />
	 </td>
  </tr>
  <tr><td>
   <!-- <input type="text" name="date" value="<?=date('Y-m-d')?>"  readonly="yes" style="border:#FFFFFF 1px solid; font-size:11px" />-->
  <b>Name :</b><input type="text" name="nom" value="<?=$_SESSION['name']?>"  readonly="yes" style="border:#FFFFFF 1px solid; font-size:11px" />
   </td></tr>
  <tr>
      <td > <b>Date :</b></td></tr>
        <tr>
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
        </select> 
                &nbsp; <select name="year_i" id="year_i" class="input">
      <?php for ($i=date('Y')-5; $i<2025; $i++){?>
      <option value="<?=$i?>" <?=(date('m')==$i) ? $selected : '' ?>><?=$i?></option>
      <?php
      }
      ?>
      </select>
                      </td>
</tr>
                      
   <tr>
    <td align="left" colspan="4"><hr align="center" /><b>Subject :</b><br /></td>
  </tr>
   <tr>
    <td align="left" colspan="4"><input type="radio" name="objet" id="absence" value="Absence" />Absence</td>
  </tr>
  <tr>
    <td align="left" colspan="4"><input type="radio" name="objet" value="Conflict/Grade" />Conflict/Grade</td>
  </tr>
  <tr>
    <td align="left" colspan="4"><input type="radio" name="objet" value="Conflict/Other" />Conflict/Other </td>
  </tr>
  <tr>
    <td align="left" colspan="4"><input type="radio" name="objet" value="IT Technical Problem" />IT Technical Problem  </td>
  </tr>
   <tr>
    <td align="left" colspan="4"> 
	<input type="radio" name="objet" value="Social Services" />Social Services    </td></tr>
  <tr>
    <td align="left" colspan="4"> 
	<input type="radio" name="objet" value="Plagiarism" />Plagiarism    </td></tr>
	<tr>
    <td align="left" colspan="4"> 
	<input type="radio" name="objet" value="Misconduct"  />Misconduct   </td> </tr>
 
  <tr>
    <td align="left" colspan="4"><input type="radio" name="objet" value="other" />Other</td>
  </tr>
   <tr>
    <td align="left" colspan="4"> 
	<input type="radio" name="objet" value="Covid-19 Impact" />Covid-19 Impact </td></tr>
  <tr>
	  <td colspan="4" align="left" style="padding-bottom:10px">
	  <hr align="center" />
	 Detailed explanation of your request / complaint (You can attach an additional sheet to this if necessary):
	 </td>
</tr>
<tr>
  <td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px">
  <tr>
    <td align="left"><textarea cols="60" rows="3" name="explication" class="text_area"></textarea></td>
  </tr>
</table>

  </td></tr>
 	<tr height="15"><td colspan="4" align="right">
	<input type="submit" value="Submit" class="bouton"  />&nbsp;
	<input type="reset" value="Cancel"  class="bouton" />
	&nbsp;</td></tr>
</form>
</table>