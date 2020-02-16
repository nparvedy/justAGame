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

    $reponse = $bdd->prepare('SELECT * FROM personnage WHERE user_pseudo = :pseudo');
            $reponse->execute(array(
                'pseudo' => $_SESSION['pseudo']
            ));
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
        function chargerClasse($classe)
        {
            require '../../class/' . $classe . '.php'; 
        }

        spl_autoload_register('chargerClasse');
    ?>

    

<?php $data = $reponse->fetch();
            if (isset($data['user_pseudo'])){
                $name = $data['name']; // renvoie le nom
                $$name = new PersonnageInstancier($data['name'], $data['forceTerre'], $data['hp'], $data['experience'], $data['level']); // Hydratation de l'objet  
                ?>
                <p>Nom :<?php echo $$name->getName(); ?></p>

                <?php
                // instancier une nouvelle classe avec les même propriétés que celle de la base de données
                ?>
                    <h2>Votre personnage s'appelle :  <?php echo $name ?></h2>
                    <form action="" method="post">
                    <label for="name">Toto :</label>
                    <input type="hidden" id="nameMonster" name="nameMonster" value="Monstre" required>
                    <input type="submit" value="Combattre">

                    <?php 
                    if (isset($_POST['nameMonster'])){
                        $nameMonster = new $_POST['nameMonster']();
                        $$name->hitSomeone($nameMonster);
                    }
                    ?>
                <?php
            }else {
                header("Location: personnage.php");
            }
        ?>
</body>
</html>