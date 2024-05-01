<?php
function estPremier($nombre) {
    if ($nombre < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($nombre); $i++) {
        if ($nombre % $i === 0) {
            return false;
        }
        
    }
    return true;
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_REQUEST['nombre']) ? intval($_REQUEST['nombre']) : 0;
    $resultat = estPremier($nombre) ? "est premier" : "n'est pas premier";
}
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Vérification de nombre premier</title>
    </head>
    <body>
    <form method="POST" action="">
        <label for="nombre"> Entrer un nombre :</label>
        <input type="number" id="nombre" name="nombre" required>
        <br>
        <input type="submit" value="Vérifier">
    </form>
    </body>
    </html>
    <?php
if(isset($resultat)) {
echo "Le nombre $nombre $resultat";
}
?>