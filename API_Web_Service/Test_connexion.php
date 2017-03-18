<?php
function connectDb(){
     $host="iutdoua-oracle.univ-lyon1.fr"; // ou sql.hebergeur.com
     $user="p1409577";      // ou login
     $password="217168";      // ou xxxxxx
     $dbname="@iutdoua-oracle.univ-lyon1.fr";
 try {
      $bdd=new PDO('mysql:host='.$host.';dbname='.$dbname.
                   ';charset=utf8',$user,$password);
      return $bdd;
     } catch (Exception $e) {
      die('Erreur : '.$e->getMessage());
 }
}

  $bdd = connectDb(); //connexion à la BDD
  $query = $bdd->prepare('select * from CDROM'); // requête SQL
  $query->execute(...); // paramètres et exécution
  while($data = $query->fetch()) { // lecture par ligne
     // traitement de l'enregistrement
  } // fin des données

$query->closeCursor();

?>
