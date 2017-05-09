<?php
/**
 *    Libr.io
 *    API_Web_Service_2.0
 *    Class UtilisateurRepo (Liaison entre Appli et BDD)
 *    Victor LAURENT 11409577
 */

require_once (ROOT."/model/connectDB.php");
require_once (ROOT."model/Utilisateur.php");

class UtilisateurRepo implements Model
{

    function __construct()
    {
        $this->pdo = connectDb();
    }

    public function getAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM UTILISATEUR");
        $query -> execute();
        $tabUtilisateur = [];
        while($data = $query->fetch())
        {
            $tabUtilisateur[]=$data;
        }
        $query->closeCursor();
        return $tabUtilisateur;
    }

    public function getById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM UTILISATEUR WHERE idUtilisateur=:id");
        $query->execute(array('id'=>$id));
        $data = $query->fetch();
        $query->closeCursor();
        return $data;
    }

    public function getByName($name)
    {
        $r = "SELECT * FROM UTILISATEUR WHERE UPPER(pseudo) SOUNDS LIKE UPPER(:pseudo) OR UPPER(pseudo) LIKE UPPER('%".$name."%') ";
        $query = $this->pdo->prepare($r);
        $query->execute(array('pseudo'=> $name));
        $tabUtilisateur =[];
        while($data = $query->fetch())
        {
            $tabUtilisateur[]=$data;
        }
        $query->closeCursor();
        return $tabUtilisateur;
    }

    public function get10LastSubscribe()
    {
        $query = $this->pdo->prepare("SELECT * FROM UTILISATEUR ORDER BY dateAbbonnement LIMIT 10");
        $query->execute();
        $tabUtilisateur =[];
        while($data = $query->fetch())
        {
            $tabUtilisateur[]=$data;
        }
        $query->closeCursor();
        return $tabUtilisateur;
    }

    public function subscribe(Utilisateur $usr)
    {
        $query = $this->pdo->prepare("INSERT INTO UTILISATEUR VALUES (NULL , :pseudo, :mdp, :email, :autorise, :dateAbonnement, :plusRecent, :favSousTheme)");
        $query->execute(array('pseudo'=>$usr->getPseudo(), 'mdp'=>password_hash($usr->getMdp(),5), 'email'=>$usr->getEmail(), 'autorise'=>$usr->getEstAutorise(), 'dateAbonnement'=>$usr->getDateAbonnement(), 'plusRecent'=>$usr->getContenuRecent(), 'favSousTheme'=>$usr->getFavSousTheme()));
        return $this->pdo->lastInsertId("idUtilisateur");
    }

    public function login($pseudo, $pw)
    {
        $query = $this->pdo->prepare("SELECT count(*) nb FROM UTILISATEUR WHERE UPPER(pseudo)=UPPER(:pseudo)");
        $query->execute(array('pseudo'=>$pseudo));
        $nb = $query->fetch();
        if($nb['nb']==1)
        {
            $query = $this->pdo->prepare("SELECT MotDePasse mdp FROM UTILISATEUR WHERE UPPER(pseudo)=UPPER(:pseudo)");
            $data = $query->fetch();
            if(password_verify($pw,$data['mdp']))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }



    private $pdo;
}
