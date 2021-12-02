<?php
		$filiere=$annee=$where=$code_inscription='';  
	
	    if((isset($_POST['tous'])) && (!empty($_POST['tous']))){

	    $filiere=$annee=$where='';
	   unset($_SESSION['filiere']);
	   unset($_SESSION['annee_etude']);
	   }

															   

	if( (isset($_POST['filiere'])) && (!empty($_POST['filiere'])) ){
							$filiere = $_POST['filiere'];
							$_SESSION['filiere']=$filiere;
							$where = $where." and e.filiere='". $filiere."'";
																					   }

																					   

							else if( (isset($_POST['filiere'])) && (empty($_POST['filiere'])) ){
  	                          unset($_SESSION['filiere']);
 						                                                                       }

																					   

						else if( (isset($_SESSION['filiere'])) && (!empty($_SESSION['filiere'])) ){
							   $filiere = $_SESSION['filiere'];
  	                           $where = $where." and e.filiere='". $_SESSION['filiere']."'";
						                                                                            }

									//année d'�tude  comme critère

																									

							 if( (isset($_POST['annee_etude'])) && (!empty($_POST['annee_etude'])) ){
								$annee = $_POST['annee_etude'];
								$_SESSION['annee_etude']=$annee;
								$where =$where." and  e.annee = '".$annee."'";
                                                                }

					else if( (isset($_POST['annee_etude'])) && (empty($_POST['annee_etude'])) ){
  	                                                  unset($_SESSION['annee_etude']);
						                                                                       }



				else if( (isset($_SESSION['annee_etude'])) && (!empty($_SESSION['annee_etude'])) ){
								   $annee = $_SESSION['annee_etude'];
  	                               $where = $where." and  e.annee = '".$annee ."'";
						                                                                          }

                        

        
         $sql="select e.code_inscription, concat(e.nom,' ',e.prenom ) as name, f.nom_filiere, e.annee
		   from $tbl_filiere as f, $tbl_etudiant as e
           where e.filiere=f.id_filiere ". $where. "order by name";
		   
?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
    <tr>
        <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
        <td width="78%" class="titre">&nbsp;GESTION DES BULETINS
        </td>
        <td width="8%">

            <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >

                <tr>
                    
                    <td valign="top" align="center">

                        <a href="#"

                           onclick="javascript:if(document.adminMenu.boxchecked.value==0)

                               {

                                   alert('Veuillez sélectionnez un étudiant??');

                               }

                               else

                               {

                                   chemin=document.adminMenu.boxchecked.value;

                                   chemin='gestion_des_buletins.php?code_inscription='+chemin;

                                   window.location.replace(chemin);

                               }"><div class="detail"></div>Buletin</a>
                    </td>
					<td valign="top" align="center" >
                        <a href="gestion_des_buletins.php?buletin_model=default" >
						<div class="ajouter"></div>model</a>
                    </td>
					<td valign="top" align="center" >
                        <a href="#" onclick="window.print()"><div class="imprimer"></div>Imprimer</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%" align="center" cellspacing="1" border="0"  class="adminlist" >
    <form action="#" method="post" name="adminMenu" >
        <input type="hidden" name="boxchecked" value="0" />
        <div class="container_search">
     
	  
	   <select name="code_inscription" class="search">
                <option value="0">RECHERCHE PAR NOM</option>
                <?php
                $sql1="select code_inscription, concat(nom, ' ', prenom ) as name from $tbl_etudiant ORDER BY NAME";
                $req=mysql_query($sql1);
                while($row=mysql_fetch_assoc($req)){
                    $ci=htmlentities($row['code_inscription']);
					$name=htmlentities($row['name']);
                    ?>
               <option value="<?=$ci?>" <?=($code_inscription==$ci)  ? $selected : ''?>>&nbsp;<?=$name?></option>
                <?php
				}
				?>
            </select>
			
			 <select name="annee_etude" class="search">
		<option value="">RECHERCHE PAR ANNEE</option>
        <option value="1" <?=($annee==1) ? $selected : '' ?>>1.annee</option>
        <option value="2" <?=($annee==2) ? $selected : '' ?>>2.annee</option>
        <option value="3" <?=($annee==3) ? $selected : '' ?>>3.annee</option>
        <option value="4" <?=($annee==4) ? $selected : '' ?>>4.annee</option>
        <option value="5" <?=($annee==5) ? $selected : '' ?>>5.annee</option>
        <option value="master" <?=($annee=='master') ? $selected : '' ?>>master</option>
	  </select>

                 <select name="filiere" class="search">
                <option value="0">RECHERCHE PAR FILIERE</option>
                <?php
                $sql2="select id_filiere, nom_filiere from $tbl_filiere where archive=0";
                $req=mysql_query($sql2);
                while($row=mysql_fetch_assoc($req)){
                    $if=htmlentities($row['id_filiere']);
					$nf=htmlentities($row['nom_filiere']);
                    ?>
               <option value="<?=$if?>" <?=($filiere==$if)  ? $selected : ''?>>&nbsp;<?=$nf?></option>
                <?php
				}
				?>
            </select>
			
            <input type="submit" vname="valider" value="valider" class="input"  />
            <input type="submit" value="Afficher tous" name="tous" class="input"  />
        </div>

        <tr height="17px" align="center">
            <th width="25">#</th>
            <th width="25">&nbsp;</th>
            <th width="100">Code inscription</th>
            <th width="350">Nom et pr&eacute;nom</th>
			<th width="75">Annee</th>
            <th width="350">Filiere</th>
        </tr>
        <?php
        $i=0;
        $total = @mysql_query($sql) or die("erreur lors de selection des etudiants");
        $url = $_SERVER['PHP_SELF']."?limit=";
        $nblignes = mysql_num_rows($total);
        $nbpages = ceil($nblignes/$parpage);
        $result = validlimit($nblignes,$parpage,$sql);
        while ($ligne = mysql_fetch_array($result)) {
        $i++;
	    $ci=$ligne["code_inscription"];
			?>

        <tr height="17px">
            <td align="center"><?=$i?></td>
            <td align="center"><input type="radio" id="<?=$ci?>" name="id" value="<?=$ci?>" 
			onClick="document.adminMenu.boxchecked.value='<?=$ci?>'" /></td>
            <td align="center" class="gras">&nbsp;<?=substr($ci, 0, 11)?></td>
            <td align="left">&nbsp;<?=htmlentities($ligne["name"])?></td>
			<td align="center">&nbsp;<?=htmlentities($ligne["annee"])?></td>
			<td align="left">&nbsp;<?=htmlentities($ligne["nom_filiere"])?></td>
        </tr>
            <?php
			}
			?>
    </form>
</table>
		<?php
		echo "<div id='pagination' align='center'>";
		echo pagination($url,$parpage,$nblignes,$nbpages);
		echo "</div>";
		?>