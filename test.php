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
    private $heros = [];
    
    //Définition des thermes
    private $avantage;
    //Constructeur avec la classe parent et ajout des avantages
    public function __construct(){
            $this->Ajouter("Goku", 20, 100, "Bouclier");
            $this->Ajouter("Vegeta", 10, 120, "plus de vie");
        }
        public function Ajouter($nom, $puissance, $pointdevie, $avantage)
    {
        $nouveauHero = ['nom' => $nom, 'puissance' => $puissance, 'pointdevie' => $pointdevie, 'avantage' => $avantage];
        $this->heros[] = $nouveauHero;
    }
    //Affichage de tous les héros du tableau
    public function Afficher()
    {
        foreach ($this->heros as $index) {
            echo "Intitulé : " . $index['nom'] . "\n";
            echo "A : " . $index['puissance'] . "\n";
            echo "B : " . $index['pointdevie'] . "\n";
            echo "C : " . $index['avantage'] . "\n";
        }
    }
    public function AfficherHeroChoisi(){
        return $this->heros;
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
    public function afficherStatistique(){
        echo $this->nom." possède désormais ".$this->pointdevie." point de vie et ".$this->puissance." point d'attaque ! \n";
    }
    public function attaquer(Mechants $cible){
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
class Mechants extends Personnage
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
    public function afficherStatistique(){
        echo $this->nom." possède désormais ".$this->pointdevie." point de vie et ".$this->puissance." point d'attaque !";
    }
    public function attaquer(Heros $cible){
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
//Création d'un héro
$heros=new Heros();
$mechant = new Mechants("Janne", 100, 100, "Lance des bombes");

//Création d'un héro

//$heros=new Heros($nom,$puissance,$pointdevie,$avantage);

//$Goku=new Heros("Goku", 20, 100);
//$Vegeta = new Heros("Vegeta", 10, 120);

//$vilain= new Mechants($nom, $puissance,$pointdevie,$destructeur);

$Freezer = new Mechants("Freezer", 10, 140, "plus de vie");
$Cell = new Mechants("Cell", 15, 100, "plus de dégat");



echo "Bonjour à tous, et bienvenue sur 'Dragon Ball Game'\n
    Nous sommes heureuses de vous accueillir pour un combat opposant les Héros et les Méchants de cette série culte.\n
    Le jeu comporte au minimum 2 joueurs. Le but est de remporté le plus de combat possible pour gagner le jeu.\n
    Bonne chance à tous et n'oubliez pas, 'Les limites existent uniquement si tu le permets'\n";

$Commence=readline("Voulez-vous commencer (Oui / Non)? ");
function Menu($Commence,$heros,$mechant){
    
    if ($Commence== "Oui"){
        echo "\nBienvenue dans le menu du jeu. Que voulez-vous faire ?\n
    1. Jouer\n
    2. Afficher les règles\n
    3. Découvrir les personnages\n
    4. Quitter le jeu\n";

    $choix=readline("Quel est votre choix ?\n");
        switch ($choix) {
            case "1":
                echo"Jouer";
                Demarrer($heros);
                echo $heros->Afficher();
                $heros->attaquer($mechant);
                echo $mechant->afficherSante();
                echo "";
                break;
            case "2":
                echo "Le jeu comporte au minimum 2 joueurs. Le but est de remporté le plus de combat possible pour gagner le jeu.\n
Bonne chance à tous et n'oubliez pas, 'Les limites existent uniquement si tu le permets'\n";
                $revenir_menu=readline("Pour revenir sur le Menu merci de taper 'Go' : \n");
                if ($revenir_menu== "Go"){
                    popen("cls", "w");
                    Menu($Commence,$heros,$mechant);
                }
                break;
            case "3":
                echo "Les Héros :\n
                - Goku : il a 100 PV, et posséde un avantage, le bouclier\n
                - Vegeta : il possède plus de PV que les autres personnages, soit 120 PV\n
Les Méchants :\n
                - Freezer : il a davantage de vie, soit 140 PV \n
                - Cell : il fait perdre 20 PV à ces adversaires et a 100 PV.\n";
                $revenir_menu=readline("\nPour revenir sur le Menu merci de taper 'Go' : \n");
                if ($revenir_menu== "Go"){
                    popen("cls", "w");
                }
                Menu($Commence,$heros,$mechant);
                break;
            case "4":
                echo ("Vous avez quitter le jeu.");
                break;
            default:
        }
        
    }
    
}

function Demarrer($heros){
    $choix_classe=readline("Tu veux être un Héro ou un Méchant ? (Héro / Méchant) \n");
    switch ($choix_classe) {
        case "Héro":
            echo $heros->afficherNom() . "\n";
            $choix_perso=readline("Quel personnage choisis-tu ?");
            if (isset($herosList[$choix_perso])) {
                $heroChoisi = $heros[$choix_perso];
                echo "Personnage choisi :\n";
                echo "Intitulé : " . $heroChoisi['nom'] . "\n";
                echo "A : " . $heroChoisi['puissance'] . "\n";
                echo "B : " . $heroChoisi['pointdevie'] . "\n";
                echo "C : " . $heroChoisi['avantage'] . "\n";
            }
                break;
        case "Méchant":
            // echo $Freezer . "\n" . $Cell . "\n";
            // $choix_perso=readline("Quel personnage choisis-tu ?");
            break;
        default:
    }
    
}

Menu($Commence,$heros,$mechant);
?>