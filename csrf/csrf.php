<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>La faille CSRF</h1>
        <p>
            <a href="https://www.leblogduhacker.fr/faille-csrf-explications-contre-mesures/">Explications</a>
        </p>

        <?php
            unset($_SESSION['token']);
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(6));
        ?>

        <a href="csrf_sans_token.php?id=12">Supprimer le 12 (sans token)</a>
        <br>
        <a href="csrf_avec_token.php?id=12&token=<?= $_SESSION['token'] ?>">Supprimer le 12 (avec token)</a>

    </body>
</html>