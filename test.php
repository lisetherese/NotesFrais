<!DOCTYPE html>
<html lang="fr-FR">
<head>

  <title>Test Notes de Frais</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http:\\localhost\companyWeb\menu.css" />
  <style>
table {
  table-layout : flex;
}
table, th, td {
  border: 2px solid darkblue;
  width: 100%;
  text-align: center;
  padding: 0;

}

tr:nth-child(even) {
  background-color: #D6EEEE;
}
</style>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a href="#myPage"><img src="http:\\localhost\Notes_de_Frais\Lise_logo.png" alt="logo ATF" width="50"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#salarie">INPUT SALARIE INFO</a></li>
        <li><a href="#hotel">TEST FRAIS HOTEL</a></li>
        <li><a href="#km">TEST FRAIS KILOMETRE</a></li>
        <li><a href="#resto">TEST FRAIS RESTO</a></li>
        <li><a href="#taxi">TEST FRAIS TAXI</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="text-center" style="background-image:url('https://img.pixers.pics/pho_wat(s3:700/FO/89/55/10/95/700_FO89551095_86f1f5c6edccac34436737bf7ed11122.jpg,700,409,cms:2018/10/5bd1b6b8d04b8_220x50-watermark.png,over,480,359,jpg)/throw-pillows-autumn-background-with-a-tree-and-golden-leaves-vector.jpg.jpg');background-color: #342997; background-repeat: repeat;padding: 100px 25px;">
  <h1 style="color:#1171ee;text-shadow: 2px 2px 4px #000000 ; font-family: Verdana, Geneva, Tahoma, sans-serif;"><strong>Test notes de frais</strong></h1> 
  <p style="color:#f4511e;text-shadow: 2px 4px 4px #000000; font-size: 30px;"><strong>Devoir maison</strong></p> 
</div>

<div id="salarie" class="container-fluid">
  <div class="row">
    <div>
      <p style="color:#342997;text-align: center;font-size:30px;">
      INFO affiche:<br>
        <?php
        include_once("Frais.php");
        $societe = new Societe("ITIS");
        $societe1 = new Societe("Partner");
        $eloignment = new Eloignment(56.5,60);
        $salarie = new Salarie("Lise",$societe,$eloignment);
        $client = new Client ('David','directeur',$societe1);
        $vehicule = new Vehicule("BG-465-BL",4.2,$salarie);
        $date1 = new DateTime ('2021-10-08');
        $date2 = new DateTime ('2021-10-05');
        $date3 = new DateTime ('2021-10-01');
        $fraisResto = new FraisResto($date1,120,$salarie, $client);
        $fraisAuxHotel = new FraisAux($date2,10,"lavage vetement");
        $fraisHotel = new FraisHotel($date2,40.5,$salarie);
        $fraisHotel->addFraisAux($fraisAuxHotel);
        $villeDep = new Ville('Fresnes',"7 rue du Bourg");
        $villeArr = new Ville('Evry','2 boulevard Champs Elysees');
        $fraisKm = new FraisKm($date3,60,$villeDep, $villeArr,21.4,$vehicule, $client, $salarie);
        $fraisParking = new FraisAux($date3,5,"parking");
        $fraisKm->addFraisAux($fraisParking);
        $fraisTaxi = new FraisTaxi($date2,30,$villeDep, $villeArr, $client,$salarie);

        $salarie->addNotesFrais($fraisResto);
        $salarie->addNotesFrais($fraisHotel);
        $salarie->addNotesFrais($fraisKm);
        $salarie->addNotesFrais($fraisTaxi);
        //echo "Montant rembourse total du salarie ".$salarie->getNom()." est:<br>".$salarie->getMontantRembourse();
        //$societeJ = json_encode($societe);
        //$eloignmentJ = json_encode($eloignment);
  
        //var_dump(json_encode(($salarie) null));
        //echo $salarieJSON;
        $json = ($salarie);
        $json = json_encode($json);
        var_dump($json, JSON_FORCE_OBJECT);

        ?>
      </p>
</div>
<div class="row">
<table >
<thead>
<tr>
    <th colspan="4">Salarie</th>
    <th  colspan="2">Vehicule</th>
    <th  colspan="3"> Client </th>
    
    <th colspan="<?php echo count($salarie->getNotesFrais());  ?>">Frais & Montant</th>
    <!--<th colspan="<?php echo count($salarie->getNotesFrais())+count();  ?>">Frais annexes & Montant</th>-->
    
  </tr>
  <tr>
    <th>Nom</th>
    <th>Societe</th>
    <th>Distance en km</th>
    <th>Heure trajet</th>
    <th>Plaque</th>
    <th>Puissance</th>
    <th>Nom</th>
    <th>Qualite</th>
    <th>Societe</th>
    <?php
    foreach($salarie->getNotesFrais() as $frais){
      echo "<th>".$frais->getTypeFrais()."</th>";
     // echo "<th>".$frais->getMontant()."</th>";
    }
    ?>
    

</tr>
</thead>
<tbody>
</tbody>
</table>

    </div>
  </div>
</div>

<script>

$(document).ready(function(){
   $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    
    if (this.hash !== "") {
      
      event.preventDefault();
      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        window.location.hash = hash;
      });
    } 
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>
</body>
</html>