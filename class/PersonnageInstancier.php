<?php 
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

            // Set & Get

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

            public function setWinXp($enemy){
                $this->_experience += $enemy->getExperienceGain();
            }

            // compétences

            public function hitSomeone($enemy){
                if ($enemy->getHp() == 0){ // on vérifie si les points de vie ne sont pas à 0
                    echo "J'ai gagné $this->_name <br />"; 
                    $this->getExperience();
                }else {
                    return $enemy->takeDamage($this->_force, $this);
                }
                
            }

            public function takeDamage($damage, $enemy){
                $this->_hp -= $damage;
                $valueHistorique = "Notre personnage à pris $damage dégat(s) de " . $enemy->getName(). " et lui reste $this->_hp <br>";
                $enemy->setHistorique($valueHistorique);
                return $this->hitSomeone($enemy);
            }

            public function setNameEnemy($enemy){
                $this->_enemyName = $enemy; // la valeur this enemy name renvoie un objet
                $enemy->monsterAttack($this); // combat un objet
            }
        }

        ?>