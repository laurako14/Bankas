<?php 

function skaityti() : array
{
    if (!file_exists('bankas.json')) {// pirmas kartas
        $bankas = json_encode([]);
        file_put_contents('bankas.json', $bankas);
    }

    $bankas = file_get_contents('bankas.json');
    return json_decode($bankas, 1);
}

function irasyti(array $bankas) : void
{
    $bankas = json_encode($bankas);
    file_put_contents('bankas.json', $bankas);
}

function saskaitosGavimas(int $id) : ?array
{
    foreach(skaityti() as $saskaita) {
        if ($saskaita['id'] == $id) {
            return $saskaita;
        }
    }
    return null;
}

function sukurti(array $saskaita) : void
{
    $bankas = skaityti();
    $id = getNextId();
    $saskaitosNr = saskaitosGeneravimas();
    $saskaita = ['id' => $id, 'suma'=> 0, 'vardas' => $saskaita['vardas'], 'pavarde' => $saskaita['pavarde'], 'asmensNr' => $saskaita['asmensNr'], 'saskaitosNr' => $saskaitosNr];
    $bankas[] = $saskaita;
    irasyti($bankas);
}

function atnaujinti(int $id, int $count) : void
{
    $bankas = skaityti();// visai visi
    $saskaita = saskaitosGavimas($id);
    if(!$saskaita) {
        return;
    }
    $saskaita['suma'] = $count;
    istrinti($id);
    $bankas = skaityti(); // visi be istrinto
    $bankas[] = $saskaita; 
    irasyti($bankas);
}

function istrinti(int $id) : void
{
    $bankas = skaityti();
    foreach($bankas as $key => $saskaita) {
        if ($saskaita['id'] == $id) {
            unset($bankas[$key]);
            irasyti($bankas);
            return;
        }
    }
}


function getNextId() : int
{
    if (!file_exists('indexes.json')) {// pirmas kartas
        $index = json_encode(['id'=> 1]);
        file_put_contents('indexes.json', $index);
    }
    $index = file_get_contents('indexes.json');
    $index = json_decode($index, 1);
    $id = (int) $index['id'];
    $index['id'] = $id + 1;
    $index = json_encode($index);
    file_put_contents('indexes.json', $index);
    return $id;
}

function saskaitosGeneravimas() : string 
{
    if (!file_exists('saskaitosNr.json')) {// pirmas kartas
        $saskaitosNr = json_encode(['saskaitosNr'=> LT4400000]);
        file_put_contents('saskaitosNr.json', $saskaitosNr);
    }
    $saskaitosNr = file_get_contents('saskaitosNr.json');
    $saskaitosNr = json_decode($saskaitosNr, 1);
    $numeris = (int) $saskaitosNr['saskaitosNr'];
    $saskaitosNr['saskaitosNr'] = $numeris + 1;
    $saskaitosNr = json_encode($saskaitosNr);
    file_put_contents('saskaitosNr.json', $saskaitosNr);
    return $numeris;
}