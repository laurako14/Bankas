<?php
// vienkartinis. naudojamas pirma karta uzpildyti duomenim.
$users = [
    ['name' => 'Princese', 'surname' => 'Fiona', 'pass' => password_hash('princese', PASSWORD_DEFAULT)]
];

file_put_contents('vartotojai.json', json_encode($users));