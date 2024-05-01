<?php
function calculerPrixTTCAbonnementSimple($dureeEnMinutes) {
    $tarifParMinute = 2;
    $prixHT = $dureeEnMinutes * $tarifParMinute;
    $tva = 0.20; 
    $prixTTC = $prixHT * (1 + $tva);
    return $prixTTC;
}

function calculerPrixTTCAbonnementForfaitaire($dureeEnMinutes, $typeForfait) {
    $tarifForfait = 0;
    switch ($typeForfait) {
        case 2:
            $tarifForfait = 218; 
            break;
        case 3:
            $tarifForfait = 350; 
            break;
        case 4:
            $tarifForfait = 450; 
            break;
        default:
            $tarifForfait = 0;
            break;
    }

    $prixHT = $tarifForfait;
    $tva = 0.20; 
    $prixTTC = $prixHT * (1 + $tva);
    $typeForfait=$typeForfait-1;
    if ($dureeEnMinutes > $typeForfait * 60) {
        $tarifParMinute = 2;
        $prixTTC += ($dureeEnMinutes - $typeForfait * 60) * $tarifParMinute;
        $prixTTC=$prixHT *(1+$tva);
    }
    return $prixTTC;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $duree = isset($_POST['duree']) ? intval($_POST['duree']) : 0;
    $typeAbonnement = isset($_POST['type_abonnement']) ? intval($_POST['type_abonnement']) : 0;
    if ($typeAbonnement == 1) {
        $prixTTC = calculerPrixTTCAbonnementSimple($duree);
    } elseif ($typeAbonnement >= 2 && $typeAbonnement <= 4) {
        $prixTTC = calculerPrixTTCAbonnementForfaitaire($duree, $typeAbonnement);
    } else {
        $prixTTC = 0;
    }
    echo "Nom : $nom<br>";
        echo "Prix Hors taxe : ". number_format($prixTTC / (1+0.20), 2) . "DH<br>";
        echo "Prix TTC : " . number_format($prixTTC, 2) . "DH<br>";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Calcul de facturation téléphonique</title>
</head>
<body>
    <form method="POST" action="">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <br>
        <label for="duree"> Durée de communications en minutes:</label>
        <input type="number" id="duree" name="duree" required>
        <br>
        <label for="type_abonnement"> Type d'abonnement :</label>
        <select id="type_abonnement" name="type_abonnement" required>
            <option value="1">Abonnement simple</option>
            <option value="2">Forfait 1 heure</option>
            <option value="3">Forfait 2 heures</option>
            <option value="4">Forfait 3 heures</option>
        </select>
        <br>
        <input type="submit" value="Calculer">
    </form>
</body>
</html>