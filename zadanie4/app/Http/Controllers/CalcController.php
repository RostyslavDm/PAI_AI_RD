<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcController extends Controller
{
    public function index()
    {
        return redirect('/calc');
    }

    public function calc(Request $request)
    {
        $form = [
            'kwota' => $request->input('k'),
            'oprocentowanie' => $request->input('op'),
            'lata' => $request->input('l'),
        ];

        $infos = [];
        $messages = [];
        $result = [];

        if ($this->validate_form($form, $infos, $messages)) {
            $this->process($form, $infos, $messages, $result);
        }

        return view('calc', [
            'form'         => $form,
            'infos'        => $infos,
            'messages'     => $messages,
            'result'       => $result,
            'page_title'       => 'Kalkulator Kredytowy',
            'page_description' => 'Kalkulator Kredytowy',
            'page_header'      => '<div class="logo-icon">🏦</div>
                        <span class="logo-text">Kalkulator<span>Kredytowy</span></span>',
        ]);
    }

    private function validate_form(array &$form, array &$infos, array &$messages): bool
    {
        if (!isset($form['kwota']) && !isset($form['oprocentowanie']) && !isset($form['lata'])) {
            return false;
        }

        $infos[] = 'Przekazano parametry.';

        if ($form['kwota'] === null || $form['kwota'] === '') {
            $messages[] = 'Nie podano kwoty kredytu.';
        } elseif (!is_numeric($form['kwota'])) {
            $messages[] = 'Kwota kredytu nie jest liczbą.';
        } elseif ($form['kwota'] <= 0) {
            $messages[] = 'Kwota kredytu musi być większa od 0.';
        }

        if ($form['oprocentowanie'] === null || $form['oprocentowanie'] === '') {
            $messages[] = 'Nie podano oprocentowania.';
        } elseif (!is_numeric($form['oprocentowanie'])) {
            $messages[] = 'Oprocentowanie nie jest liczbą.';
        } elseif ($form['oprocentowanie'] <= 0) {
            $messages[] = 'Oprocentowanie musi być większe od 0.';
        }

        if ($form['lata'] === null || $form['lata'] === '') {
            $messages[] = 'Nie podano okresu spłaty.';
        } elseif (!is_numeric($form['lata'])) {
            $messages[] = 'Okres spłaty nie jest liczbą.';
        } elseif ($form['lata'] <= 0) {
            $messages[] = 'Okres spłaty musi być większy od 0.';
        }

        if (count($messages) > 0) return false;
        return true;
    }

    private function process(array &$form, array &$infos, array &$messages, array &$result): void
    {
        $infos[] = 'Parametry poprawne. Wykonuję obliczenia.';

        $form['kwota']         = floatval($form['kwota']);
        $form['oprocentowanie'] = floatval($form['oprocentowanie']);
        $form['lata']          = floatval($form['lata']);
        $form['op_name']       = ($form['oprocentowanie'] * 100) . '%';

        $odsetki         = $form['oprocentowanie'] * $form['lata'] * $form['kwota'];
        $kwotaCalkowita  = $form['kwota'] + $odsetki;
        $rata            = $kwotaCalkowita / ($form['lata'] * 12);

        $result['kwota'] = $kwotaCalkowita;
        $result['rata']  = $rata;
    }
}