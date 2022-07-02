<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>La page avec protection CSRF !</h1>

        <?php
            if (!isset($_GET['token'])) {
                echo '<h2>Le token est absent !</h2>';
                exit;
            } else {
                echo '<h2>Le token est présent !</h2>';
                if ($_GET['token'] != $_SESSION['token']) {
                    echo '<h2>Le token est invalide !</h2>';
                } else {
                    echo '<h2>Le token est valide !</h2>';
                    echo '<h2>Donc on supprime le ' . $_GET['id'] . ' !<h2>';
                }
            }
        ?>
    </body>
</html>