<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice 1</title>
</head>
<body>
    <h1>Simulation de pose de congée</h1>
    <fieldset>
        <legend>Puis-je poser mes congée ?</legend>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="nbcongee">Solde congée : </label>
            <input type="number" min="0" name="nbcongee" require value="0"><br><br>
            <label for="dateStart">Date de début : </label>
            <input type="date" name="dateStart" require><br><br>
            <label for="dateEnd">Date de fin : </label>
            <input type="date" name="dateEnd" require><br><br>
            <button type="submit">Calculer</button>
        </form>
    </fieldset>
</body>
</html>
<?php

function dateFrToEn($date_fr) {

    // Remplacement des "/" par des "-"
    $timestamp = strtotime(str_replace('/', '-', $date_fr));

    // Vérification du format de la date
    if ($timestamp === false) {
        return false;
    }

    // Passage du format "FR" en "EN"
    $date_en = date("Y-m-d", $timestamp);

    return $date_en;
}

function isholiday($timestamp) {
    $jour = date("d", $timestamp);
    $mois = date("m", $timestamp);
    $annee = date("Y", $timestamp);
    $EstFerie = 0;
    // dates fériées fixes
    if($jour == 1 && $mois == 1) $EstFerie = 1; // 1er janvier
    if($jour == 1 && $mois == 5) $EstFerie = 1; // 1er mai
    if($jour == 8 && $mois == 5) $EstFerie = 1; // 8 mai
    if($jour == 14 && $mois == 7) $EstFerie = 1; // 14 juillet
    if($jour == 15 && $mois == 8) $EstFerie = 1; // 15 aout
    if($jour == 1 && $mois == 11) $EstFerie = 1; // 1 novembre
    if($jour == 11 && $mois == 11) $EstFerie = 1; // 11 novembre
    if($jour == 25 && $mois == 12) $EstFerie = 1; // 25 décembre
    return $EstFerie;
}

function isWeekend($timestamp) {
    $jourSemaine = date("N", $timestamp);
    return ($jourSemaine >= 6); // Samedi = 6 et dimanche = 7
}

//Calcul du nombre de jour
function calculCongee($debut_date_fr,$fin_date_fr){

    // Enregistrer les dates au format "EN"
    $debut_date_en=dateFrToEn($debut_date_fr);
    $fin_date_en=dateFrToEn($fin_date_fr);

    // Calcul de la difference de jour
    $diff_jour=date_diff(date_create($debut_date_en),date_create($fin_date_en));
    $nb_jour = $diff_jour->format("%a"); // Convertir en nombre de jour 
    $timestamp = strtotime($debut_date_en); // Convertir en horodatage Unix
    $nb_jour_valide=$nb_jour+1;

    // Suppression des jours feriées et des weekend
    for ($i=0; $i<=$nb_jour; $i++) {
        if (isholiday($timestamp) || isWeekend($timestamp)){
            $nb_jour_valide-=1;
        }
        $jour = date("d", $timestamp);
        $mois = date("m", $timestamp);
        $annee = date("Y", $timestamp);
        $tomorrow  = mktime(0, 0, 0, $mois  , $jour+1, $annee);
        $timestamp = $tomorrow;
    }

    return $nb_jour_valide;
}

// Affichage
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $solde_congee=$_POST["nbcongee"];
    $debut_date_fr=$_POST["dateStart"];
    $fin_date_fr=$_POST["dateEnd"];
    $calcul_congee=calculCongee($debut_date_fr,$fin_date_fr);
    if ($solde_congee >= $calcul_congee){
        echo $debut_date_fr." à ".$fin_date_fr." → ".$calcul_congee." jours de congés. ";
        echo "Période valide, il vous resterez ".$solde_congee-$calcul_congee." jours de congées possable";
    }
    else{
        echo "Il vous manque ".$calcul_congee-$solde_congee." jours.";
    }
}


?>