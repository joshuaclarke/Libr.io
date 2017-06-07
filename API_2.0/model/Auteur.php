<?php

/**
 *    Libr.io
 *    API_Web_Service_2.0
 *    Class Auteur (Liaison entre Appli et BDD)
 *    Victor LAURENT 11409577
 */
require_once(ROOT.'/model/connectDB.php');
require_once(ROOT.'/model/Model.php');
class Auteur implements Model
{
    public function __construct()
    {
        $this->pdo=connectDb();
    }

    public function getAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM AUTEUR");
        $query->execute();
        $tabAuteur = [];
        while($data = $query->fetch())
        {
            $tabAuteur[] = $data;
        }
        $query->closeCursor();
        return $tabAuteur;
    }

    public function getById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM AUTEUR WHERE idAuteur=:id");
        $query->execute(array('id'=>$id));
        return $query->fetch();
    }

    public function getByName($name)
    {
        $name = htmlspecialchars($name);
        $r = "SELECT * FROM AUTEUR WHERE nomAuteur SOUNDS LIKE :name1 OR UPPER(nomAuteur) LIKE UPPER('%".$name."%')";
        $query = $this->pdo->prepare($r);
        $query->execute(array('name1'=> $name));
        $tabAuteur = [];
        while($data = $query->fetch())
        {
            $tabAuteur[]=$data;
        }
        $query->closeCursor();
        return $tabAuteur;
    }


    public function getByContenu($idAuteur)
    {
        $query = $this->pdo->prepare("SELECT * FROM CONTENU JOIN AUTEUR ON CONTENU.fkIdAuteur=AUTEUR.idAuteur WHERE fkIdAuteur = :idAuteur");
        $query->execute(array('idAuteur'=>$idAuteur));
        $tabAuteur = [];
        while($data = $query->fetch())
        {
            $tabAuteur[]=$data;
        }
        $query->closeCursor();
        return $tabAuteur;
    }


    private $pdo;
}
