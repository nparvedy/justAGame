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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        include("../../include/menu.php");
    ?>

    <?php 
        class PersonnageTest{
            private $_name;
            private $_force = 1;
            private $_hp = 50;
            private $_level = 1;
            private $_experience = 1;
            private $enemyName;
        }


    ?>

    <section>
        <h1>Mon personnage</h1>

        <?php 
        //if (isset($_POST['identifiant']) && isset($_POST['password']) ){
            $reponse = $bdd->prepare('SELECT * FROM personnage WHERE user_pseudo = :pseudo');
            $reponse->execute(array(
                'pseudo' => $_SESSION['pseudo']
            ));
    
            $data = $reponse->fetch();
            if ((isset($data['user_pseudo']))){
                echo "Le personnage existe";
            }else {
                echo "Le personnage n'existe pas";
            }
                
    ?>
    </section>
</body>
</html>