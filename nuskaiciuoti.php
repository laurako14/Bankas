<?php 
require 'bootstrap.php';

//POST scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'] ?? 0;
    $id = (int) $id;
    
    $suma = $_POST['suma'] ?? 0;
    $suma -= $_POST['suma2'];
    $suma = (int) $suma;
    atnaujinti($id, $suma); // redaguoja
    header('Location: http://localhost/Bankas/pagrindinis.php');
    die;

}
//GET scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'] ?? 0;
    $id = (int) $id;
    $saskaita = saskaitosGavimas($id);
    if(!$saskaita) {
        header('Location: http://localhost/Bankas/pagrindinis.php');
    die;
    }
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
        <a href="sukurti.php">Sukurti naują sąskaitą</a>
        <a href="prideti.php">Pridėti lėšas</a>
        <a class="active" href="nuskaiciuoti.php">Nuskaičiuoti lėšas</a>
      </div>
    <section>
        <h1>Princesės bankas</h1>
        <h2>Nuskaičiuoti lėšas</h2>
    </section>
    <form action="nuskaiciuoti.php?id=<?= $saskaita['id'] ?>" method="post">
    Likutis: <input type="text" value="<?= $saskaita['suma'] ?>" name="suma">
    Nuskaiciuojama suma: <input type="text" value="" name="suma2">
    <button type="submit">Nuskaiciuoti</button>
    </form>
</body>
</html>