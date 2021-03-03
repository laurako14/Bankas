<?php 
require 'bootstrap.php';
_d(skaityti());
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
        <a class="active" href="pagrindinis.php">Pagrindinis</a>
        <a href="sukurti.php">Sukurti naują sąskaitą</a>
        <a href="prideti.php">Pridėti lėšas</a>
        <a href="nuskaiciuoti.php">Nuskaičiuoti lėšas</a>
      </div>
    <section>
        <h1>Princesės bankas</h1>
    </section>
    <section>
        <p>Sąskaitų sąrašas:</p>
        <ul>
        <?php $bankas = skaityti(); ?>
        <?php foreach ($bankas as $saskaita): ?>
        <li>
        <span>Saskaitos Nr.: <?= $saskaita['saskaitosNr'] ?></span><br> 
        <span>Vardas, pavarde: <?= $saskaita['vardas'].' '.$saskaita['pavarde'] ?></span><br>
        <span>Likutis: <?= $saskaita['suma'] ?></span><br> 
        <a href="prideti.php?id=<?= $saskaita['id'] ?>">Pridėti lėšų</a>
        <a href="nuskaiciuoti.php?id=<?= $saskaita['id'] ?>">Nuskaičiuoti lėšas</a>
        <form action="istrinti.php?id=<?= $saskaita['id'] ?>" method="post">
        <button type="submit">Ištrinti</button>
        </form>
        </li>
    <?php endforeach ?>
          </ul>
    </section>
</body>
</html>