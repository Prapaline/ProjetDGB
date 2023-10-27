<?php
//Création d'une classe personnage
class Personnage
{
    //création de variable en protected, car nous devons y avoir accès dans l'héritage
    protected $nom;
    protected $puissance;
    protected $pointdevie;

    //Constructeur donnant un nom, un pouvoir et les points de vie
    public function __construct($nom,$puissance,$pointdevie){
        $this->nom=$nom;
        $this->puissance=$puissance;
        $this->pointdevie=$pointdevie;
    }

    //Création de fonction pour appeler les variables (fonction _get)
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
    //Création d'une variable en private (privé), car nous n'utilisons cette variable que dans la classe Heros
    private $avantage;

    //Constructeur avec la classe parent qui reprend le constructeur de la classe Personnage, et ajout des avantages
    public function __construct($nom,$puissance,$pointdevie,$avantage){
            parent::__construct($nom,$puissance,$pointdevie);
            $this->avantage=$avantage;
        }

    //Création de fonction pour appeler les variables (fonction _get)
    public function afficherNom(){
        return $this->nom;
    }
    public function afficherSante(){
        return $this->pointdevie;
    }

    //Création de fonctions _set pour pouvoir modifier les variables
    public function setSante($pointdevie){
        $this->pointdevie=$pointdevie;
    }

    //Fonction permettant d'afficher la puissance, l'avantage et la fiche statistique
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

$Commence=trim(readline("Voulez-vous commencer (Oui / Non)? "));
//Trouver pourquoi la fonction empêche le switch de fonctionner
//function Menu($Commence,$Goku,$Cell){
    
    if ($Commence== "Oui"){
        echo "\nBienvenue dans le menu du jeu. Que voulez-vous faire ?\n
    1. Jouer\n
    2. Afficher les règles\n
    3. Découvrir les personnages\n
    4. Quitter le jeu\n";

    $choix=trim(readline("Quel est votre choix ?\n"));
        switch ($choix) {
            case "1":
                echo"Jouer";
                $personnage=trim(readline("Voulez-vous incarner un heros ou un mechant ? \n"));
                switch ($personnage) {
                    case "heros":
                        //Tant que vie heros>0 && vie méchant>0
                        $niveau=1;
                        $vieHero=$Goku->afficherSante();
                        $vieMechant=$Cell->afficherSante();
                        $santeGoku=$Goku->afficherSante();
                        $santeCell=$Cell->afficherSante();
                        while ($vieHero>0 && $vieMechant>0){
                            $random=random_int(1,6);
                            if ($random >= 2) {
                                $Goku->attaquer($Cell);
                                $vieMechant=$Cell->afficherSante();
                                $Cell->afficherStatistique();
                            } else {
                                echo "L'ennemi a esquivé votre attaque ! \n";
                            }
                            $random=random_int(1,6);
                            if ($random >= 2) {
                                $Cell->attaquer($Goku);
                                $vieHero=$Goku->afficherSante();
                                $Goku->afficherStatistique();
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

                                while ($santeGoku>0 && $santeCell>0){
                                    $attaque_spe=trim(readline("Voulez-vous utiliser l'attaque Kamehameha ? (Oui/Non) \n"));
                                    switch ($attaque_spe) {
                                        case "Oui":
                                            echo "L'attaque Kamehameha va être utilisé.\n";
                                            $random2=random_int(1,6);
                                            echo $random2;
                                            if ($random2 > 3) {
                                                //$Goku->attaquer($Cell);
                                                $Goku->Kamehameha_Bonus($Cell);
                                                $vieMechant=$Cell->afficherSante();
                                                $Cell->afficherStatistique();
                                            }elseif ($random2 < 3) {
                                                //$Goku->attaquer($Cell);
                                                $Goku->Kamehameha_Malus($Cell);
                                                $vieMechant=$Cell->afficherSante();
                                                $Cell->afficherStatistique();
                                            }else{
                                                $Goku->attaquer($Cell);
                                                $vieMechant=$Cell->afficherSante();
                                                $Cell->afficherStatistique();
                                            }
                                            break;
                                        case "Non":
                                            $random=random_int(1,6);
                                            if ($random > 2) {
                                                $Goku->attaquer($Cell);
                                                $vieMechant=$Cell->afficherSante();
                                                $Cell->afficherStatistique();
                                
                                            } else {
                                                echo "L'ennemi a esquivé votre attaque ! ";
                                            }
                                            break;
                                        default:
                                    }
                                    $random=random_int(1,6);
                                    if ($random > 2) {
                                        $Goku->attaquer($Cell);
                                        $vieMechant=$Cell->afficherSante();
                                        $Cell->afficherStatistique();
                                    } else {
                                        echo "L'ennemi a esquivé votre attaque ! ";
                                    }
                                    $random=random_int(1,6);
                                    if ($random > 2) {
                                        $Cell->attaquer($Goku);
                                        $vieHero=$Goku->afficherSante();
                                        $Goku->afficherStatistique();
                                    } else {
                                        echo "Vous avez esquivé l'attaque ! ";
                                    } 
                                }
                                echo"Félicitation ! Vous avez gagné ! \n";
                            }
                        }
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
                //fin du case 1

            case "2":
                echo "Le jeu comporte 2 joueurs. Le but est de remporté tous les combats pour gagner le jeu.\n
                Bonne chance à tous et n'oublie pas, 'Les limites existent uniquement si tu le permets'\n";
                $revenir_menu=trim(readline("Pour revenir sur le Menu merci de taper 'Go' : \n"));
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
                $revenir_menu=trim(readline("\nPour revenir sur le Menu merci de taper 'Go' : \n"));
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





//Ajout l'attaque Kamehameha
//à partir du niveau 2
//puissance aléatoire (système de dé : <3 puissance/2, =3 puissance=$this-puissance, >3 puissance *2)
//utilisable 1 fois par combat


?>