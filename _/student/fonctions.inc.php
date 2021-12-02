<?  
    function url_actuelle()
{
     return "http://www." . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
}
	
	 //==============================================================================
     // Fonctions à copier de préférence dans un fichier 'include/fonctions.inc.php'
     //==============================================================================
    
     function pagination($url,$parpage,$nblignes,$nbpages)
     {
     // On crée le code html pour la pagination
     $html = precedent($url,$parpage,$nblignes); // On crée le lien precedent
     // On vérifie que l'on a plus d'une page à afficher
     if ($nbpages > 1) {
     // On boucle sur les numéros de pages à afficher
     for ($i = 0 ; $i < $nbpages ; ++$i) {
     $limit = $i * $parpage; // On calcule le début de la valeur 'limit'
     $limit = $limit.",".$parpage; // On fait une concaténation avec $parpage
     // On affiche les liens des numéros de pages
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
     $html .= suivant($url,$parpage,$nblignes); // On crée le lien suivant
     // On retourne le code html
     return $html;
     }
     
	 
	 
	 
	 
	 function validlimit($nblignes,$parpage,$sql)
     {
     // On vérifie l'existence de la variable $_GET['limit']
     // $limit correspond à la clause LIMIT que l'on ajoute à la requête $sql
     if (isset($_GET['limit'])) {
     $pointer = split('[,]', $_GET['limit']); // On scinde $_GET['limit'] en 2
     $debut = $pointer[0];
     $fin = $pointer[1];
     // On vérifie la conformité de la variable $_GET['limit']
     if (($debut >= 0) && ($debut < $nblignes) && ($fin == $parpage)) {
     // Si $_GET['limit'] est valide on lance la requête pour afficher la page
     $limit = $_GET['limit']; // On récupère la valeur 'limit' passée par url
     $sql .= " LIMIT ".$limit.";"; // On ajoute $limit à la requête $sql
     $result = mysql_query($sql); // Nouveau résultat de la requête
     }
     // Sinon on affiche la première page
     else {
     $sql .= " LIMIT 0,".$parpage.";"; // On ajoute la valeur LIMIT à la requête
     $result = mysql_query($sql); // Nouveau résultat de la requête
     }
     }
     // Si la valeur 'limit' n'est pas connue, on affiche la première page
     else {
     $sql .= " LIMIT 0,".$parpage.";"; // On ajoute la valeur LIMIT à la requête
     $result = mysql_query($sql); // Nouveau résultat de la requête
     }
     // On retourne le résultat de la requête
     return $result;
     }
    
	
	
	 function precedent($url,$parpage,$nblignes)
     {
     // On vérifie qu'il y a au moins 2 pages à afficher
     if ($nblignes > $parpage) {
     // On vérifie l'existence de la variable $_GET['limit']
     if (isset($_GET['limit'])) {
     // On scinde la variable 'limit' en utilisant la virgule comme séparateur
     $pointer = split('[,]', $_GET['limit']);
     // On récupère le nombre avant la virgule et on soustrait la valeur $parpage
     $pointer = $pointer[0]-$parpage;
     // Si on atteint la première page, pas besoin de lien 'Précédent'
     if ($pointer < 0) {
     $precedent = "";
     }
     // Sinon on affiche le lien avec l'url de la page précédente
     else {
     $limit = "$pointer,$parpage";
     $precedent = "<a href=".$url.$limit.">précedent</a> | ";
     }
     }
     else {
     $precedent = ""; // On est à la première page, pas besoin de lien 'Précédent'
     }
     }
     else {
     $precedent = ""; // On a qu'une page, pas besoin de lien 'Précédent'
     }
     return $precedent;
     }
    
	
	
	 function suivant($url,$parpage,$nblignes)
     {
     // On vérifie qu'il y a au moins 2 pages à afficher
     if ($nblignes > $parpage) {
     // On vérifie l'existence de la variable $_GET['limit']
     if (isset($_GET['limit'])) {
     // On scinde la variable 'limit' en utilisant la virgule comme séparateur
     $pointer = split('[,]', $_GET['limit']);
     // On récupère le nombre avant la virgule auquel on ajoute la valeur $parpage
     $pointer = $pointer[0] + $parpage;
     // Si on atteint la dernière page, pas besoin de lien 'Suivant'
     if ($pointer >= $nblignes) {
     $suivant = "";
     }
     // Sinon on affiche le lien avec l'url de la page suivante
     else {
     $limit = "$pointer,$parpage";
     $suivant = "<a class='pagination' href=".$url.$limit.">suivant</a>";
     }
     }
     // Si pas de valeur 'limit' on affiche le lien de la deuxième page
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