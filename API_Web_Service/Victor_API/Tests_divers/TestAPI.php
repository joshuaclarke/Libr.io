<?php
  header('Content-Type: application/json');
  function connectDb(){
      $host = 'iutdoua-web.univ-lyon1.fr'; // ou sql.hebergeur.com
      $user = 'p1612212';      // ou login
      $pwd = '273965';      // ou xxxxxx
      $db = 'p1612212';
  try {
       $bdd = new PDO('mysql:host='.$host.';dbname='.$db.
                      ';charset=utf8', $user, $pwd,
                  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
       return $bdd;
      } catch (Exception $e) {
       exit('Erreur : '.$e->getMessage());
  }
 }
/*************************************************************************/
/*                     Creation de la raquête SQL                        */
/*************************************************************************/


  $search = isset($_POST['search']) ? $_POST['search'] : '';

  $requete='select * from CONTENU where nom='.$search;
  if()

  $bdd = connectDb();
  $query = $bdd -> prepare($requete);
  $query->execute(); // paramètres et exécution
  $all = [];
  while ($data = $query->fetch()) // lecture par ligne
  {
    $all[] = $data; //  ajout dans un tableau au fur et à mesure
  }
  echo json_encode($all);
 $query->closeCursor();

?>
