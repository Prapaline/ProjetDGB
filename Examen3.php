<?php
//Création d'une classe personnage
class Personnage
{
    //Création de 3 variables en protected. Elles ne peuvent pas être en private étant donné qu'on les utilise en héritage, donc elles sont en protected
    protected $nom;
    protected $puissance;
    protected $pointdevie;

    //Constructeur donnant un nom et une puissance (dégât) et les points de vie
    public function __construct($nom,$puissance,$pointdevie){
        $this->nom=$nom;
        $this->puissance=$puissance;
        $this->pointdevie=$pointdevie;
    }

    //création de fonction permettant d'appeler et d'afficher les variables (tel une fonction _get)
    public function afficherNom(){
        return $this->nom; //retourner le nom
    }
    public function afficherSante(){
        return $this->pointdevie; //retourner les points de vie du personnage
    }
}

//Création d'une classe Hero avec pour parent la classe personnage
class Heros extends Personnage
{
    private $avantage; //Création d'une variable en private, étant donné qu'elle est utilisé seulement dans la classe

    //Constructeur qui reprend le constructeur de la classe parent et ajout des avantages
    public function __construct($nom,$puissance,$pointdevie,$avantage){
            parent::__construct($nom,$puissance,$pointdevie); //constructeur de la classe parent Personnage
            $this->avantage=$avantage;
        }

    //Fonction pour appeler les variables tel une fonction _get
    public function afficherNom(){
        return $this->nom; //retourne le nom
    }
    public function afficherSante(){
        return $this->pointdevie; //retourne les points de vie
    }

    //Fonction permettant de modifier les variables (_set)
    public function setSante($pointdevie){
        $this->pointdevie=$pointdevie; //le spoints de vie initiaux devienne les points de vie (change de valeur)
    }
    //Fonction pour appeler les variables tel une fonction _get
    public function afficherPuissance(){
        return $this->puissance;//retourne la puissance
    }
    public function afficherAvantage(){
        return $this->avantage;
    }

    //Fontion permettant d'afficher les statistiques (nom, vie, puissance) du joueur dans une phrase
    public function afficherStatistique(){
        echo $this->nom." possède désormais ".$this->pointdevie." point de vie et ".$this->puissance." point d'attaque ! \n";
    }

    //Cette fonction permet d'attaquer l'ennemi
    public function attaquer(Mechants $cible){ //Etant un Héro, la cible est le Méchant
        $degats = $this->afficherPuissance(); //les dégâts que fait le personnage de la classe héro = puissance du personnage de la classe héro /Récupération de la variable
        $cible->subirDegats($degats); //on appelle la fonction subirDegats pour infliger les dégâts à la cible
    }

    //fonction permettant de subir les dégâts d'une attaque
    public function subirDegats($degats) { //on inflige à la cible les dégâts ou la puissance de notre héro
        $this->pointdevie -= $degats; //on enleve à la vie du personnage les dégâts infligé par l'ennemi
        if ($this->pointdevie <= 0) { //si notre vie est inférieur ou égale à 0
            $this->mourrir(); //on appelle la fonction mourir
        }
    }
    //Création d'une fonction mourir qui représente la mort de notre personnage
    public function mourrir() {
        echo $this->afficherNom() . " est mort."; //on affiche le nom du personnage en appellant la fonction afficherNom
    }

    //fonction permettant de changer de niveau. une fois le niveau 1 fini, on passe au 2
    public function niveauSuperieur($niveau){ // on reprend le niveau 
        $augmentationvie=$this->pointdevie*0.5; //augmentation de la vie du héro pour le niveau suivant
        $this->pointdevie += $augmentationvie; //attribution des nouveaux points de vie à la variable point de vie
        $augmentationpuissance=$this->puissance*0.5;//augmentation de la puissance du héro pour le niveau suivant
        $this->puissance += $augmentationpuissance;//attribution du puissance supérieur à la variable initial
        echo "Felicitation, vous êtes passé au niveau ".$niveau.", vos points de vie sont de ".$this->pointdevie." et votre attaque est de ".$this->puissance." !"; //affichage des nouvelles valeurs des variables
    }
    //création de la fonction de l'attaque Kamehameha en augmentant les dégâts de base
    public function Kamehameha_Bonus(Mechants $cible){ //Etant un Héro, la cible est le Méchant
        $degats = $this->afficherPuissance(); //la variable dégâts prend la valeur de la puissance de la fonction afficherPuissance
        $degats = $degats * 2; //On multiplie les dégâts infligé par 2
        $cible->subirDegats($degats); //l'ennemi subi les dégâts précédents
    }
    //création de la fonction de l'attaque Kamehameha en diminuant les dégâts de base
    public function Kamehameha_Malus(Mechants $cible){//Etant un Héro, la cible est le Méchant
        $degats = $this->afficherPuissance();
        $degats = $degats / 2; //on divise les dégâts par 2
        $cible->subirDegats($degats);
    }
    
}
//Creation de la classe Méchants avec pour parent la classe personnage
class Mechants extends Personnage
{
    //création d'une variable en private car on l'utilise seulement dans la classe Méchants
    private $destructeur;
    //Recuperation avec la classe parent et ajout de l'attribut destructeur
    public function __construct($nom,$puissance,$pointdevie,$destructeur){
            parent::__construct($nom,$puissance,$pointdevie);
            $this->destructeur=$destructeur;
        }
    //Fonctions permettant d'appeller les variables (fonction _get)
    public function afficherNom(){
        return $this->nom;
    }
    public function afficherSante(){
        return $this->pointdevie;
    }
    //fonction permettant de modifier les variables (_set)
    public function setSante($pointdevie){
        $this->pointdevie=$pointdevie;
    }
    public function niveauSuperieur($niveau){ //idem que pour le Héros
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
    public function attaquer(Heros $cible){ //la cible du personnage de la classe Méchants et le personnage de la classe Héros
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

    public function Kamehameha_Bonus(Heros $cible){//Etant un méchant, la cible est le Héro
        $degats = $this->afficherPuissance();
        $degats = $degats * 2;
        $cible->subirDegats($degats);
    }
    public function Kamehameha_Malus(Heros $cible){//Etant un méchant, la cible est le Héro
        $degats = $this->afficherPuissance();
        $degats = $degats / 2;
        $cible->subirDegats($degats);
    }
}

//Création des personnages du jeu 
//issus de la classe Héros
$Goku=new Heros("Goku", 20, 100, "Bouclier");
$Vegeta = new Heros("Vegeta", 10, 120, "plus de vie");

//issus de la classe Méchants
$Freezer = new Mechants("Freezer", 10, 140, "plus de vie");
$Cell = new Mechants("Cell", 15, 100, "plus de dégat");

//Speech d'entrer de jeu. le \n permet de faire un saut de ligne
echo "Bonjour à tous, et bienvenue sur 'Dragon Ball Game'\n 
    Nous sommes heureuses de vous accueillir pour un combat opposant les Héros et les Méchants de cette série culte.\n
    Le jeu comporte au minimum 2 joueurs. Le but est de remporté le plus de combat possible pour gagner le jeu.\n
    Bonne chance à tous et n'oubliez pas, 'Les limites existent uniquement si tu le permets'\n";

$Commence=readline("Voulez-vous commencer (Oui / Non)? "); //on demande à l'utilisateur s'il souhaite commencer. la variable $commence stock la réponse de l'utilisateur
//Trouver pourquoi la fonction empêche le switch de fonctionner
// function Menu($Commence,$Goku,$Cell){
    
    if ($Commence== "Oui"){ //si l'utilisateur met "oui" le menu du jeu s'affiche, avec plusieurs choix
        echo "\nBienvenue dans le menu du jeu. Que voulez-vous faire ?\n
    1. Jouer\n
    2. Afficher les règles\n
    3. Découvrir les personnages\n
    4. Quitter le jeu\n";

    $choix=readline("Quel est votre choix ?\n"); //demande à l'utilisateur quelle partie du menu il souhaite exécuter
        switch ($choix) {//en fonction de la réponse utilisateur
            case "1": //si la réponse utilisateur est "1"
                
                $personnage=readline("Voulez-vous incarner un heros ou un mechant ? \n"); //demande à l'utilisateur s'il veut être un héro ou un méchant
                if ($personnage == "heros") {//s'il répond "heros"
                        $choixpersonnage=readline("Voulez vous être Goku ou Vegeta ? \n"); //demande à l'utilisateur le personnage de son choix entre les 2 propositions
                        switch ($choixpersonnage) {
                            case "Goku": //s'il choisi Goku la variable $hero prendra le personnage de $Goku
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
                        
                        $niveau=1; // premier niveau = 1
                        //on appelle diverses fonctions nous permettant d'afficher les informations des personnages
                        $vieHero=$hero->afficherSante(); 
                        $vieMechant=$mechant->afficherSante();
                        $santeGoku=$hero->afficherSante();
                        $santeCell=$mechant->afficherSante();
                        //tant que la santé du héro et du méchant sont supérieures à 0
                        while ($santeGoku>0 && $santeCell>0){
                            $random=random_int(1,6); //nombre aléatoire entre 1 et 6 nous permettant d'exécuter soit une attaque classique soit une esquive
                            if ($random >= 2) { //si le nombre est égale ou supérieur à 2
                                $hero->attaquer($mechant); //le héro attaque le méchant en lui infligeant des dégâts
                                $santeCell=$mechant->afficherSante();//affichage de la vie du méchant après avoir reçu les dégâts
                                $mechant->afficherStatistique();
                            } else {
                                echo "L'ennemi a esquivé votre attaque ! \n"; //affichage si l'ennemi à esquivé l'attaque
                            }
                            $random=random_int(1,6); //idem mais c'est le tour du méchant d'attaquer
                            if ($random >= 2) {
                                $mechant->attaquer($hero);
                                $santeGoku=$hero->afficherSante();
                                $hero->afficherStatistique();
                            } else {
                                echo "Vous avez esquivé l'attaque ! \n";
                            } 
                        }
                        if ($santeCell> 0 && $santeGoku<=0){ //si la vie de mon personnage héro est inférieur ou égale à 0, j'ai perdu la partie et le jeu est fini
                            //GAMEOVER
                                echo "GAME OVER ! ";
                                break;
                        }
                        $niveau+=1; //permettant d'augmenter de niveau si je gagne le niveau inférieur
                        $kame=1; //cette variable permet d'utiliser l'attaque Kamehameha qu'une seule fois par combat

                        while ($niveau <= 3) { //tant que mon niveau est inférieur ou égale à 3 (sachant qu'au bout du 3eme niveau on gagne le jeu)
                            //affichage des vies et de la puissance du héro et du méchant après augmentation du niveau
                                $hero->setSante($vieHero);
                                $mechant->setSante($vieMechant);
                                $hero->niveauSuperieur($niveau);
                                $mechant->niveauSuperieur($niveau);
                                $santeGoku=$hero->afficherSante();
                                $santeCell=$mechant->afficherSante();
                                while ($santeCell>0 && $santeGoku>0){ //tant que les personnages sont en vies
                                    if($kame==1){ //si la variable est égale à sa valeur initiale
                                        //trim() permet de ne pas prendre en compte les espaces avant et après
                                        $attaque_spe=trim(readline("Voulez-vous utiliser l'attaque Kamehameha ? (Oui/Non) \n")); //demande à l'utilisateur s'il veut ou non utiliser la nouvelle attaque
                                        switch ($attaque_spe) {
                                            case "Oui": //s'il utilise l'attque
                                                echo "L'attaque Kamehameha va être utilisé.\n";
                                                $random2=random_int(1,6); //choix d'un chiffre aléatoire
                                                $kame=0; //on remet cette variable à 0 pour ne puvoir l'utiliser qu'au niveau suivant
                                                //echo $random2;
                                                if ($random2 > 3) { 
                                                    //$Goku->attaquer($Cell);
                                                    $hero->Kamehameha_Bonus($mechant); //appelation de la fonction Kamehameha_Bonus qui fait davantage de dégat que l'initial
                                                    $santeCell=$mechant->afficherSante();
                                                    $mechant->afficherStatistique();
                                                }elseif ($random2 < 3) {
                                                    //$Goku->attaquer($Cell);
                                                    $hero->Kamehameha_Malus($mechant);//appelation de la fonction Kamehameha_Malus qui fait moins de dégat que l'initial
                                                    $santeCell=$mechant->afficherSante();
                                                    $mechant->afficherStatistique();
                                                }else{
                                                    $random=random_int(1,6);
                                                    if ($random > 2) {
                                                        $hero->attaquer($mechant); //attaque classique
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
                                        //ATTAQUE DE L'ENNEMI sur mon personnage héro
                                        $random=random_int(1,6);
                                        if ($random > 2) {
                                            $mechant->attaquer($hero);//c'est le méchant qui attaque l'ennemi
                                            $santeGoku=$hero->afficherSante(); //affiche l'état du héro après dégât
                                            $hero->afficherStatistique();
                                        } else {
                                            echo "Vous avez esquivé l'attaque ! ";
                                        }
                                    }
                                    if ($santeCell<= 0) { //si le méchant est mort, on augmente de niveau
                                        $niveau+=1;
                                        $kame=1;
                                    }
                                    
                                }
                            }
                            echo"Félicitation ! Vous avez gagné ! \n";         //message de la victoire du combat
                        }
            
            if($personnage == "mechant"){ //idem que pour le choix "heros". C'est le personnage de l'utilisateur qui commnce de jouer
                $choixpersonnage=readline("Voulez vous être Cell ou Freezer ? \n");
                        switch ($choixpersonnage) {
                            case "Cell":
                                $hero=$Cell;
                                $mechant=$Goku;
                                break;
                            case "Vegeta":
                                $hero=$Freezer;
                                $mechant=$Goku;

                                break;
                            default:
                                $hero=$Freezer;
                                $mechant=$Goku;

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
                                $mechant->attaquer($hero);
                                $santeCell=$hero->afficherSante();
                                $hero->afficherStatistique();
                            } else {
                                echo "L'ennemi a esquivé votre attaque ! \n";
                            }
                            $random=random_int(1,6);
                            if ($random >= 2) {
                                $hero->attaquer($mechant);
                                $santeGoku=$mechant->afficherSante();
                                $mechant->afficherStatistique();
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
                                $mechant->niveauSuperieur($niveau);
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
                                                    $mechant->Kamehameha_Bonus($hero);
                                                    $santeCell=$hero->afficherSante();
                                                    $hero->afficherStatistique();
                                                }elseif ($random2 < 3) {
                                                    //$Goku->attaquer($Cell);
                                                    $mechant->Kamehameha_Malus($hero);
                                                    $santeCell=$hero->afficherSante();
                                                    $hero->afficherStatistique();
                                                }else{
                                                    $random=random_int(1,6);
                                                    if ($random > 2) {
                                                        $mechant->attaquer($hero);
                                                        $santeCell=$hero->afficherSante();
                                                        $hero->afficherStatistique();
                                                    } else {
                                                        echo "L'ennemi a esquivé votre attaque ! ";
                                                    }
                                            
                                                }
                                                break;
                                                default:
                                                    $random=random_int(1,6);
                                                    if ($random > 2) {
                                                        $mechant->attaquer($hero);
                                                        $santeCell=$hero->afficherSante();
                                                        $hero->afficherStatistique();
                                                    } else {
                                                        echo "L'ennemi a esquivé votre attaque ! ";
                                                    }
                                                break;
                                            }
                                    
                                    }else{
                                        $random=random_int(1,6);
                                        if ($random > 2) {
                                            $mechant->attaquer($hero);
                                            $santeCell=$hero->afficherSante();
                                            $hero->afficherStatistique();
                                        } else {
                                            echo "L'ennemi a esquivé votre attaque ! ";
                                        }
                                    }
                                    if($santeCell>0){
                                        //ATTAQUE DE L'ENNEMI, donc du personnage héro
                                        $random=random_int(1,6);
                                        if ($random > 2) {
                                            $hero->attaquer($mechant);
                                            $santeGoku=$mechant->afficherSante();
                                            $mechant->afficherStatistique();
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
                        }
                
            case "2": //2eme choix du menu
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
            case "4": //permet de quitter le jeu
                echo ("Vous avez quitter le jeu.");
                break;
            default:
        }
        
    }
    


//Menu($Commence,$heros,$mechant);
?>