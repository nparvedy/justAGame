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

    if ($_SESSION) {
        ?>
    
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <?php 
        include("include/menu.php");
    ?>

    <h1>Bonjour <?php echo $_SESSION['pseudo'] ?></h1>
    
</body>
</html>

<?php 
    }else {
        header("Location: php/login/seConnecter");
    }
?>