<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['nom']) || isset($_GET['prenom'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
    }
    echo "<h2>Bonjour $nom $prenom </h2>";
} else {
    echo '
    <h2>FORMULAIRE</h2>
    <form action="" method="post">

        Entrez votre Nom : <br>
        <input type="text" name="nom" id="nom"><br><br>

        Entrez votre Prenom : <br>
        <input type="text" name="prenom" id="prenom"><br><br>
        
        <input type="submit" value="Confirmer">
    </form>';
}
?>

</body>
</html>