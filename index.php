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
        function chargerClasse($classe)
        {
            require 'class/' . $classe . '.php'; 
        }

        spl_autoload_register('chargerClasse');
    ?>
    <?php 
        $Toria = new Personnage("Toria");
        echo "Salut je m'appelle " . $Toria->getName() . "<br/>";

        $Kin = new Personnage("Kin");
        echo "Salut je m'appelle " . $Kin->getName() . "<br/>";
        $Kin->getExperience();
        $Kin->hitSomeone($Toria);
        
    ?>

    
</body>
</html>