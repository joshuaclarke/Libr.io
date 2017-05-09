<?php
/**
 *    Libr.io
 *    API_Web_Service
 *    Fonction connectBD := permet la connection à la base de données avec un objet de ttyoe PDO
 *    Victor LAURENT 11409577
 */

    function connectDb()
    {
         $host = 'iutdoua-web.univ-lyon1.fr';
         $user = 'p1612212';
         $pwd = '273965';
         $db = 'p1612212';
         try
         {
             $bdd = new PDO('mysql:host='.$host.';dbname='.$db.
                 ';charset=utf8', $user, $pwd,
                 array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
             return $bdd;
         }
         catch (Exception $e)
         {
             exit('Erreur : '.$e->getMessage());
         }
    }

