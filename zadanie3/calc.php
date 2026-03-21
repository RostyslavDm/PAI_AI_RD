<?php
    require_once "lib\smarty\libs\Smarty.class.php";

    use Smarty\Smarty;

    // 1. pobranie parametrów

    function getParams(&$form){
        $form['kwota'] = $_REQUEST["k"] ?? null;
        $form['oprocentowanie'] = $_REQUEST["op"] ?? null;
        $form['lata'] = $_REQUEST["l"] ?? null;
    }

    // 2. walidacja parametrów
    function validate(&$form, &$infos, &$msgs, &$hide_intro){

        if (!(isset($form['kwota']) && isset($form['oprocentowanie']) && isset($form['lata']))){
            return false;
        }

        $hide_intro = true;

        $infos [] = 'Przekazano parametry.';

        if ($form['kwota'] == ""){
            $msgs [] = 'Nie podano kwoty kredytu.';
        } 
        else if (! is_numeric($form['kwota'])){
            $msgs [] = 'Kwota kredytu nie jest liczbą.';
        }
        else if ($form['kwota'] <= 0){
            $msgs[] = 'Kwota kredytu musi być większa od 0.';
        }


        if ($form['oprocentowanie'] == ""){
            $msgs [] = 'Nie podano oprocentowania.';
        } 
        else if (! is_numeric($form['oprocentowanie'])){
            $msgs [] = 'Oprocentowanie nie jest liczbą.';
        } 
        else if ($form['oprocentowanie'] <= 0){
            $msgs[] = 'Oprocentowanie musi być większe od 0.';
        }


        if ($form['lata'] == ""){
            $msgs [] = 'Nie podano okresu spłaty.';
        } 
        else if (! is_numeric($form['lata'])){
            $msgs [] = 'Okres spłaty nie jest liczbą.';
        } 
        else if ($form['lata'] <= 0){
            $msgs[] = 'Okres spłaty musi być większy od 0.';
        }

        if(count($msgs)>0) return false;
        return true;

    }


    // 3. zadanie

    function process(&$form, &$infos, &$msgs, &$result){
        $infos [] = 'Parametry poprawne. Wykonuję obliczenia.';
    
        $form['kwota']= floatval($form['kwota']);
        $form['oprocentowanie']= floatval($form['oprocentowanie']);
        $form['lata']= floatval($form['lata']);

        $form['op_name'] = ($form['oprocentowanie']*100).'%'; 

        $odsetki = $form['oprocentowanie'] * $form['lata'] * $form['kwota'];
        $kwotaCalkowita = $form['kwota']+ $odsetki;
        $rata = $kwotaCalkowita/($form['lata']*12);
        $result['kwota'] = $kwotaCalkowita;
        $result['rata'] = $rata;
    }

    $form = null;
    $infos = array();
    $messages = array();
    $result = array();

    getParams($form);
    if ( validate($form, $infos, $messages, $hide_intro) ){
        process($form, $infos, $messages, $result);
    }

    // 4. przygotowanie danych dla szablonu
    $smarty = new Smarty();

    $smarty->assign('page_title','Kalkulator Kredytowy');
    $smarty->assign('page_description','Kalkulator Kredytowy');
    $smarty->assign('page_header','<div class="logo-icon">🏦</div>
            <span class="logo-text">Kalkulator<span>Kredytowy</span></span>');

    $smarty->assign('form',$form);
    $smarty->assign('result',$result);
    $smarty->assign('messages',$messages);
    $smarty->assign('infos',$infos);

    

    $smarty->display('calc.html');

?>