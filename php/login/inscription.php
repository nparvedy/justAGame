<?php
try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=toriakin_game;charset=utf8', 'root', '');
    }
catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }

session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="css/inscription.css">
    <title>ToriaKin - Inscription</title>
</head>
<body>
    <?php
        // include('../include/header.php');
    ?>

    <section>
        <form action="" method="post">
            <label for="name">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" required>
            <label for="mail">e-mail :</label>
            <input type="email" id="mail" name="mail" required>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>
            <label for="password_confirm">Confirmez votre mot de passe :</label>
            <input type="password" name="password_confirm" required>
            <input type="submit" value="Envoyer">
        </form>
    </section>

<?php

    if (isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['password_confirm'])){
        $reponse = $bdd->prepare('SELECT pseudo, mail FROM user WHERE pseudo = :pseudo || mail = :mail ');
        $reponse->execute(array(
            'pseudo' => $_POST['pseudo'],
            'mail' => $_POST['mail']
        ));

        $data = $reponse->fetch();
        echo $data['pseudo'];
        if ($data['pseudo'] != $_POST['pseudo']){
            if ($data['mail'] != $_POST['mail']){
                if($_POST['password'] === $_POST['password_confirm']){
                    $req = $bdd->prepare('INSERT INTO user (pseudo, mail, password) VALUES(:pseudo, :mail, :password)');
                    $req->execute(array(
                        'pseudo' => $_POST['pseudo'],
                        'mail' => $_POST['mail'],
                        'password' => md5($_POST['password'])
                    ));
                    }else {
                        echo "Désolé les mots de passe ne sont pas identiques";
                    }
                }else {
                    echo "Désolé l'e-mail existe déjà";
                }
            
            }else {
                echo "Désolé le pseudo existe déjà";
            }
        }

    ?>

<?php 
    // include('../include/footer.php');
?>

</body>
</html>