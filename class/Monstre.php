<?php

    class Monstre{
        private $_name = "Toto";
        private $_force = 1;
        private $_hp = 10;
        private $_experienceGain = 10;
        private $_historique = [];
        private $_lose;

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

        public function setHistorique($valueHistorique){
            array_push($this->_historique, $valueHistorique);
        }

        public function setLose(){
            $this->_lose = true;
        }

        // compétence & attaque

        public function takeDamage($damage, $enemy){
            $this->_hp -= $damage;
            $valueHistorique = "Le monstre à pris $damage dégat(s) de " . $enemy->getName(). " et lui reste $this->_hp <br>";
            $this->setHistorique($valueHistorique);
            if ($this->_hp == 0){
                // retourner l'histoire du combat en créant un tableau pour l'afficher, pour chaque echo ça renvoie dans le tableau
                $valueHistorique = "Le monstre est mort, ". $enemy->getName() . " à gagné ! Il gagne alors $this->_experienceGain expérience.";
                $this->setHistorique($valueHistorique);
                $enemy->setWinXp($this);
                $this->setLose();
                $_SESSION['test'] = $this->_historique;
                $_SESSION['monsterLost'] = $this->_lose;
                $_SESSION['gainXp'] = $enemy->getExperience();
                
                header("Location: arene.php");
            }else {
                return $this->monsterAttack($enemy);
            }
            
        }

        public function monsterAttack($enemy){
            if ($enemy->getHp() == 0){ // on vérifie si les points de vie ne sont pas à 0
                echo "Le monstre à gagné<br />"; 
            }else {
                return $enemy->takeDamage($this->_force, $this);
            }
        }

        public function setNameEnemy($enemy){
            $this->_enemyName = $enemy; // la valeur this enemy name renvoie un objet
            $enemy->hitSomeone($this); // combat un objet
        }

    }