<?php
function update($bdd,$licence,$type,$nom,$description,$url,$auteur,$image,$cat,$date){
  $query = $bdd->prepare('SELECT COUNT(*) FROM LICENSE WHERE nomLicence=?'); // requête SQL
  $query->execute(array($licence)); // paramètres et exécution
  if($query->fetch()['COUNT(*)']==0){
    $query = $bdd->prepare('INSERT INTO LICENSE(nomLicence) VALUES(?)'); // requête SQL
    $query->execute(array($licence)); // paramètres et exécution
    $query->closeCursor();
  }
  $query = $bdd->prepare('SELECT idLicense FROM LICENSE WHERE nomLicence=?'); // requête SQL
  $query->execute(array($licence)); // paramètres et exécution
  $idLicense=$query->fetch()['idLicense'];
  $query->closeCursor();

  //INSERTION DU TYPE DE CONTENU
  $query = $bdd->prepare('SELECT COUNT(*) FROM TYPECONTENU WHERE nomContenu=?'); // requête SQL
  $query->execute(array($type)); // paramètres et exécution
  if($query->fetch()['COUNT(*)']==0){
    $query = $bdd->prepare('INSERT INTO TYPECONTENU(nomContenu) VALUES(?)'); // requête SQL
    $query->execute(array($type)); // paramètres et exécution
    $query->closeCursor();
  }
  $query = $bdd->prepare('SELECT idTypeContenu FROM TYPECONTENU WHERE nomContenu=?'); // requête SQL
  $query->execute(array($type)); // paramètres et exécution
  $fkIdTypeContenu=$query->fetch()['idTypeContenu'];
  echo $fkIdTypeContenu;
  $query->closeCursor();

    // AUTEUR
    $query = $bdd->prepare('SELECT COUNT(*) FROM AUTEUR WHERE nomAuteur=?'); // requête SQL
    $query->execute(array($auteur)); // paramètres et exécution
    if($query->fetch()['COUNT(*)']==0){
      $query = $bdd->prepare('INSERT INTO AUTEUR(nomAuteur) VALUES(?)'); // requête SQL
      $query->execute(array($auteur)); // paramètres et exécution
      $query->closeCursor();
    }
    $query = $bdd->prepare('SELECT 	idAuteur FROM AUTEUR WHERE nomAuteur=?'); // requête SQL
    $query->execute(array($auteur)); // paramètres et exécution
    $idAuteur=$query->fetch()['idAuteur'];
    $query->closeCursor();

    //CATEGORIE
    $categorie=$cat[2];
    $query = $bdd->prepare('SELECT COUNT(*) FROM CATEGORIE WHERE nomCategorie=?'); // requête SQL
    $query->execute(array($categorie)); // paramètres et exécution
    if($query->fetch()['COUNT(*)']==0){
      $query = $bdd->prepare('INSERT INTO CATEGORIE(nomCategorie) VALUES(?)'); // requête SQL
      $query->execute(array($categorie)); // paramètres et exécution
      $query->closeCursor();
    }
    $query = $bdd->prepare('SELECT idCategorie FROM CATEGORIE WHERE nomCategorie=?'); // requête SQL
    $query->execute(array($categorie)); // paramètres et exécution
    $idCategorie=$query->fetch()['idCategorie'];
    $query->closeCursor();

    $theme=$cat[1];
    $query = $bdd->prepare('SELECT COUNT(*) FROM THEME WHERE nomTheme=?'); // requête SQL
    $query->execute(array($theme)); // paramètres et exécution
    if($query->fetch()['COUNT(*)']==0){
      $query = $bdd->prepare('INSERT INTO THEME(nomTheme,fkIdCategorie) VALUES(?,?)'); // requête SQL
      $query->execute(array($theme,$idCategorie)); // paramètres et exécution
      $query->closeCursor();
    }
    $query = $bdd->prepare('SELECT idTheme FROM THEME WHERE nomTheme=?'); // requête SQL
    $query->execute(array($theme)); // paramètres et exécution
    $idTheme=$query->fetch()['idTheme'];
    $query->closeCursor();

    $soustheme=$cat[0];
    $query = $bdd->prepare('SELECT COUNT(*) FROM SOUSTHEME WHERE nomSousTheme=?'); // requête SQL
    $query->execute(array($soustheme)); // paramètres et exécution
    if($query->fetch()['COUNT(*)']==0){
      $query = $bdd->prepare('INSERT INTO SOUSTHEME(nomSousTheme,fkIdTheme) VALUES(?,?)'); // requête SQL
      $query->execute(array($soustheme,$idTheme)); // paramètres et exécution
      $query->closeCursor();
    }
    $query = $bdd->prepare('SELECT idSousTheme FROM SOUSTHEME WHERE nomSousTheme=?'); // requête SQL
    $query->execute(array($soustheme)); // paramètres et exécution
    $idSousTheme=$query->fetch()['idSousTheme'];
    $query->closeCursor();

  //INSERTION FINALE DU CONTENU
  $query = $bdd->prepare('INSERT INTO CONTENU(url,nom,description,image,dateCree,fkIdLicence,fkIdTypeContenu,fkIdAuteur,fkIdSousTheme) VALUES(?,?,?,?,?,?,?,?,?)'); // requête SQL
  $query->execute(array($url,$nom,$description,$image,$date,$idLicense,$fkIdTypeContenu,$idAuteur,$idSousTheme)); // paramètres et exécution
  $query->closeCursor();
}
/*






    // NOM

      // CATEGORIES
      $cat =  array();
      foreach($item->category as $a){
        $cat[]=(string)($a->attributes()->term);
      }

      $categorie=$cat[2];
      $query = $bdd->prepare('SELECT COUNT(*) FROM CATEGORIE WHERE nomCategorie=?'); // requête SQL
      $query->execute(array($categorie)); // paramètres et exécution
      if($query->fetch()['COUNT(*)']==0){
        $query = $bdd->prepare('INSERT INTO CATEGORIE(nomCategorie) VALUES(?)'); // requête SQL
        $query->execute(array($categorie)); // paramètres et exécution
        $query->closeCursor();
      }
      $query = $bdd->prepare('SELECT idCategorie FROM CATEGORIE WHERE nomCategorie=?'); // requête SQL
      $query->execute(array($categorie)); // paramètres et exécution
      $idCategorie=$query->fetch()['idCategorie'];
      echo $idCategorie;
      echo '<br/>';
      $query->closeCursor();

      $theme=$cat[1];
      $query = $bdd->prepare('SELECT COUNT(*) FROM THEME WHERE nomTheme=?'); // requête SQL
      $query->execute(array($theme)); // paramètres et exécution
      if($query->fetch()['COUNT(*)']==0){
        $query = $bdd->prepare('INSERT INTO THEME(nomTheme,fkIdCategorie) VALUES(?,?)'); // requête SQL
        $query->execute(array($theme,$idCategorie)); // paramètres et exécution
        $query->closeCursor();
      }
      $query = $bdd->prepare('SELECT idTheme FROM THEME WHERE nomTheme=?'); // requête SQL
      $query->execute(array($theme)); // paramètres et exécution
      $idTheme=$query->fetch()['idTheme'];
      echo $idTheme;
      echo '<br/>';
      $query->closeCursor();

      $soustheme=$cat[0];
      $query = $bdd->prepare('SELECT COUNT(*) FROM SOUSTHEME WHERE nomSousTheme=?'); // requête SQL
      $query->execute(array($soustheme)); // paramètres et exécution
      if($query->fetch()['COUNT(*)']==0){
        $query = $bdd->prepare('INSERT INTO SOUSTHEME(nomSousTheme,fkIdTheme) VALUES(?,?)'); // requête SQL
        $query->execute(array($soustheme,$idTheme)); // paramètres et exécution
        $query->closeCursor();
      }
      $query = $bdd->prepare('SELECT idSousTheme FROM SOUSTHEME WHERE nomSousTheme=?'); // requête SQL
      $query->execute(array($soustheme)); // paramètres et exécution
      $idSousTheme=$query->fetch()['idSousTheme'];
      echo $idSousTheme;
      echo '<br/>';
      $query->closeCursor();


    }
	}
}*/

?>
