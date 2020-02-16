<?php

    class Monstre{
        private $_name = "Toto";
        private $_force = 1;
        private $_hp = 10;
        private $_experienceGain = 10;
        private $_enemyName;

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

        public function setExperienceGain($experienceGain){
            $this->_experienceGain = $experienceGain;
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

        public function getExperienceGain(){
            return $this->_experienceGain;
        }

        // compétence & attaque

        public function takeDamage($damage, $enemy){
            $this->_hp -= $damage;
            echo "Le monstre à pris $damage dégat(s) de " . $enemy->getName(). " et lui reste $this->_hp <br>";
            if ($this->_hp == 0){
                echo "Le monstre est mort, ". $enemy->getName() . " à gagné ! Il gagne alors $this->_experienceGain expérience.";
            }else {
                return $this->monsterAttack($enemy);
            }
            
        }

        public function monsterAttack($enemy){
            if ($enemy->getHp() == 0){ // on vérifie si les points de vie ne sont pas à 0
                echo "Le monstre à gagné<br />"; 
            }else {
                return $enemy->takeDamage($this->_force, $this);
                echo "$this->_name frappe $enemy->_name";
                $this->setNameEnemy($enemy);
            }
        }

        public function setNameEnemy($enemy){
            $this->_enemyName = $enemy; // la valeur this enemy name renvoie un objet
            $enemy->hitSomeone($this); // combat un objet
        }

    }