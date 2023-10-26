<?php
//Création d'une classe personnage
class Personnage
{
    private $nom;
    private $puissance;
    private $pointdevie;
    //Constructeur donnant un nom et un pouvoir
    public function __construct($nom,$puissance,$pointdevie){
        $this->nom=$nom;
        $this->puissance=$puissance;
        $this->pointdevie=$pointdevie;
    }
    public function afficherNom($nom){
        return $nom;
    }
    public function afficherSante(){
        return $this->pointdevie;
    }
}
//Création d'une classe Hero avec pour parent la classe personnage
class Heros extends Personnage
{
    //Définition des thermes
    private $avantage;
    //Constructeur avec la classe parent et ajout des avantages
    public function __construct($nom,$puissance,$pointdevie,$avantage){
            parent::__construct($nom,$puissance,$pointdevie);
            $this->avantage=$avantage;
        }
    //Fonction pour afficher les différentes parties
    public function afficherNom($nom){
        return $nom;
    }
    public function afficherSante(){
        return $this->pointdevie;
    }
    public function afficherPuissance($puissance){
        return $puissance;
    }
    public function afficherAvantage($avantage){
        return $avantage;
    }
}
//Creation de la classe vilain avec pour parent la classe personnage
class Vilain extends Personnage
{
    //Définition des variables
    private $nom;
    private $puissance;
    private $pointdevie;
    private $destructeur;
    //Recuperation avec la classe parent et ajout de l'attribut destructeur
    public function __construct($nom,$pointdevie,$puissance,$destructeur){
            parent::__construct($nom,$puissance,$pointdevie);
            $this->destructeur=$destructeur;
        }
    //Fonctions permettant de renvoyer les différents attributs du vilain créé
    public function afficherNom($nom){
        return $nom;
    }
    public function afficherSante(){
        return $this->pointdevie;
    }
    public function afficherPouvoir($pouvoir){
        return $pouvoir;
    }
    public function afficherDestructeur($destructeur){
        return $destructeur;
    }
}
//Création d'un héro
$nom="Jean";
$pouvoir= "voler";
$pointdevie= "100";
$avantage= "toujours plus vite";
$heros=new Heros($nom,$pouvoir,$pointdevie,$avantage);
echo "Pour le héro : ";
echo $heros->afficherNom($nom)." ";
echo $heros->afficherSante()." ";
echo $heros->afficherPuissance($pouvoir)." ";
echo $heros->afficherAvantage($avantage)." ";
$nom="Janne";
$pouvoir= "maitre des explosions";
$destructeur="Lance des bombes";
echo "Pour le vilain : ";
$vilain= new Vilain($nom, $pouvoir,$pointdevie,$destructeur);
echo $vilain->afficherNom($nom)." ";
echo $vilain->afficherSante()." ";
echo $vilain->afficherPouvoir($pouvoir)." ";
echo $vilain->afficherDestructeur($destructeur);

?>