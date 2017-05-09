<?php
/**
 *    Libr.io
 *    API_Web_Service_2.0
 *    Class List (Controlleur de Liste)
 *    Victor LAURENT 11409577
 */

require_once (ROOT.'/model/Contenu.php');
require_once (ROOT.'/model/Auteur.php');
class Liste
{
    public function listContenu()
    {
        $list = new Contenu();
        $tabData = $list->getAll();
        echo json_encode($tabData);
    }
    public function listAuteur()
    {
        $list = new Auteur();
        $tabData = $list->getAll();
        echo json_encode($tabData);
    }

    

}
