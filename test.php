<?php
//Création d'une classe personnage
class Personnage
{
    protected $nom;
    protected $puissance;
    protected $pointdevie;
    //Constructeur donnant un nom et un pouvoir
    public function __construct($nom,$puissance,$pointdevie){
        $this->nom=$nom;
        $this->puissance=$puissance;
        $this->pointdevie=$pointdevie;
    }
    public function afficherNom(){
        return $this->nom;
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
    public function afficherNom(){
        return $this->nom;
    }
    public function afficherSante(){
        return $this->pointdevie;
    }
    public function afficherPuissance(){
        return $this->puissance;
    }
    public function afficherAvantage(){
        return $this->avantage;
    }
    public function attaquer(Vilain $cible){
        $degats = $this->afficherPuissance();
        $cible->subirDegats($degats);
    }
    public function subirDegats($degats) {
        $this->pointdevie -= $degats;
        if ($this->pointdevie <= 0) {
            $this->mourrir();
        }
    }
    public function mourrir() {
        echo $this->afficherNom() . " est mort.";
    }
    
}
//Creation de la classe vilain avec pour parent la classe personnage
class Vilain extends Personnage
{
    //Définition des variables
    private $destructeur;
    //Recuperation avec la classe parent et ajout de l'attribut destructeur
    public function __construct($nom,$pointdevie,$puissance,$destructeur){
            parent::__construct($nom,$puissance,$pointdevie);
            $this->destructeur=$destructeur;
        }
    //Fonctions permettant de renvoyer les différents attributs du vilain créé
    public function afficherNom(){
        return $this->nom;
    }
    public function afficherSante(){
        return $this->pointdevie;
    }
    public function afficherPuissance(){
        return $this->puissance;
    }
    public function afficherDestructeur(){
        return $this->destructeur;
    }
    
}
//Création d'un héro
$heros = new Heros("Jean", 100, 800, "toujours plus vite");
$vilain = new Vilain("Janne", 100, 100, "Lance des bombes");

$heros->attaquer($vilain);

echo $vilain->afficherSante();

?>