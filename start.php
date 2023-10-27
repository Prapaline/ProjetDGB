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
    public function setSante($pointdevie){
        $this->pointdevie=$pointdevie;
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
    public function niveauSuperieur($niveau){
        $augmentationvie=$this->pointdevie*0.5;
        $this->pointdevie += $augmentationvie;
        $augmentationpuissance=$this->puissance*0.5;
        $this->puissance += $augmentationpuissance;
        echo "Felicitation, vous êtes passé au niveau ".$niveau.", vos points de vie sont de ".$this->pointdevie." et votre attaque est de ".$this->puissance." !";
    }

    public function Kamehameha_Bonus(Mechants $cible){
        $degats = $this->afficherPuissance();
        $degats = $degats * 2;
        $cible->subirDegats($degats);
    }
    public function Kamehameha_Malus(Mechants $cible){
        $degats = $this->afficherPuissance();
        $degats = $degats / 2;
        $cible->subirDegats($degats);
    }
    
}
//Creation de la classe vilain avec pour parent la classe personnage
class Mechants extends Personnage
{
    //Définition des variables
    private $destructeur;
    //Recuperation avec la classe parent et ajout de l'attribut destructeur
    public function __construct($nom,$puissance,$pointdevie,$destructeur){
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
    public function setSante($pointdevie){
        $this->pointdevie=$pointdevie;
    }
    public function niveauSuperieur(){
        $augmentationvie=$this->pointdevie*0.5;
        $this->pointdevie += $augmentationvie;
        $augmentationpuissance=$this->puissance*0.5;
        $this->puissance += $augmentationpuissance;
        echo "Un nouvel ennemi apparait, ses points de vie sont de ".$this->pointdevie." et son attaque est de ".$this->puissance." !\n";
    }

    public function afficherPuissance(){
        return $this->puissance;
    }
    public function afficherDestructeur(){
        return $this->destructeur;
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
        echo $this->afficherNom() . " est mort.\n";
    }
    public function afficherStatistique(){
        echo $this->nom." possède désormais ".$this->pointdevie." point de vie et ".$this->puissance." point d'attaque ! \n";
    }
}

//Création d'un héro

//$heros=new Heros($nom,$puissance,$pointdevie,$avantage);

$Goku=new Heros("Goku", 20, 100, "Bouclier");
$Vegeta = new Heros("Vegeta", 10, 120, "plus de vie");

//$vilain= new Mechants($nom, $puissance,$pointdevie,$destructeur);

$Freezer = new Mechants("Freezer", 10, 140, "plus de vie");
$Cell = new Mechants("Cell", 15, 100, "plus de dégat");



echo "Bonjour à tous, et bienvenue sur 'Dragon Ball Game'\n
    Nous sommes heureuses de vous accueillir pour un combat opposant les Héros et les Méchants de cette série culte.\n
    Le jeu comporte au minimum 2 joueurs. Le but est de remporté le plus de combat possible pour gagner le jeu.\n
    Bonne chance à tous et n'oubliez pas, 'Les limites existent uniquement si tu le permets'\n";

$Commence=readline("Voulez-vous commencer (Oui / Non)? ");
//Trouver pourquoi la fonction empêche le switch de fonctionner
// function Menu($Commence,$Goku,$Cell){
    
    if ($Commence== "Oui"){
        echo "\nBienvenue dans le menu du jeu. Que voulez-vous faire ?\n
    1. Jouer\n
    2. Afficher les règles\n
    3. Découvrir les personnages\n
    4. Quitter le jeu\n";

    $choix=readline("Quel est votre choix ?\n");
        switch ($choix) {
            case "1":
                
                $personnage=readline("Voulez-vous incarner un héros ou un méchant ? \n");
                switch ($personnage) {
                    case "heros":
                        $choixpersonnage=readline("Voulez vous être Goku ou Vegeta ? \n");
                        switch ($choixpersonnage) {
                            case "Goku":
                                $hero=$Goku;
                                $mechant=$Cell;
                                break;
                            case "Vegeta":
                                $hero=$Vegeta;
                                $mechant=$Cell;

                                break;
                            default:
                                $hero=$Vegeta;
                                $mechant=$Cell;

                                break;
                        }
                        //Tant que vie heros>0 && vie méchant>0
                        //Niveau 1
                        $niveau=1;
                        $vieHero=$hero->afficherSante();
                        $vieMechant=$mechant->afficherSante();
                        $santeGoku=$hero->afficherSante();
                        $santeCell=$mechant->afficherSante();
                        while ($santeGoku>0 && $santeCell>0){
                            $random=random_int(1,6);
                            if ($random >= 2) {
                                $hero->attaquer($mechant);
                                $santeCell=$mechant->afficherSante();
                                $mechant->afficherStatistique();
                            } else {
                                echo "L'ennemi a esquivé votre attaque ! \n";
                            }
                            $random=random_int(1,6);
                            if ($random >= 2) {
                                $mechant->attaquer($hero);
                                $santeGoku=$hero->afficherSante();
                                $hero->afficherStatistique();
                            } else {
                                echo "Vous avez esquivé l'attaque ! \n";
                            } 
                        }
                        if ($santeCell> 0 && $santeGoku<=0){
                            //GAMEOVER
                                echo "GAME OVER ! ";
                                break;
                        }
                        $niveau+=1;
                        $kame=1;

                        while ($niveau <= 3) {
                                $hero->setSante($vieHero);
                                $mechant->setSante($vieMechant);
                                $hero->niveauSuperieur($niveau);
                                $mechant->niveauSuperieur();
                                $santeGoku=$hero->afficherSante();
                                $santeCell=$mechant->afficherSante();
                                while ($santeCell>0 && $santeGoku>0){

                                    
                                    if($kame==1){
                                        $attaque_spe=trim(readline("Voulez-vous utiliser l'attaque Kamehameha ? (Oui/Non) \n"));
                                        switch ($attaque_spe) {
                                            case "Oui":
                                            
                                                echo "L'attaque Kamehameha va être utilisé.\n";
                                                $random2=random_int(1,6);
                                                $kame=0;
                                                echo $random2;
                                                if ($random2 > 3) {
                                                    //$Goku->attaquer($Cell);
                                                    $hero->Kamehameha_Bonus($mechant);
                                                    $santeCell=$mechant->afficherSante();
                                                    $mechant->afficherStatistique();
                                                }elseif ($random2 < 3) {
                                                    //$Goku->attaquer($Cell);
                                                    $hero->Kamehameha_Malus($mechant);
                                                    $santeCell=$mechant->afficherSante();
                                                    $mechant->afficherStatistique();
                                                }else{
                                                    $random=random_int(1,6);
                                                    if ($random > 2) {
                                                        $hero->attaquer($mechant);
                                                        $santeCell=$mechant->afficherSante();
                                                        $mechant->afficherStatistique();
                                                    } else {
                                                        echo "L'ennemi a esquivé votre attaque ! ";
                                                    }
                                            
                                                }
                                                break;
                                                default:
                                                    $random=random_int(1,6);
                                                    if ($random > 2) {
                                                        $hero->attaquer($mechant);
                                                        $santeCell=$mechant->afficherSante();
                                                        $mechant->afficherStatistique();
                                                    } else {
                                                        echo "L'ennemi a esquivé votre attaque ! ";
                                                    }
                                                break;
                                            }
                                    
                                    }else{
                                        $random=random_int(1,6);
                                        if ($random > 2) {
                                            $hero->attaquer($mechant);
                                            $santeCell=$mechant->afficherSante();
                                            $mechant->afficherStatistique();
                                        } else {
                                            echo "L'ennemi a esquivé votre attaque ! ";
                                        }
                                    }
                                    if($santeCell>0){
                                        //ATTAQUE DE L'ENNEMI
                                        $random=random_int(1,6);
                                        if ($random > 2) {
                                            $mechant->attaquer($hero);
                                            $santeGoku=$hero->afficherSante();
                                            $hero->afficherStatistique();
                                        } else {
                                            echo "Vous avez esquivé l'attaque ! ";
                                        }
                                    }
                                    if ($santeCell<= 0) {
                                        $niveau+=1;
                                        $kame=1;
                                    }
                                    
                                }
                            }
                            echo"Félicitation ! Vous avez gagné ! \n";        
            break;
            case "mechant":
                //Tant que vie heros>0 && vie méchant>0
                $niveau=1;
                $vieHero=$Goku->afficherSante();
                $vieMechant=$Cell->afficherSante();
                $santeGoku=$Goku->afficherSante();
                $santeCell=$Cell->afficherSante();
                while ($vieHero>0 && $vieMechant>0){
                    $random=random_int(1,6);
                    if ($random >= 2) {
                        $Cell->attaquer($Goku);
                        $vieHero=$Goku->afficherSante();
                        $Goku->afficherStatistique();
                    } else {
                        echo "L'ennemi a esquivé votre attaque ! \n";
                    }
                    $random=random_int(1,6);
                    if ($random >= 2) {
                        $Goku->attaquer($Cell);
                        $vieMechant=$Cell->afficherSante();
                        $Cell->afficherStatistique();
                    } else {
                        echo "Vous avez esquivé l'attaque ! \n";
                    } 
                }
                while ($niveau < 3) {
                    if ($vieMechant> 0){
                    //GAMEOVER
                        echo "GAME OVER ! ";
                        break;
                    }else{
                        $niveau+=1;
                        $Goku->setSante($santeGoku);
                        $Cell->setSante($santeCell);
                        $Goku->niveauSuperieur($niveau);
                        $Cell->niveauSuperieur();
                        $santeGoku=$Goku->afficherSante();
                        $santeCell=$Cell->afficherSante();
                        while ($vieHero>0 && $vieMechant>0){
                            $random=random_int(1,6);
                            if ($random > 2) {
                                $Cell->attaquer($Goku);
                                $vieHero=$Goku->afficherSante();
                                $Goku->afficherStatistique();
                                
                            } else {
                                echo "L'ennemi a esquivé votre attaque ! ";
                            }
                            $random=random_int(1,6);
                            if ($random > 2) {
                                $Goku->attaquer($Cell);
                                $vieMechant=$Cell->afficherSante();
                                $Cell->afficherStatistique();
                            } else {
                                echo "Vous avez esquivé l'attaque ! ";
                            } 
                        }
                    }
        
                }
                echo"Félicitation ! Vous avez gagné ! \n";
                break;
        }
                //Système d'objectif
                //Système de sauvegarde

                break;
            case "2":
                echo "Le jeu comporte au minimum 2 joueurs. Le but est de remporté le plus de combat possible pour gagner le jeu.\n
                Bonne chance à tous et n'oubliez pas, 'Les limites existent uniquement si tu le permets'\n";
                $revenir_menu=readline("Pour revenir sur le Menu merci de taper 'Go' : \n");
                if ($revenir_menu== "Go"){
                    popen("cls", "w");
                    //Menu($Commence,$Goku,$Cell);
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
                //Menu($Commence,$Goku,$Cell);
                break;
            case "4":
                echo ("Vous avez quitter le jeu.");
                break;
            default:
        }
        
    }
    
//}

//Menu($Commence,$heros,$mechant);
?>