<style type="text/css">
  .valider{
    width: 100%;
    background-color: #c16862;
    border-color: #fff;
    color: #fff;
  }
</style>
<?php
 $code_cours=$_GET['number'];
      $type=$_GET['type'];
      $idSession=$_GET['idSession'];
  $wheregrade1=$wheresession='';
  if(!empty($idSession))
 
  	{    $wheresession =$wheresession."and n.idSession='$idSession'";}

if($type == 'BBA' OR $type == 'bba' OR $type == 'bba/bsbe' OR $type == 'bba/bscs/bsbe' OR $type == 'GEN-ED'OR $type== 'bscs' OR $type == 'bsbe')
    {

    $wheregrade1 =$wheregrade1." and n.final_grade<=59 and n.final_grade!=''";
    }
   else if($type == 'mba' OR $type == 'MBA' OR $type == 'mm' OR $type=='mba/mm' OR $type=='%master%' OR $type=='master/mba')
    {
        $wheregrade1 =$wheregrade1." and n.final_grade<=79 and n.final_grade!=''";
    }
   else if($type == 'dba')
    {

     $wheregrade1 =$wheregrade1." and n.final_grade<=79 and n.final_grade!=''";
    }

/* $sql ="SELECT concat(e.prefixe,e.code_inscription)as etud, concat(e.nom, ' ' ,e.prenom) as name,c.code_cours,n.final_grade,n.idSession FROM `tbl_note` as n,tbl_cours as c ,tbl_etudiant_deac as e WHERE e.code_inscription=n.code_inscription and c.`code_cours`=n.`code_cours` and n.code_cours='$code_cours' ".$wheregrade1."
UNION ALL
SELECT concat(e.prefixe,e.code_inscription)as etud, concat(e.nom, ' ' ,e.prenom) as name,c.code_cours,n.final_grade,n.idSession FROM `tbl_note_piimt` as n,tbl_cours as c,tbl_etudiant_deac as e WHERE e.code_inscription=n.code_inscription and c.`code_cours_psi`=n.`code_cours` and c.code_cours='$code_cours' and n.idSession='$idSession'" .$wheregrade1."
UNION ALL
SELECT concat(e.prefixe,e.code_inscription)as etud, concat(e.nom, ' ' ,e.prenom) as name,c.code_cours,n.final_grade,n.idSession FROM `tbl_note_Algeria` as n,tbl_cours as c ,tbl_etudiant_deac as e WHERE e.code_inscription=n.code_inscription and c.`code_cours_psi`=n.`code_cours` and c.code_cours='$code_cours'and n.idSession='$idSession' " .$wheregrade1."
UNION ALL
SELECT concat(e.prefixe,e.code_inscription)as etud, concat(e.nom, ' ' ,e.prenom) as name,c.code_cours,n.final_grade,n.idSession FROM `tbl_note_benin` as n,tbl_cours as c ,tbl_etudiant_deac as e WHERE e.code_inscription=n.code_inscription and c.`code_cours_psi`=n.`code_cours` and c.code_cours='$code_cours' and n.idSession='$idSession'" .$wheregrade1."
UNION ALL
SELECT concat(e.prefixe,e.code_inscription)as etud, concat(e.nom, ' ' ,e.prenom) as name,c.code_cours,n.final_grade,n.idSession FROM `tbl_note_Libya` as n,tbl_cours as c ,tbl_etudiant_deac as e WHERE e.code_inscription=n.code_inscription and c.`code_cours_psi`=n.`code_cours` and c.code_cours='$code_cours' and n.idSession='$idSession' ".$wheregrade1."";*/

$sql ="SELECT concat(e.prefixe,e.code_inscription)as etud, concat(e.nom, ' ' ,e.prenom) as name,c.code_cours,n.final_grade,n.idSession,n.notes,e.code_inscription,e.prefixe,n.professor FROM `tbl_note` as n,tbl_cours as c ,tbl_etudiant_deac as e WHERE e.code_inscription=n.code_inscription and c.`code_cours`=n.`code_cours` and n.code_cours='$code_cours'".$wheresession.$wheregrade1."
UNION ALL
SELECT concat(e.prefixe,e.code_inscription)as etud, concat(e.nom, ' ' ,e.prenom) as name,c.code_cours,n.final_grade,n.idSession,n.notes,e.code_inscription,e.prefixe,n.professor FROM `tbl_note_piimt` as n,tbl_cours as c,tbl_etudiant_deac as e WHERE e.code_inscription=n.code_inscription and c.`code_cours_psi`=n.`code_cours` and c.code_cours='$code_cours'".$wheresession.$wheregrade1."
UNION ALL
SELECT concat(e.prefixe,e.code_inscription)as etud, concat(e.nom, ' ' ,e.prenom) as name,c.code_cours,n.final_grade,n.idSession,n.notes,e.code_inscription,e.prefixe,n.professor FROM `tbl_note_Algeria` as n,tbl_cours as c ,tbl_etudiant_deac as e WHERE e.code_inscription=n.code_inscription and c.`code_cours_psi`=n.`code_cours` and c.code_cours='$code_cours'" .$wheresession.$wheregrade1."
UNION ALL
SELECT concat(e.prefixe,e.code_inscription)as etud, concat(e.nom, ' ' ,e.prenom) as name,c.code_cours,n.final_grade,n.idSession,n.notes,e.code_inscription,e.prefixe,n.professor FROM `tbl_note_benin` as n,tbl_cours as c ,tbl_etudiant_deac as e WHERE e.code_inscription=n.code_inscription and c.`code_cours_psi`=n.`code_cours` and c.code_cours='$code_cours'" .$wheresession.$wheregrade1."
UNION ALL
SELECT concat(e.prefixe,e.code_inscription)as etud, concat(e.nom, ' ' ,e.prenom) as name,c.code_cours,n.final_grade,n.idSession,n.notes,e.code_inscription,e.prefixe,n.professor FROM `tbl_note_Libya` as n,tbl_cours as c ,tbl_etudiant_deac as e WHERE e.code_inscription=n.code_inscription and c.`code_cours_psi`=n.`code_cours` and c.code_cours='$code_cours' ".$wheresession.$wheregrade1."";

      ///var_dump($sql);
?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td width="6%">&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td class="titre" width="94%"><?php echo 'Academic Intervention Report'; ?></td>
  <td width="22%">
    <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
      <tr>



 <td valign="top" align="center" >
     <a href="http://sis.aulm.us/administrator/Statistiques.php?AID"><div class="cancel"></div>

        <?php echo 'BACK';?></a>
      </td>

    </tr>

    </table>

  </td>  </tr> </table>

 <table width="100%" align="center" cellspacing="1"  class="adminlist" style="margin-top:2px">

 <form action="#" method="post" name="adminMenu" >

<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="notefoupasf" value="0" />


  <?php
  $i=0;
     $total = @mysql_query($sql) or die("Failure to select students");

      $url = $_SERVER['PHP_SELF']."?number=&limit=";
      $nblignes = mysql_num_rows($total);
      $nbpages = ceil($nblignes/$parpage);
      $result = validlimit($nblignes,$parpage,$sql);
    ?>
     <tr align="center">
     <th width="43">#</th>
     <th width="30"><?php echo 'Student Code'; ?></th>
     <th width="125"><?php echo 'Student Name '; ?></th>
      <th width="125"><?php echo 'Session'; ?></th>

      <th width="125"><?php echo 'Course Code'; ?></th>
  <th width="125"> <?php echo 'Final Grade '; ?></th>
   <th width="125"><?php echo 'Faculty Name'; ?></th>
      <th width="125"><?php echo 'Coordinator Notes'; ?></th>

     </tr>

    <?php

     while ($ligne = mysql_fetch_array($result)) {
     $i++;
     $etud=$ligne["etud"];
     $ci=$ligne["code_inscription"];
      $prefixe=$ligne["prefixe"];
      $eng=$ligne["eng"];
      $code_cours=$ligne["code_cours"];
      $titre_eng=$ligne["titre_eng"];
         $type=$ligne["type"];
          $etud=$ligne['etud'];
           $name=$ligne['name'];
           $final_grade=$ligne['final_grade'];
             $idSession=$ligne['idSession'];
              $professor=$ligne['professor'];
                       ?>

      <tr height="17px" class="<?php echo $ci; ?>" prefixe="<?php echo $prefixe; ?>">
     <td align="center">&nbsp;<?=$i?></td>

     <td class="gras">&nbsp;<?php   echo $etud;?></td>
     <td>&nbsp;<?php  echo $name; ?></td>

       <td>&nbsp;<?php

 $zin2="select session,annee_academique from tbl_session where idSession='$idSession'";
     $z2= @mysql_query($zin2) or die ('Failure to select branches2');

     $row= mysql_fetch_assoc($z2);

            echo  $session = $row['session'].' '.$row['annee_academique'];

   ?></td>


     <td>&nbsp;<?php    echo $code_cours;?> </td>
       <td>&nbsp;<?php    echo $final_grade;?> </td>
   <!-- <td>&nbsp;<?php
        $prof="select nom_prenom
     from tbl_sondage_affectation as sa,tbl_professeur as p
     where p.code_prof=sa.code_prof and sa.code_cours = '$code_cours' and sa.session = '$sess2'";

      $z3= @mysql_query($prof) or die ('Failure to select branches2');

     $row= mysql_fetch_assoc($z3);

    $nom_prenom = $row['nom_prenom']; echo $nom_prenom;      ?>
  </td> -->
    <td class="td_edit" id="" value="professor">
     <?php echo $ligne["professor"]; ?>
   </td>
   <td class="professor_input_<?php echo $ci; ?>" value="professor" valueancien = "<?php echo $ligne["professor"]; ?>" idSession = "<?php echo $ligne["idSession"]; ?>" prefixe = "<?php echo $prefixe ?>" code_cours = "<?php echo $ligne["code_cours"]; ?>"  style="display:none;">
     <input class="professor_<?php echo $ci; ?>" type="text" maxlength="150" value="<?php echo $ligne["professor"]; ?>" style="width: 100%;" ></input>
     <button class="valider" type="button" value="professor" >Confirm</button>
   </td>


     <td class="td_edit" id="" value="notes">
      <?php echo $ligne["notes"]; ?>
    </td>
    <td class="notes_input_<?php echo $ci; ?>" value="notes" valueancien = "<?php echo $ligne["notes"]; ?>" idSession = "<?php echo $ligne["idSession"]; ?>" prefixe = "<?php echo $prefixe ?>" code_cours = "<?php echo $ligne["code_cours"]; ?>"  style="display:none;">
      <textarea class="notes_<?php echo $ci; ?>" cols="" rows="" name="notes" id="notes" style="width:170; height:20;"><?php echo $ligne["notes"]; ?></textarea>
     <!-- <input type="text" maxlength="150" value="<?php echo $ligne["notes"]; ?>" style="width: 100%;" ></input>-->

      <button class="valider" type="button" value="notes" >Confirm</button>
    </td>



    </tr>
    <?php  } ?>

   </form>

   </table>
  <div id='pagination' align='center'>
         <?php
           echo pagination($url,$parpage,$nblignes,$nbpages);

       ?>
        </div>
        <?php
         ?>
<script type="text/javascript">

  jQuery('body').keyup(function(event){
    if ( event.which == 27 ) {
      var ancien_id = jQuery("#open").parent().attr('class');
      var type = jQuery("#open").attr('value');
      jQuery("."+type+"_input_"+ancien_id).hide();
      jQuery("#open").slideDown();
      jQuery("#open").attr('id','');
      jQuery("#open_input").hide();
      jQuery("#open_input").attr('id','');

    }
    if (event.which == 13) {
      alert("don't use enter to update, please click on 'Confirm' to confirm thank you.");
    }
  });

  jQuery(".td_edit").click(function(){
    var type =  jQuery(this).attr('value');
    var id = jQuery(this).parent().attr('class');
    var ancien_id = jQuery("#open").parent().attr('class');
    jQuery("."+type+"_input_"+ancien_id).hide();
    jQuery("#open").slideDown();
    jQuery("#open").attr('id','');
    jQuery("#open_input").hide();
    jQuery("#open_input").attr('id','');
    jQuery(this).hide();
    var selector = "."+type+"_input_"+id;
    jQuery(selector).slideDown();
    jQuery(selector).attr('id','open_input');
    jQuery(this).attr('id','open');
  });

  jQuery(".valider").click(function(){
      var type =  jQuery(this).attr('value');
      var id = jQuery(this).parent().parent().attr('class');
      var value = jQuery("."+type+"_"+id).val();
      // var value = jQuery("#open_input>input").val();
      var ancien_value = jQuery("#open_input").attr('valueancien');
      var idSession = jQuery("#open_input").attr('idSession');
      var code_cours = jQuery("#open_input").attr('code_cours');
      var prefixe = jQuery("#open_input").attr('prefixe');
      if (ancien_value != value) {
          jQuery.ajax({
              dataType: "html",
              evalscripts:true,
              type: "POST",
              url: 'Statistiques.php?ajaxmod',
              data: ({type:type,id:id,value:value,prefixe:prefixe,idSession:idSession,code_cours:code_cours}),
              beforeSend: function(){

              },
              success: function (data, textStatus){
                  jQuery('#open').html(value);
                  var ancien_id = jQuery("#open").parent().attr('class');
                  var type = jQuery("#open").attr('value');
                  jQuery("."+type+"_input_"+ancien_id).hide();

                  jQuery("#open").slideDown();
                  jQuery("#open").attr('id','');
                  jQuery("#open_input").hide();
                  jQuery("#open_input").attr('id','');

              }
          });
        }else{
          var ancien_id = jQuery("#open").parent().attr('class');
          var type = jQuery("#open").attr('value');
          jQuery("."+type+"_input_"+ancien_id).hide();
          jQuery("#open").slideDown();
          jQuery("#open").attr('id','');
          jQuery("#open_input").hide();
          jQuery("#open_input").attr('id','');
        }

  });


</script>
