<?php

class Personnage{

    private $nom;
    private $niveau_puissance;
    private $vie;

    public function __construct($nom,$niveau_puissance,$vie){
        $this->nom = $nom;
        $this->niveau_puissance = $niveau_puissance;
        $this->vie = $vie;

    }

    public function getNom(){
        return $this->nom;
    }
    public function getNiveau_puissance(){
        return $this->niveau_puissance;
    }
    public function getvie(){
        return $this->vie;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setNiveau_puissance($niveau_puissance){
        $this->niveau_puissance = $niveau_puissance;
    }
}

class Heros extends Personnage{

    public function __construct($nom,$niveau_puissance,$vie){
        parent::__construct($nom,$niveau_puissance,$vie);
    }

}

class Mechants extends Personnage{
    public function __construct($nom,$niveau_puissance,$vie){
        parent::__construct($nom,$niveau_puissance,$vie);
    }
}


?>