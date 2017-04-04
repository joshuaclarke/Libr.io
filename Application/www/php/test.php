<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Inscription</title>
  <link rel="stylesheet" type="text/css" href="../css/index.css">
  <script src="script.js">
    </script>
</head>
<body>
  <div class="corps">
          <h1>Proposer un document libre de droits</h1>
              <div class="informationsGenerales">
                  <h2>Informations générales</h2>
                  <p>Ici le texte d'utilisation de cette page avec les droits à prendre en compte.
              </div>
              <div class="propositionFichier">
                  <h2>Importer un fichier</h2>
                  <p>Ici le texte d'utilisation de cette page avec les droits à prendre en compte.</p>

                  <?php
                   if (isset($_FILES['fichier']) &&
                       $_FILES['fichier']['error'] == 0 &&
                       $_FILES['fichier']['size'] <= 1 * 1024 * 1024)
                   {
                     $infosfichier = pathinfo($_FILES['fichier']['name']);
                     $ext_upload = $infosfichier['extension'];
                     if (in_array($ext_upload, array('jpg', 'gif', 'png')))
                     {
                       move_uploaded_file(
                         $_FILES['fichier']['tmp_name'],
                         'uploads/'.basename($_FILES['fichier']['name'])
                       );
                       echo 'ok';
                     }
                     else {
                       echo 'type invalide';
                     }
                   }
                  ?>
              </div>
      </div>
</body>
</html>
