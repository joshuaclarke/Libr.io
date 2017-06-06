<?php
/**
 *    Libr.io
 *    API_Web_Service_2.0
 *    Class Search (Controlleur de recherche)
 *    Victor LAURENT 11409577
 */

require_once (ROOT.'/model/Utilisateur.php');
require_once (ROOT.'/model/UtilisateurRepo.php');

class User
{
    public function conection()
    {
        if(isset($_POST['pseudo']) && $_POST['pw'])
        {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $pw = htmlspecialchars($_POST['pw']);
            $repo = new UtilisateurRepo();
            if($repo->login($pseudo, $pw))
            {
                session_start();
                $_SESSION['pseudo'] = $pseudo;
                echo json_encode("connect_success");
            }
            else
            {
                echo json_encode("connect_failed");
            }
        }
        else
        {
            echo json_encode("invalide_argument");
        }
    }

    public function unConnect()
    {
        if(session_destroy())
        {
            setcookie($_SESSION['pseudo'],null,null,null, null, true,false );
            echo json_encode("deconnect_sucess");
        }
        else
        {
            echo json_encode("error_deconnect_failed");
        }
    }

    public function subscribe()
    {
        if (isset($_POST['pseudo'])
            && isset($_POST['pw'])
            && isset($_POST['pw1'])
            && isset($_POST['mail']) &&
            isset($_POST['mail2']))
        {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $pw = htmlspecialchars($_POST['pw']);
            $pw1 = htmlspecialchars($_POST['pw1']);
            $mail = htmlspecialchars($_POST['mail']);
            $mail1 = htmlspecialchars($_POST['mail1']);

            if ($pw===$pw1 && $mail===$mail1)
            {
                $repo = new UtilisateurRepo();
                $usr = new Utilisateur();
                $usr -> setPseudo($pseudo);
                $usr ->setMdp($pw);
                $usr ->setEmail($mail);
                $repo->subscribe($usr);
                echo json_encode("subscribe_success");
            }
            else
            {
                echo json_encode("incorrect_arguments");
            }
        }
        else
        {
            echo json_encode("missing_arguments");
        }
    }


}
