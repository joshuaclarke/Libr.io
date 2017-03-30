<?php
 function connectDb(){
      $host = 'iutdoua-web.univ-lyon1.fr'; // ou sql.hebergeur.com
      $user = 'p1612212';      // ou login
      $pwd = '273965';      // ou xxxxxx
      $db = $user ;
  try {
       $bdd = new PDO('mysql:host='.$host.';dbname='.$db.
                      ';charset=utf8', $user, $pwd,
                  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
       return $bdd;
      } catch (Exception $e) {
       exit('Erreur : '.$e->getMessage());
  }
 }
?>

