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

            public function __construct($name){
                $this->setName($name);
            }

            public function setName($name){
                $this->_name = $name;
            }

            public function getName(){
                return $this->_name;
            }

            public function getForce(){
                return $this->_force;
            }

            public function getHp(){
                return $this->_hp;
            }

            public function getLevel(){
                return $this->_level;
            }

            public function getExperience(){
                return $this->_experience;
            }

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
            if (isset($data['user_pseudo'])){
                echo "Le personnage existe";
            }else {
                echo "Le personnage n'existe pas";
                ?>
                    <form action="" method="post">
                        <label for="name">Rentrez le nom de votre personnage :</label>
                        <input type="text" id="name" name="name" required>
                        <input type="submit" value="Valider">
                    </form>
                <?php
                    if(isset($_POST['name'])){
                        
                        $name = $_POST['name']; // renvoie le nom
                        $$name = new PersonnageTest($_POST['name']); // initie la variable avec le nom

                        $req = $bdd->prepare('INSERT INTO personnage (user_pseudo, name, forceTerre, hp, experience, level) VALUES (:user_pseudo, :name, :forceTerre, :hp, :experience, :level)');
                        $req->execute(array(
                            'user_pseudo' => $_SESSION['pseudo'],
                            'name' => $$name->getName(),
                            'forceTerre' => $$name->getForce(),
                            'hp' => $$name->getHp(),
                            'experience' => $$name->getExperience(),
                            'level' => $$name->getLevel()
                            
                        ));

                        var_dump($$name->getForce());
                    }else {
                        
                    }
            }

            // exemple
                
    ?>
    </section>
</body>
</html>