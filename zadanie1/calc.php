<?php
    // 1. pobranie parametrów

    $kwota = $_REQUEST["k"] ?? null;
    $oprocentowanie = $_REQUEST["op"] ?? null;
    $lata = $_REQUEST["l"] ?? null;

    // 2. walidacja parametrów

    $messages = [];

    if (!(isset($kwota) && isset($oprocentowanie) && isset($lata))){
        $messages [] = 'Brak jednego z parametrów.';
    }

    if ($kwota == ""){
        $messages [] = 'Nie podano kwoty kredytu.';
    } 
    else if (! is_numeric($kwota)){
            $messages [] = 'Kwota kredytu nie jest liczbą.';
    }
    else if ($kwota <= 0){
        $messages[] = 'Kwota kredytu musi być większa od 0.';
    }


    if ($oprocentowanie == ""){
        $messages [] = 'Nie podano oprocentowania.';
    } 
    else if (! is_numeric($oprocentowanie)){
        $messages [] = 'Oprocentowanie nie jest liczbą.';
    } 
    else if ($oprocentowanie <= 0){
        $messages[] = 'Oprocentowanie musi być większe od 0.';
    }


    if ($lata == ""){
        $messages [] = 'Nie podano okresu spłaty.';
    } 
    else if (! is_numeric($lata)){
        $messages [] = 'Okres spłaty nie jest liczbą.';
    } 
    else if ($lata <= 0){
        $messages[] = 'Okres spłaty musi być większy od 0.';
    }

    // 3. zadanie
    if (empty($messages)){
        $kwota = floatval($kwota);
        $oprocentowanie = floatval($oprocentowanie);
        $lata = floatval($lata);

        $odsetki = $oprocentowanie * $lata * $kwota;
        $kwotaCalkowita = $kwota + $odsetki;
        $rata = $kwotaCalkowita/($lata*12);
    }
    // 4. widok
    include 'calc_view.php';

?>