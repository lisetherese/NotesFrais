<?php
abstract class Frais{
    protected static $numstat =1;
    protected $id;
    protected $typeFrais;
    protected $date;
    protected $montant;
    public function __construct(DateTime $date, float $montant){
        $this->id = self::$numstat++;
        $this->date = $date;
        $this->montant = $montant;
    }
    public function getTypeFrais(): string{
        return $this->typeFrais;
    }
    public function getDateTime(): DateTime{
        return $this->date;
    }
    public function setDateTimeTime(DateTime $date){
        $this->date = $date;
    }
   
    public function setMontant(float $montant){
        $this->montant = $montant;
    }

}
class FraisResto extends Frais{
    private $salarie;
    private $invite;
    public function __construct(DateTime $date, float $montant, Salarie $salarie, Client $invite){
        parent::__construct($date, $montant);
        $this->typeFrais = "FraisResto";
        $this->salarie = $salarie; 
        $this->invite = $invite;
    }
    public function getSalarie(): Salarie{
        return $this->salarie;
    }
    public function setSalarie(Salarie $salarie){
        $this->salarie = $salarie;
    }
    public function getInvite(): Client{
        return $this->invite;
    }
    public function setInvite(Client $invite){
        $this->invite = $invite;
    }
    public function getMontant():float{
        return $this->montant;
    }
    
}
class FraisHotel extends Frais{
    private $salarie;
    private $fraisAux;
    public function __construct(DateTime $date, float $montant, Salarie $salarie){
        parent::__construct($date, $montant);
        $this->typeFrais = "FraisHotel"; 
        $this->fraisAux = [];
        $this->salarie = $salarie;
    }
    public function getSalarie(): Salarie{
        return $this->salarie;
    }
    public function setSalarie(Salarie $salarie){
        $this->salarie = $salarie;
    }
    public function addFraisAux(FraisAux $frais){
        $this->fraisAux[] = $frais;
    }
    public function getMontantFraisAux(): float{
        $montant = 0;
        foreach($this->fraisAux as $frais){
            $montant += $frais->getMontant();
        }
        return $montant;
    }
    public function getMontant(): float{
        foreach($this->fraisAux as $frais){
            $this->montant += $frais->getMontant();
        }
        return $this->montant;
    }
}
class FraisKm extends Frais{
    private $depart;
    private $arrivee;
    private $km;
    private $vehicule;
    private $visite;
    private $salarie;
    private $fraisAuxiliaire;
    public function __construct(DateTime $date, float $montant, Ville $lieu_depart, Ville $lieu_arrivee, float $km, Vehicule $vehicule, Client $visite, Salarie $salarie){
        parent::__construct($date, $montant);
        $this->typeFrais = "FraisKm";
        $this->depart = $lieu_depart;
        $this->arrivee = $lieu_arrivee; 
        $this->km = $km;
        $this->vehicule = $vehicule;
        $this->visite = $visite;
        $this->salarie = $salarie;
        $this->fraisAuxiliaire = [];
    }
    public function setDepart(Ville $depart){
        $this->depart = $depart;
    }
    public function getDepart(): Ville{
        return $this->depart;
    }
    public function setArrivee(Ville $arr){
        $this->arrivee = $arr;
    }
    public function getArrivee(): Ville{
        return $this->arrivee;
    }
    public function getSalarie(): Salarie{
        return $this->salarie;
    }
    public function setSalarie(Salarie $salarie){
        $this->salarie = $salarie;
    }
    public function getVehicule(): Vehicule{
        return $this->vehicule;
    }
    public function setVehicule(Vehicule $vehicule){
        $this->vehicule = $vehicule;
    }
    public function getKm(): float{
        return $this->km;
    }
    public function setKm(float $km){
        $this->km = $km;
    }
    public function setVisite(Client $visite){
        $this->visite = $visite;
    }
    public function getVisite(): Client{
        return $this->visite;
    }
    public function addFraisAux(FraisAux $frais){
        $this->fraisAuxiliaire[] = $frais;
    }
    public function getMontantFraisAux(): float{
        $montant = 0.0;
        foreach($this->fraisAuxiliaire as $frais){
            $montant += $frais->getMontant();
        }
        return $montant;
    }
    public function getMontant(): float{
        $montant = $this->km * 0.9; //taux rembourse defini par l Etat_ Je suppose ce taux = 0.9!!!
        return $this->montant+=$this->getMontantFraisAux()+$montant;
    }
   
}
class FraisTaxi extends Frais{
    private $depart;
    private $arrivee;
    private $client;
    private $salarie;
    private $fraisAuxiliaire;

    public function __construct(DateTime $date, float $montant, Ville $depart, Ville $arrivee, Client $client, Salarie $salarie){
        parent::__construct($date, $montant);
        $this->typeFrais = "FraisTaxi"; 
        $this->depart = $depart;
        $this->arrivee = $arrivee;
        $this->client = $client;
        $this->salarie = $salarie;
        $this->fraisAuxiliaire = [];
    }
    public function setDepart(Ville $depart){
        $this->depart = $depart;
    }
    public function getDepart(): Ville{
        return $this->depart;
    }
    public function setArrivee(Ville $arr){
        $this->arrivee = $arr;
    }
    public function getArrivee(): Ville{
        return $this->arrivee;
    }
    public function getClient(): Client{
        return $this->client;
    }
    public function setClient(Client $client){
        $this->client = $client;
    }
    public function getSalarie(): Salarie{
        return $this->salarie;
    }
    public function setSalarie(Salarie $salarie){
        $this->salarie = $salarie;
    }
    public function addFraisAux(FraisAux $frais){
        $this->fraisAuxiliaire[] = $frais;
    }
    public function getMontantFraisAux(): float{
        $montant = 0.0;
        foreach($this->fraisAuxiliaire as $frais){
            $montant += $frais->getMontant();
        }
        return $montant;
    }
    public function getMontant(): float{
        
        return $this->montant+=$this->getMontantFraisAux();
    }
}
class FraisAux extends Frais{
    public function __construct(DateTime $date, float $montant, string $typeFrais){
        parent::__construct($date, $montant);
        $this->typeFrais = $typeFrais;
    }
    public function setTypeFrais(string $type){
        $this->typeFrais = $type;
    }
    public function getMontant():float{
        return $this->montant;
    }
    public function setMontant(float $montant){
        $this->montant = $montant;
    }

}

class Societe{
    private static $numstat =1;
    private $id;
    private $nom;
    public function __construct(string $nom){
        $this->id = self::$numstat++;
        $this->nom = $nom;
    }
    public function getNom(): string{
        return $this->nom;
    }
    public function setNom(string $nom){
        $this->nom = $nom;
    }
}
abstract class Personne {
    protected static $numstat =1;
    protected $id;
    protected $nom;
    public function __construct(string $nom){
        $this->id = self::$numstat++;
        $this->nom = $nom;
    }
    public function getId(): int{
        return $this->id;
    }
    public function getNom(): string{
        return $this->nom;
    }
    public function setNom(string $nom){
        $this->nom = $nom;
    }
}
class Client extends Personne{
    private $qualite;
    private $societe;
    public function __construct(string $nom, string $qualite, Societe $societe){
        parent::__construct($nom);
        $this->qualite = $qualite; 
        $this->societe = $societe;
    }
    public function getQualite(): string{
        return $this->qualite;
    }
    public function setQualite(string $qualite){
        $this->qualite = $qualite;
    }
    public function setSociete(Societe $societe){
        $this->societe = $societe;
    }
    public function getSociete(): Societe{
        return $this->societe;
    }
    
}
class Salarie extends Personne {
    private $societe;
    private $eloignment;
    private $notesFrais;
    private $montantRembourse;
    public function __construct(string $nom, Societe $societe, Eloignment $eloignment){
        parent::__construct($nom);
        $this->societe = $societe;
        $this->eloignment = $eloignment;
        $this->notesFrais = [];
        $this->montantRembourse = 0.0;
    }
    public function setSociete(Societe $societe){
        $this->societe = $societe;
    }
    public function getSociete(): Societe{
        return $this->societe;
    }
    public function setEloignment(Eloignment $eloignment){
        $this->eloignment  = $eloignment;
    }
    public function getEloignment(): Eloignment{
        return $this->eloignment;
    }
    public function addNotesFrais(Frais $frais){
    if($frais->getSalarie()->getId() == $this->id){
        if($frais instanceof FraisResto){
            $notesMemeDate =[];
            foreach($this->notesFrais as $note){
                if($note->getTypeFrais()== "FraisResto" && $frais->getDateTime()->format('Y-m')== $note->getDateTime()->format('Y-m')){
                    $notesMemeDate[] = $note;
            }
            }
            if(count($notesMemeDate)<= 5){
                $this->notesFrais['Resto'] = $frais;
                $this->montantRembourse +=$frais->getMontant();
            }else{ echo "<script>alert(abus manifeste!!!);</script>";}

        }elseif($frais instanceof FraisHotel && ($this->eloignment->getDistance()>= 50 || $this->eloignment->getDuree_trajet() >= 90)){
            
                $this->notesFrais['Hotel'] = $frais;
                $this->montantRembourse +=$frais->getMontant();
                echo "<script> alert(attention au montant des services annexes: ".$frais->getMontantFraisAux()."!);</script>";
        
        }elseif($frais instanceof FraisKm && $this->nom == $frais->getVehicule()->getSalarie()->getNom()){
            $this->notesFrais['Km'] = $frais;
            $this->montantRembourse +=$frais->getMontant();
        
        }elseif($frais instanceof FraisTaxi){
            $this->notesFrais['Taxi'] = $frais;
            $this->montantRembourse +=$frais->getMontant();
        }

    }else{echo "<script> alert(ce ticket ne appartient pas à ce salarie);</script>";}
    }

    public function getMontantRembourse(): float{
        return $this->montantRembourse;
    }
    public function getNotesFrais(): array{
        return $this->notesFrais;
    }
    public function getStringNotesFrais(): string{
        $allnotes = "";
        if (!empty($this->notesFrais)){
            foreach($this->notesFrais as $note){
                $allnotes = $allnotes."<br>".$note;
            }
            return $allnotes;
        }else { return "Ce salarie n'a aucune Note de Frais a rembourser.";}
    }
    public function toJS(){
        json_encode($this->societe);
        json_encode($this->eloignment);
        foreach($this->notesFrais as $frais){
            json_encode($frais);
        }
       return json_encode($this, true); 
    }
    
}

class Eloignment{
    private static $numstat =1;
    private $id;
    private $distance;
    private $duree_trajet;
    public function __construct(float $distance, int $duree_trajet){
        $this->id = self::$numstat++;
        $this->distance = $distance;
        $this->duree_trajet = $duree_trajet;
    }
    public function setDistance(float $distance){
        $this->distance = $distance;
    }
    public function getDistance(): float{
        return $this->distance;
    }
    public function setDuree_trajet(int $duree){
        $this->duree_trajet = $duree;
    }
    public function getDuree_trajet(): int{
        return $this->duree_trajet;
    }

}

class Vehicule {
    private static $numstat =1;
    private $id;
    private $plaque;
    private $puissance;
    private $salarie;
    public function __construct(string $plaque,float $puissance, Salarie $salarie){
        $this->id = self::$numstat++;
        $this->plaque = $plaque;
        $this->puissance = $puissance;
        $this->salarie = $salarie;
    }
    public function getPlaque(): string{
        return $this->plaque;
    }
    public function setPlaque(string $plaque){
        $this->plaque = $plaque;
    }
    public function getPuissance(): float{
        return $this->puissance;
    }
    public function setPuissance(float $puis){
        $this->puissance = $puis;
    }
    public function getSalarie():Salarie{
        return $this->salarie;
    }
    public function setSalarie(Salarie $salarie){
        $this->salarie = $salarie;
    }
}
class Ville{
    private static $numstat =1;
    private $id;
    private $nom;
    private $add;
    public function __construct(string $nom, string $add){
        $this->id = self::$numstat++;
        $this->nom = $nom;
        $this->add = $add;
    } 

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;

    }
    public function getAdd(): string{
        return $this->add;
    }
    public function setAd(string $add){
        $this->add = $add;
    }
}

?>