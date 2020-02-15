<?php
class Personnage{
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

            public function hitSomeone($enemy){
                if ($enemy->_hp == 0){
                    echo "J'ai gagné $this->_name";
                    return true;
                }else {
                    $enemy->_hp -= $this->_force;
                    echo "$this->_name frappe $enemy->_name";
                    $this->getExperience();
                    $enemy->getHp();
                    $this->setNameEnemy($enemy);
                }
                
            }

            public function getExperience(){
                $this->_experience += 1;
                echo "J'ai " . $this->_experience . " expérience.<br />";
            }

            public function setNameEnemy($enemy){
                $this->_enemyName = $enemy; // la valeur this enemy name renvoie un objet
                $enemy->hitSomeone($this); // combat un objet
            }

            public function getHp(){
                echo $this->_hp;
            }

            public function winLevel(){

            }

            
        }