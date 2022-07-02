<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>La page vulnérable !</h1>

        <h2>Page sans protection CSRF, je supprime quand même le <?= $_GET['id'] ?></h2>
    </body>
</html>