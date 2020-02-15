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
        class Personnage{
            private $_name;
            private $_force = 1;
            private $_hp = 50;
            private $_level = 1;
            private $_experience = 1;

            public function __construct($name){
                $this->setName($name);
            }

            public function setName($name){
                $this->_name = $name;
            }
            
            public function getName(){
                return $this->_name;
            }

            public function hitSomeone($enemy){
                $enemy->_hp -= $this->_force;
                $this->getExperience();
            }

            public function getExperience(){
                $this->_experience += 1;
                echo "J'ai " . $this->_experience . " expérience.";
            }

            public function getHp(){
                echo $this->_hp;
            }

            public function winLevel(){

            }
        }
    ?>

    <?php 
        $Toria = new Personnage("Toria");
        echo "Salut je m'appelle " . $Toria->getName() . "<br/>";

        $Kin = new Personnage("Kin");
        echo "Salut je m'appelle " . $Kin->getName() . "<br/>";
        $Kin->getExperience();
        $Kin->hitSomeone($Toria);
        $Toria->getHp();
        
    ?>

    
</body>
</html>