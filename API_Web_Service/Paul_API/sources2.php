<?php
require_once("connexion_bdd.php");

$bdd = connectDb();

$url = 'http://api.jamendo.com/v3.0/tracks/?client_id=709fa152';
$content = file_get_contents($url);
$json = json_decode($content, true);

foreach($json['results'] as $item) {
    $licence=$item['license_ccurl'];
    $type='Musique';
    $nom=$item['name'];
    $description="";
    $url=$item['audio'];
    $auteur=$item['artist_name'];
    $image=$item['album_image'];
    $cat =  array();
    $cat[0]=$cat[1]=$cat[2]="Musique";

    update($bdd,$licence,$type,$nom,$description,$url,$auteur,$image,$cat);
    print "<img src='".$image."'/>'";
}

function update($bdd,$licence,$type,$nom,$description,$url,$auteur,$image,$cat){
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
  $query = $bdd->prepare('INSERT INTO CONTENU(url,nom,description,image,fkIdLicence,fkIdTypeContenu,fkIdAuteur,fkIdSousTheme) VALUES(?,?,?,?,?,?,?,?)'); // requête SQL
  $query->execute(array($url,$nom,$description,$image,$idLicense,$fkIdTypeContenu,$idAuteur,$idSousTheme)); // paramètres et exécution
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

<hr/>

/*


SimpleXMLElement Object (
  [id] => urn:bicbucstriim:https://framabookin.org/b/opds/titles/1848
  [title] => Germaine
  [updated] => 2015-06-04T09:59:30+02:00
  [author] => SimpleXMLElement Object (
        [name] => About, Edmond )
  [content] => Extrait : L'assemblée se récria sur la naïveté du bonhomme qui enterrait ses écus tout vifs, au lieu de les faire travailler. Quinze ou seize exclamations s'élevèrent en même temps. Chacun dit son mot, trahit son secret, enfourcha son dada, secoua sa marotte. Chacun frappa sur sa poche et caressa bruyamment les espérances certaines, le bonheur clair et liquide qu'il avait emboursé le matin. L'or mêlait sa petite voix aiguë à ce concert de passions vulgaires~; et le cliquetis des pièces de vingt francs, plus capiteux que la fumée du vin ou l'odeur de la poudre, enivrait ces pauvres cervelles et accélérait le battement de ces cœurs grossiers.
  [link] => Array (
        [0] => SimpleXMLElement Object ( [@attributes] => Array (
          [href] => https://framabookin.org/b/data/titles/thumb_1848.png
          [type] => image/png
          [rel] => http://opds-spec.org/image/thumbnail ) )
        [1] => SimpleXMLElement Object ( [@attributes] => Array (
          [href] => https://framabookin.org/b/opds/titles/1848/cover/
          [type] => image/jpeg
          [rel] => http://opds-spec.org/image ) )
        [2] => SimpleXMLElement Object ( [@attributes] => Array (
          [href] => https://framabookin.org/b/opds/titles/1848/file/Germaine+-+Edmond+About.epub
          [type] => application/epub+zip
          [rel] => http://opds-spec.org/acquisition ) )
        [3] => SimpleXMLElement Object ( [@attributes] => Array (
        [href] => https://framabookin.org/b/opds/titles/1848/file/Germaine+-+Edmond+About.pdf
        [type] => application/pdf [rel] => http://opds-spec.org/acquisition ) ) )
  [category] => Array (
      [0] => SimpleXMLElement Object ( [@attributes] => Array (
        [term] => fiction
        [label] => fiction ) )
      [1] => SimpleXMLElement Object ( [@attributes] => Array (
        [term] => classique
        [label] => classique ) )
      [2] => SimpleXMLElement Object ( [@attributes] => Array (
        [term] => Europe
        [label] => Europe ) )
      [3] => SimpleXMLElement Object ( [@attributes] => Array (
        [term] => France
        [label] => France ) ) ) )
*/
