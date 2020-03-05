<?php

$dsn = "mysql:host=localhost;dbname=netland";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);
$movies_request = $pdo->prepare("SELECT * FROM movies WHERE volgnummer=?");
$movies_request->execute([$_GET['id']]);
$to_show = $movies_request->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['titel'])) {
    $updating_series = $pdo->prepare("UPDATE movies SET titel=?, duur_in_min=?, omschrijving=?, datum_van_uitkomst=?, land_van_uitkomst=?, trailer_id_youtube=? WHERE volgnummer=?");
    $updating_series->execute(
        [$_POST['titel'],
            $_POST['duur_in_min'],
            $_POST['omschrijving'],
            $_POST['datum_van_uitkomst'],
            $_POST['land_van_uitkomst'],
            $_POST['trailer_id_youtube'],
            $_GET['id']]
    );
}
?>

<!DOCTYPE html>
<html>

<head>

</head>

<body>
<main>
    <h2>Wijzig data<?php echo PHP_EOL . $to_show['titel']; ?> wijzigen:</h2>
    <form method="post">
            <h2>Titel</h2>
            <input type="text" name="titel" value="<?php echo $to_show['titel'];?>">
        </div>
            <h2>Duration</h2>
            <input type="text" name="duur_in_min" value="<?php echo $to_show['duur_in_min'];?>">
        </div>
            <h2>Description</h2>
            <textarea rows="15" cols="40"type="text" name="omschrijving"><?php echo $to_show['omschrijving'];?></textarea>
        </div>
            <h2>Release Date</h2>
            <input type="text" name="datum_van_uitkomst" value="<?php echo $to_show['datum_van_uitkomst'];?>">
        </div>
            <h2>Country of Origin</h2>
            <input type="text" name="land_van_uitkomst" value="<?php echo $to_show['land_van_uitkomst'];?>">
        </div>
            <h2>Trailer ID for Youtube</h2>
            <input type="text" name="trailer_id_youtube" value="<?php echo $to_show['trailer_id_youtube'];?>">
        </div>
        <input type="submit" name='submit' value='Wijzig'>
    </form>
</main>
</body>

</html>