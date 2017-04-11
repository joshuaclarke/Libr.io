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


  $search = isset($_GET['search']) ? $_GET['search'] : '';
  $bdd = connectDb();
  // $query = $bdd -> prepare('select * from CONTENU where UPPER(nom)=UPPER(:search)');
  // $query = $bdd -> prepare('select * from CONTENU where :search rlike ".*"');
  $query = $bdd -> prepare('SELECT nom, nomAuteur, nomContenu, noteMoyenne
FROM CONTENU
  INNER JOIN AUTEUR
    ON CONTENU.fkIdAuteur = AUTEUR.idAuteur
  INNER JOIN TYPECONTENU
    ON CONTENU.fkIdTypeContenu = TYPECONTENU.idTypeContenu
WHERE UPPER(nom) like UPPER(\'%:search%\')
      OR nom SOUNDS LIKE \':search'
      OR UPPER(nomAuteur) like UPPER(\'%:search%\')
      OR nomAuteur SOUNDS LIKE \':search\'');
  $query->execute(array('search1' => $search,'search2' => $search,'search3' => $search,'search4' => $search )); // paramètres et exécution
  $all = [];
  while ($data = $query->fetch()) // lecture par ligne
  {
    $all[] = $data; //  ajout dans un tableau au fur et à mesure
  }
  echo json_encode($all);
 $query->closeCursor();

?>
