<?php 
require 'bootstrap.php';

//POST scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'] ?? 0;
    $id = (int) $id;
    istrinti($id); // trina
    header('Location: http://localhost/Bankas/pagrindinis.php');
    die;
}


header('Location: http://localhost/Bankas/pagrindinis.php');
die;