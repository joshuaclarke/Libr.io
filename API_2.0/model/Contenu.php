<?php
/**
 *    Libr.io
 *    API_Web_Service_2.0
 *    Class Contenu (Liaison entre Appli et BDD)
 *    Victor LAURENT 11409577
 */
require_once (ROOT.'/model/connectDB.php');
require_once (ROOT.'/model/Model.php');
class Contenu implements Model
{
    public function __construct()
    {
        $this->pdo = connectDb();
    }

    public function getAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM p1612212.CONTENU");
        $query->execute();
        $tabContenu = [];
        while($data = $query->fetch())
        {
            $tabContenu [] = $data;
        }
        $query->closeCursor();
        return $tabContenu;
    }

    public function getById($id){
        $query = $this->pdo->prepare("UPDATE CONTENU SET nbClic=nbClic+1 WHERE idContenu = :id");
        $query->execute(array('id'=>$id));
        $query = $this->pdo->prepare("SELECT * FROM p1612212.CONTENU WHERE idContenu=:id");
        $query->execute(array('id'=>$id));
        return $query->fetch();
    }

    public function getByName($name)
    {
        $r = "SELECT * FROM CONTENU WHERE nom SOUNDS LIKE :name1 OR UPPER(nom) LIKE UPPER('%".$name."%')";
        $query = $this->pdo->prepare($r);
        $query->execute(array('name1'=> $name));
        $tabContenu = [];
        while($data = $query->fetch())
        {
            $tabContenu[]=$data;
        }
        $query->closeCursor();
        return $tabContenu;
    }

    public function getByType($type)
    {
        $r = "SELECT * FROM CONTENU JOIN TYPECONTENU ON CONTENU.fkIdTypeContenu=TYPECONTENU.idTypeContenu WHERE TYPECONTENU.nomContenu SOUNDS LIKE :type OR UPPER(nom) LIKE UPPER('%".$type."%')";
        $query = $this->pdo->prepare($r);
        $query->execute(array('type'=> $type));
        $tabContenu = [];
        while($data = $query->fetch())
        {
            $tabContenu[]=$data;
        }
        $query->closeCursor();
        return $tabContenu;
    }

    public function getByAuthorName($author)
    {
        $r = "SELECT * FROM CONTENU JOIN AUTEUR ON CONTENU.fkIdAuteur = AUTEUR.idAuteur WHERE AUTEUR.nomAuteur SOUNDS LIKE :author OR UPPER(nom) LIKE UPPER('%".$author."%')";
        $query = $this->pdo->prepare($r);
        $query->execute(array('author'=> $author));
        $tabContenu = [];
        while($data = $query->fetch())
        {
            $tabContenu[]=$data;
        }
        $query->closeCursor();
        return $tabContenu;
    }

    public function getByAuteur($id)
    {
        $r = "SELECT * FROM CONTENU WHERE fkIdAuteur = ?";
        $query = $this->pdo->prepare($r);
        $query->execute(array($id));
        $tabContenu = [];
        while($data = $query->fetch())
        {
            $tabContenu[]=$data;
        }
        $query->closeCursor();
        return $tabContenu;
    }

    public function detByLicence($licence)
    {
        $r = "SELECT * FROM CONTENU JOIN LICENSE ON CONTENU.fkIdLicence=LICENSE.idLicense WHERE LICENSE.nomLicence SOUNDS LIKE :licence OR UPPER(nomLicence) LIKE UPPER('%".$licence."%')";
        $query = $this->pdo->prepare($r);
        $query->execute(array('license'=>$licence));
        $tabContenu = [];
        while($data = $query->fetch())
        {
            $tabContenu[]=$data;
        }
        $query->closeCursor();
        return $tabContenu;
    }

    public function getByTheme($theme)
    {
        $r = "SELECT * FROM CONTENU JOIN THEME ON CONTENU.fkIdSousTheme=THEME.idTheme WHERE THEME.nomTheme SOUNDS LIKE :theme OR UPPER(nomTheme) LIKE UPPER('%".$theme."%')";
        $query = $this->pdo->prepare($r);
        $query->execute(array('theme'=> $theme));
        $tabContenu = [];
        while($data = $query->fetch())
        {
            $tabContenu[]=$data;
        }
        $query->closeCursor();
        return $tabContenu;
    }

    public function getTopTen()
    {
        $query = $this->pdo->prepare("SELECT * FROM p1612212.CONTENU ORDER BY nbClic LIMIT 10");
        $query->execute();
        $tabContenu = [];
        while($data = $query->fetch())
        {
            $tabContenu [] = $data;
        }
        $query->closeCursor();
        return $tabContenu;
    }

    public function getDecouvertes()
    {
        $query = $this->pdo->prepare("SELECT * FROM p1612212.CONTENU ORDER BY nbClic DESC LIMIT 10");
        $query->execute();
        $tabContenu = [];
        while($data = $query->fetch())
        {
            $tabContenu [] = $data;
        }
        $query->closeCursor();
        return $tabContenu;
    }

  private $pdo;

}
