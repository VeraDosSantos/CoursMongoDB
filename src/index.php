<?php
require_once '../vendor/autoload.php';

// connecter à la base de donnée mongodb
try {
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");
} catch (\MongoDB\Driver\Exception\Exception $e) {
    die($e->getMessage());
}
//la base de donnée
$dataBase = "ma_database";
//collection c'est comme une table en sql
$collection = "etudiants";
//document c'est comme une ligne en sql
$document = [
    "prenom" => "Ayoub",
    "age" => 19,
    "ville" => "Poissy"
];

//creation d'un objet
$bulk = new MongoDB\Driver\BulkWrite();

$bulk->insert($document);
$mongo->executeBulkWrite($dataBase . "." . $collection, $bulk);
//$mongo->executeBulkWrite("ma_database.etudiants", $bulk);

$query = new MongoDB\Driver\Query([]);

$responses = $mongo->executeQuery($dataBase . "." . $collection, $query);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoSQL</title>
</head>

<body>
    <h1>Le cours de NoSQL</h1>
    <?php
    foreach ($responses as $response) {
    ?>
        <p>Prenom : <?= $response->prenom ?></p>
        <p>Age : <?= $response->age ?></p>
        <p>Ville : <?= $response->ville ?></p>
    <?php
    }
    ?>
</body>

</html>