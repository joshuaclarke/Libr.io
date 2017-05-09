<?php

/**
 *    Libr.io
 *    API_Web_Service_2.0
 *    Class Utilisateur (Liaison entre Appli et BDD)
 *    Victor LAURENT 11409577
 */
class Utilisateur
{

    public function getContenuRecent()
    {
        return $this->contenuRecent;
    }

    public function getDateAbonnement()
    {
        return $this->dateAbonnement;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getEstAutorise()
    {
        return $this->estAutorise;
    }

    public function getFavSousTheme()
    {
        return $this->favSousTheme;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setContenuRecent($contenuRecent)
    {
        $this->contenuRecent = $contenuRecent;
    }

    public function setDateAbonnement($dateAbonnement)
    {
        $this->dateAbonnement = $dateAbonnement;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setEstAutorise($estAutorise)
    {
        $this->estAutorise = $estAutorise;
    }

    public function setFavSousTheme($favSousTheme)
    {
        $this->favSousTheme = $favSousTheme;
    }

    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
    
    private $idUtilisateur = null;
    private $pseudo = null;
    private $mdp = null;
    private $email = null;
    private $estAutorise = null;
    private $dateAbonnement = null;
    private $contenuRecent = null;
    private $favSousTheme = null;
}