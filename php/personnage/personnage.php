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
<header>
    <ul>
        <li>
            <a href="../../index.php">Accueil</a>
        </li>
        <li>
            <a href="personnage.php">Personnage</a>
        </li>
        <li>
            <a href="arene.php">Arène</a>
        </li>
        <li>
            <a href="#">Setting</a>
        </li>
        <li>
            <a href="../../php/login/deconnexion.php">Déconnexion</a>
        </li>

    </ul>
</header>

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

        class PersonnageInstancier{ // class qui instancie notre personnage de la base de données
            private $_name;
            private $_force;
            private $_hp;
            private $_level;
            private $_experience;
            private $enemyName;

            public function __construct($name, $force, $hp, $experience, $level){
                $this->setName($name);
                $this->setForce($force);
                $this->setHp($hp);
                $this->setExperience($experience);
                $this->setLevel($level);
            }

            public function setName($name){
                $this->_name = $name;
            }

            public function setForce($force){
                $this->_force = $force;
            }

            public function setHp($hp){
                $this->_hp = $hp;
            }

            public function setExperience($experience){
                $this->_experience = $experience;
            }

            public function setLevel($level){
                $this->_level = $level;
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

            $reponse = $bdd->prepare('SELECT * FROM personnage WHERE user_pseudo = :pseudo');
            $reponse->execute(array(
                'pseudo' => $_SESSION['pseudo']
            ));
    
            $data = $reponse->fetch();
            if (isset($data['user_pseudo'])){
                $name = $data['name']; // renvoie le nom
                $$name = new PersonnageInstancier($data['name'], $data['forceTerre'], $data['hp'], $data['experience'], $data['level']); // Hydratation de l'objet  

                // instancier une nouvelle classe avec les même propriétés que celle de la base de données
                ?>
                    <h2>Votre personnage s'appelle :  <?php echo $name ?></h2>

                    <ul>
                        <li>
                            <p>Nom :<?php echo $$name->getName(); ?></p>
                        </li>
                        <li>
                            <p>Force : <?php echo $$name->getForce(); ?></p>
                        </li>
                        <li>
                            <p>Point de vie : <?php echo $$name->getHp(); ?></p>
                        </li>
                        <li>
                            <p>Expérience : <?php echo $$name->getExperience(); ?></p>
                        </li>
                        <li>
                            <p>Niveau : <?php echo $$name->getLevel(); ?></p>
                        </li>
                    </ul>
                <?php
            }else {
                echo "Le personnage n'existe pas";
                ?>
                    <form action="" method="post">
                        <label for="name">Rentrez le nom de votre personnage :</label>
                        <input type="text" id="name" name="name" required>
                        <input type="submit" value="Valider">
                    </form>
                <?php
                if(!empty($_POST['name'])){
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

                        header("Location: personnage.php");
                    }else {
                        
                    }
                }else {
                    echo "Veuillez remplir le champ";
                }
                    
            }

            // exemple
                
    ?>
    </section>
</body>
</html>