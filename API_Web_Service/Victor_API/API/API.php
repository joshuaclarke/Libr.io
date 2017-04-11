<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
class apiLibrio{

    public function __construct()
    {
        $this->pdo = $this->connectDb();
    }

    private function connectDb(){
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

    private function getContenu()
    {
        $idContenu =isset($_GET['idContenu']) ? intval($_GET['idContenu']) : 0;
        $requete = '
            SELECT nom 
            FROM CONTENU WHERE idContenu=:idContenu;
        ';
        $query = $this->pdo->prepare($requete);
        $query -> execute(array('idContenu'=> $idContenu));
        $data= $query-> fetch();
        $query->closeCursor();
        echo json_encode($data);
    }

    private function generalSearch()
    {
        $search = isset($_GET['generalSearch']) ? htmlspecialchars($_GET['generalSearch']) : '?';

        $requete = '
        SELECT nom, nomAuteur, nomContenu, noteMoyenne
        FROM CONTENU
            INNER JOIN AUTEUR
                ON CONTENU.fkIdAuteur = AUTEUR.idAuteur
            INNER JOIN TYPECONTENU
                ON CONTENU.fkIdTypeContenu = TYPECONTENU.idTypeContenu
        WHERE 
            UPPER(nom) LIKE UPPER(\'%' . $search . '%\')
            OR nom SOUNDS LIKE \'%' . $search . '%\'
            OR UPPER(nomAuteur) LIKE UPPER(\'%' . $search . '%\')
            OR nomAuteur SOUNDS LIKE \'' . $search . '\'
              ';
        $query = $this->pdo->prepare($requete);
        $query->execute(); // paramètres et exécution
        $all = [];
        while ($data = $query->fetch()) // lecture par ligne
        {
            $all[] = $data; //  ajout dans un tableau au fur et à mesure
        }
        $query->closeCursor();
        echo json_encode($all);

    }

    private function searchTitle(){
        $search = isset($_GET['titleSearch']) ? htmlspecialchars($_GET['titleSearch']) : '?';

        $requete = '
        SELECT nom, nomAuteur, nomContenu, noteMoyenne
        FROM CONTENU
            INNER JOIN AUTEUR
                ON CONTENU.fkIdAuteur = AUTEUR.idAuteur
            INNER JOIN TYPECONTENU
                ON CONTENU.fkIdTypeContenu = TYPECONTENU.idTypeContenu
        WHERE 
            UPPER(nom) LIKE UPPER(\'%' . $search . '%\')
            OR nom SOUNDS LIKE \'%' . $search . '%\'
              ';
        $query = $this->pdo->prepare($requete);
        $query->execute();
        $all = [];
        while ($data = $query->fetch())
        {
            $all[] = $data;
        }
        $query->closeCursor();
        echo json_encode($all);
    }

    private function searchType(){
        $search = isset($_GET['typeSearch']) ? htmlspecialchars($_GET['typeSearch']) : '?';

        $requete = '
        SELECT idTypeContenu, nomContenu
        FROM TYPECONTENU
        WHERE 
            UPPER(nomContenu) LIKE UPPER(\'%' . $search . '%\')
            OR nomContenu SOUNDS LIKE \'%' . $search . '%\'
              ';
        $query = $this->pdo->prepare($requete);
        $query->execute();
        $all = [];
        while ($data = $query->fetch())
        {
            $all[] = $data;
        }
        $query->closeCursor();
        echo json_encode($all);
    }

    public function api()
    {
        if (isset($_GET['idContenu']))
        {
            $this->getContenu();
        }
        if(isset($_GET['generalSearch']))
        {
            $this->generalSearch();
        }
        if (isset($_GET['titleSearch']))
        {
            $this->searchTitle();
        }
        if (isset($_GET['typeSearch']))
        {
            $this->searchType();
        }
    }

    private $pdo;
}

$librio=new apiLibrio();
$librio->api();