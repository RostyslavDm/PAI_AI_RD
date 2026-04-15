<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcController extends Controller
{
    const RATES_ALL  = ['0.02' => '2%', '0.04' => '4%', '0.05' => '5%', '0.07' => '7%'];
    const RATES_USER = ['0.02' => '2%', '0.04' => '4%'];
    const MAX_YEARS_USER = 10;

    public function calc(Request $request)
    {
        if (!session('auth_user')) {
            return redirect('/login');
        }

        $role      = session('auth_role');
        $isAdmin   = $role === 'admin';
        $availableRates = $isAdmin ? self::RATES_ALL : self::RATES_USER;

        $form = [
            'kwota'         => $request->input('k'),
            'oprocentowanie' => $request->input('op'),
            'lata'          => $request->input('l'),
        ];

        $infos    = [];
        $messages = [];
        $result   = [];

        if ($this->validate_form($form, $infos, $messages, $isAdmin)) {
            $this->process($form, $infos, $result);
        }

        return view('calc', [
            'form'           => $form,
            'infos'          => $infos,
            'messages'       => $messages,
            'result'         => $result,
            'isAdmin'        => $isAdmin,
            'availableRates' => $availableRates,
            'maxYears'       => $isAdmin ? null : self::MAX_YEARS_USER,
            'username'       => session('auth_user'),
            'role'           => $role,
            'page_title'       => 'Kalkulator Kredytowy',
            'page_description' => 'Kalkulator Kredytowy',
            'page_header'      => '<div class="logo-icon">🏦</div>
                <span class="logo-text">Kalkulator<span>Kredytowy</span></span>',
        ]);
    }

    private function validate_form(array &$form, array &$infos, array &$messages, bool $isAdmin): bool
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
        } elseif (!$isAdmin) {
            // Перевірка лише для звичайного користувача
            if (!array_key_exists($form['oprocentowanie'], self::RATES_USER)) {
                $messages[] = 'Wybrane oprocentowanie jest niedozwolone dla Twojej roli.';
            }
        }

        if ($form['lata'] === null || $form['lata'] === '') {
            $messages[] = 'Nie podano okresu spłaty.';
        } elseif (!is_numeric($form['lata'])) {
            $messages[] = 'Okres spłaty nie jest liczbą.';
        } elseif ($form['lata'] <= 0) {
            $messages[] = 'Okres spłaty musi być większy od 0.';
        } elseif (!$isAdmin && $form['lata'] > self::MAX_YEARS_USER) {
            $messages[] = 'Okres spłaty nie może przekraczać ' . self::MAX_YEARS_USER . ' lat dla zwykłego użytkownika.';
        }

        if (count($messages) > 0) return false;
        return true;
    }

    private function process(array &$form, array &$infos, array &$result): void
    {
        $infos[] = 'Parametry poprawne. Wykonuję obliczenia.';

        $form['kwota']          = floatval($form['kwota']);
        $form['oprocentowanie'] = floatval($form['oprocentowanie']);
        $form['lata']           = floatval($form['lata']);
        $form['op_name']        = ($form['oprocentowanie'] * 100) . '%';

        $odsetki        = $form['oprocentowanie'] * $form['lata'] * $form['kwota'];
        $kwotaCalkowita = $form['kwota'] + $odsetki;
        $rata           = $kwotaCalkowita / ($form['lata'] * 12);

        $result['kwota'] = $kwotaCalkowita;
        $result['rata']  = $rata;
    }
}