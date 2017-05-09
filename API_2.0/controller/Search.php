<?php
/**
 *    Libr.io
 *    API_Web_Service_2.0
 *    Class Search (Controlleur de recherche)
 *    Victor LAURENT 11409577
 */

require_once (ROOT.'/model/Contenu.php');
require_once (ROOT.'/model/Auteur.php');
class Search
{
    public function test($test)
    {
        echo json_encode("Ca marche !!!   ".$test);
    }

    public function searchAll($search)
    {
        $tabData = [];
        $contenu = new Contenu();
        $tabData[] = $contenu->getByName($search);
        $auteur = new Auteur();
        $tabData[] = $auteur->getByName($search);
        echo json_encode($tabData);
    }

    public function searchAuthorByName($name)
    {
        $auteur = new Auteur();
        $tabAuteur = $auteur->getByName($name);
        echo json_encode($tabAuteur);
    }



}
