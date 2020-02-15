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
    <title>ToriaKin - Connexion</title>
</head>
<body>
    <?php
        // include('../include/header.php');
    ?>

<?php 
    if (!isset($_SESSION['id'])){
?>
    <section>
        <form action="" method="post">
            <label for="name">Identifiant :</label>
            <input type="text" id="pseudo" name="identifiant" placeholder="Pseudo ou e-mail" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" placeholder="votre mot de passe" required>
            
            <input type="submit" value="Se connecter">
        </form>
    </section>

<?php
        if (isset($_POST['identifiant']) && isset($_POST['password']) ){
        $reponse = $bdd->prepare('SELECT * FROM user WHERE pseudo = :pseudo || mail = :mail');
        $reponse->execute(array(
            'pseudo' => $_POST['identifiant'],
            'mail' => $_POST['identifiant']
        ));

        $data = $reponse->fetch();
        if ((isset($data['pseudo']) || isset($data['mail'])) && $data['password'] == md5($_POST['password'] )){
            $_SESSION['id'] = $data['id'];
            $_SESSION['pseudo'] = $data['pseudo'];
            $_SESSION['mail'] = $data['mail'];
            header("Location: seConnecter.php");
        }else {
            echo "Le pseudo ou le mot de passe est incorrect";
        }
            
    }

}else {
    echo $_SESSION['pseudo'];
    header("Location: ../../index.php")
    ?>
    
    <a href="deconnexion.php" style="color:blue;">déconnexion</a>
<?php
}
    
?>

<?php 
    // include('../include/footer.php');
?>

</body>
</html>