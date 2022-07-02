<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>La faille SQLi : page vulnérable</h1>

        <?php
            echo '<h2>Les données reçues en POST</h2>';
            var_dump($_POST);

            define("DB_HOST", "localhost");
            define("DB_NAME", "security_php");
            define("DB_USER", "root");
            define("DB_PASSWORD", "");
            define("DB_CHARSET", "utf8");

            try {
                $dns = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
                $options = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );
                $pdo = new PDO($dns, DB_USER, DB_PASSWORD, $options);
            } catch (Exception $e) {
                die("Connexion impossible : " . $e->getMessage());
            }

            try {
                $query = "
                SELECT u.login, a.type, a.amount
                FROM accounts AS a LEFT JOIN users AS u ON a.id_users = u.id
                WHERE u.login = '" . $_POST['login'] . "' AND u.pass = '" . $_POST['password'] . "' ORDER BY 1,3";

                echo '<h2>La requête SQL non préparée</h2>';
                var_dump($query);

                $req = $pdo->query($query);
                $data = $req->fetchAll();

                //var_dump($data);

                echo '<h2>Le résultat</h2>';
                echo '<table border="1">';
                echo '<tr><th>Login</th><th>Type compte</th><th>Montant</th></tr>';
                foreach ($data as $onedata) {
                    echo '<tr>';
                    echo '<td>' . $onedata[0] . '</td>';
                    echo '<td>' . $onedata[1] . '</td>';
                    echo '<td>' . $onedata[2] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';

            } catch(Exception $e) {
                die("Erreur MySQL : " . $e->getMessage());
            }
        ?>
    </body>
</html>