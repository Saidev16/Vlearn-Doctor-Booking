<?  
    function url_actuelle()
{
     return "http://www." . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
}
	
	 //==============================================================================
     // Fonctions � copier de pr�f�rence dans un fichier 'include/fonctions.inc.php'
     //==============================================================================
    
     function pagination($url,$parpage,$nblignes,$nbpages)
     {
     // On cr�e le code html pour la pagination
     $html = precedent($url,$parpage,$nblignes); // On cr�e le lien precedent
     // On v�rifie que l'on a plus d'une page � afficher
     if ($nbpages > 1) {
     // On boucle sur les num�ros de pages � afficher
     for ($i = 0 ; $i < $nbpages ; ++$i) {
     $limit = $i * $parpage; // On calcule le d�but de la valeur 'limit'
     $limit = $limit.",".$parpage; // On fait une concat�nation avec $parpage
     // On affiche les liens des num�ros de pages
     $url_actuelle=url_actuelle();
     $url_encours="http://localhost/complexe$url$limit";
	 //echo "$url_actuelle-----------http://localhost/complexe$url$limit <br>";
	
	 if ($url_actuelle=="http://localhost/complexe".$url.$limit)
	 {
	 	$html .= "".($i + 1)." | ";
        
	 }
	
	 else {
    	 $html .= "<a href=".$url.$limit.">".($i + 1)."</a> | " ;
          
		 }
     }
     }
     else {
     $html .= "";
     }
     $html .= suivant($url,$parpage,$nblignes); // On cr�e le lien suivant
     // On retourne le code html
     return $html;
     }
     
	 
	 
	 
	 
	 function validlimit($nblignes,$parpage,$sql)
     {
     // On v�rifie l'existence de la variable $_GET['limit']
     // $limit correspond � la clause LIMIT que l'on ajoute � la requ�te $sql
     if (isset($_GET['limit'])) {
     $pointer = split('[,]', $_GET['limit']); // On scinde $_GET['limit'] en 2
     $debut = $pointer[0];
     $fin = $pointer[1];
     // On v�rifie la conformit� de la variable $_GET['limit']
     if (($debut >= 0) && ($debut < $nblignes) && ($fin == $parpage)) {
     // Si $_GET['limit'] est valide on lance la requ�te pour afficher la page
     $limit = $_GET['limit']; // On r�cup�re la valeur 'limit' pass�e par url
     $sql .= " LIMIT ".$limit.";"; // On ajoute $limit � la requ�te $sql
     $result = mysql_query($sql); // Nouveau r�sultat de la requ�te
     }
     // Sinon on affiche la premi�re page
     else {
     $sql .= " LIMIT 0,".$parpage.";"; // On ajoute la valeur LIMIT � la requ�te
     $result = mysql_query($sql); // Nouveau r�sultat de la requ�te
     }
     }
     // Si la valeur 'limit' n'est pas connue, on affiche la premi�re page
     else {
     $sql .= " LIMIT 0,".$parpage.";"; // On ajoute la valeur LIMIT � la requ�te
     $result = mysql_query($sql); // Nouveau r�sultat de la requ�te
     }
     // On retourne le r�sultat de la requ�te
     return $result;
     }
    
	
	
	 function precedent($url,$parpage,$nblignes)
     {
     // On v�rifie qu'il y a au moins 2 pages � afficher
     if ($nblignes > $parpage) {
     // On v�rifie l'existence de la variable $_GET['limit']
     if (isset($_GET['limit'])) {
     // On scinde la variable 'limit' en utilisant la virgule comme s�parateur
     $pointer = split('[,]', $_GET['limit']);
     // On r�cup�re le nombre avant la virgule et on soustrait la valeur $parpage
     $pointer = $pointer[0]-$parpage;
     // Si on atteint la premi�re page, pas besoin de lien 'Pr�c�dent'
     if ($pointer < 0) {
     $precedent = "";
     }
     // Sinon on affiche le lien avec l'url de la page pr�c�dente
     else {
     $limit = "$pointer,$parpage";
     $precedent = "<a href=".$url.$limit.">pr�cedent</a> | ";
     }
     }
     else {
     $precedent = ""; // On est � la premi�re page, pas besoin de lien 'Pr�c�dent'
     }
     }
     else {
     $precedent = ""; // On a qu'une page, pas besoin de lien 'Pr�c�dent'
     }
     return $precedent;
     }
    
	
	
	 function suivant($url,$parpage,$nblignes)
     {
     // On v�rifie qu'il y a au moins 2 pages � afficher
     if ($nblignes > $parpage) {
     // On v�rifie l'existence de la variable $_GET['limit']
     if (isset($_GET['limit'])) {
     // On scinde la variable 'limit' en utilisant la virgule comme s�parateur
     $pointer = split('[,]', $_GET['limit']);
     // On r�cup�re le nombre avant la virgule auquel on ajoute la valeur $parpage
     $pointer = $pointer[0] + $parpage;
     // Si on atteint la derni�re page, pas besoin de lien 'Suivant'
     if ($pointer >= $nblignes) {
     $suivant = "";
     }
     // Sinon on affiche le lien avec l'url de la page suivante
     else {
     $limit = "$pointer,$parpage";
     $suivant = "<a class='pagination' href=".$url.$limit.">suivant</a>";
     }
     }
     // Si pas de valeur 'limit' on affiche le lien de la deuxi�me page
     if (@$_GET['limit']== false) {
     $suivant = "<a href=".$url.$parpage.",".$parpage.">suivant</a>";
     }
     }
     else {
     $suivant = ""; // On a qu'une page, pas besoin de lien 'Suivant'
     }
     return $suivant;
     }
     // Fin du script
	 

	 ?>