<?php 
require 'bootstrap.php';

// POST metodo scenarijus LOGIN
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    _d($_POST);

    $users = file_get_contents('vartotojai.json');
    $users = json_decode($users, 1);

    $postName = $_POST['name'] ?? '';
    $postPass = $_POST['pass'] ?? '';

    foreach ($users as $user) {
        if ($postName == $user['name']) { 
            if (password_verify($postPass, $user['pass'])) { 
                $_SESSION['login'] = 1;
                $_SESSION['user'] = $user;
                header('Location: http://localhost/Bankas/pagrindinis.php');
                die;
            }
        }
    }
    $_SESSION['error_msg'] = 'Password or Name is invalid.';
    header('Location: http://localhost/Bankas/login.php');
    die;
}


// Jau prisijungusio vartotojo scenarijus
if(isset($_SESSION['login']) && 1 == $_SESSION['login']) {
    header('Location: http://localhost/Bankas/pagrindinis.php');
    die;
}


// Prisijungimo formos rodymo scenarijus

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Prisijungimas</title>
</head>
<body>
    <h1>Princeses bankas</h1>
    <h2>Prisijungimo puslapis</h2>
    <!-- tikrinam ar yra pranesimas -->
    <?php if(isset($_SESSION['error_msg'])): ?> 
        <!-- pranesimas yra. atvaizduojame -->
        <h3 style="color:red"><?= $_SESSION['error_msg'] ?></h3>
        <!-- atvaizdavome. nebereikalingas istrinam, kad nerodytu sekati karta -->
        <?php unset($_SESSION['error_msg']) ?>
    <?php endif ?>
    <form action="login.php" method="post">
        VARDAS:<input type="text" name="name">
        SLAPTAZODIS:<input type="password" name="pass">
        <button type="submit">Prisijungti</button>
    </form>
</body>
</html>