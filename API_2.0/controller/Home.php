    <?php
/**
 *    Libr.io
 *    API_Web_Service_2.0
 *    Class Home (Controlleur de la page d'acceuil)
 *    Victor LAURENT 11409577
 */

require_once (ROOT.'/model/Contenu.php');
require_once (ROOT.'/model/Auteur.php');

class Home
{
    public function topTen()
    {
        $list = new Contenu();
        $tabData = $list->getTopTen();
        echo json_encode($tabData);
    }
}
