<?php
require_once("connexion_bdd.php");
require_once("script.php");

$bdd = connectDb();

$url = 'http://api.jamendo.com/v3.0/tracks/?client_id=709fa152&limit=200';
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
    $date=$item['releasedate'];

    update($bdd,$licence,$type,$nom,$description,$url,$auteur,$image,$cat,$date);
    print "<img src='".$image."'/>'";
}


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
