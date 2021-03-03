<?php 
require 'bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (mb_strlen($_POST['vardas']) < 3 || mb_strlen($_POST['pavarde']) < 3) {
        $_SESSION['error_msg'] = 'Vardas ir pavarde turi buti ilgesni nei 2 simboliai';
    }
    if (mb_strlen($_POST['asmensNr']) < 11) {
        $_SESSION['error_msg'] = 'Asmens koda turi sudaryti 11 simboliu';
    }
    sukurti($_POST);
    header('Location: http://localhost/Bankas/pagrindinis.php');
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Princeses bankas</title>
</head>
<body>
    <div class="topnav">
        <a href="index.php">Pagrindinis</a>
        <a class="active" href="sukurti.php">Sukurti naują sąskaitą</a>
        <a href="prideti.php">Pridėti lėšas</a>
        <a href="nuskaiciuoti.php">Nuskaičiuoti lėšas</a>
      </div>
    <section>
        <h1>Princesės bankas</h1>
        <h2>Sukurti naują sąskaitą</h2>
    </section>
    <?php if(isset($_SESSION['error_msg'])): ?> 
        <!-- pranesimas yra. atvaizduojame -->
        <h3 style="color:red"><?= $_SESSION['error_msg'] ?></h3>
        <!-- atvaizdavome. nebereikalingas istrinam, kad nerodytu sekati karta -->
        <?php unset($_SESSION['error_msg']) ?>
    <?php endif ?>
    <form action="http://localhost/Bankas/sukurti.php" method="post">
        Vardas:
        <input type="text" name="vardas" required><br>
        Pavardė:
        <input type="text" name="pavarde" required><br>
        Sąskaitos Nr.:
        <input type="text" name="saskaitosNr" required><br>
        Asmens kodas:
        <input type="number" name="asmensNr" required><br>
        <input class="button" type="submit" value="Sukurti">
        <!-- <?php if (mb_strlen($_POST['asmensNr']) < 11) : ?>
        Asmens kodą turi sudaryti 11 simbolių;<br>
        <?php endif ?> -->
        <!-- <?php if (in_array($_POST['asmensNr'], $kodai)) : ?>
        Asmens kodas negali kartotis;<br>
        <?php endif ?> -->
    </form>
</body>
</html>