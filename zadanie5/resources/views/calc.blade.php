@extends('layouts.main')

@section('footer') 💵💵💵 @endsection

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 class="section-title" style="font-size:1.8rem; margin:0;">Kalkulator Kredytowy</h2>
        <div style="font-size:0.85rem; color:var(--text-secondary); text-align:right;">
            <span style="color:var(--accent-gold);">{{ $username }}</span>
            ({{ $role }})<br>
            <a href="/logout" style="color:var(--accent-red); text-decoration:none;">Wyloguj</a>
        </div>
    </div>

    <form action="/calc" method="get">
        <div class="field-group">
            <label for="id_k">Kwota kredytu: </label>
            <div class="newsletter-form">
                <input id="id_k" name="k" type="text"
                    placeholder="np. 50000"
                    value="{{ $form['kwota'] ?? '' }}">
            </div>
        </div>

        <div class="field-group">
            <label for="id_op">Oprocentowanie roczne: </label>
            <select id="id_op" name="op">
                @foreach($availableRates as $value => $label)
                    <option value="{{ $value }}"
                        {{ ($form['oprocentowanie'] ?? '') === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="field-group">
            <label for="id_l">
                Okres spłaty (lata)
                @if(!$isAdmin)
                    <span style="color:var(--accent-red); font-size:0.8rem;">— maks. {{ $maxYears }} lat</span>
                @endif
                :
            </label>
            <div class="newsletter-form">
                <input id="id_l" name="l" type="text"
                    placeholder="{{ $isAdmin ? 'np. 10' : 'np. 5 (maks. ' . $maxYears . ')' }}"
                    value="{{ $form['lata'] ?? '' }}">
            </div>
        </div>

        <button type="submit" class="btn-templatemo"
                style="width:100%; justify-content:center; margin-top:8px;
                       background:linear-gradient(135deg,var(--accent-red),#ff6b6b);
                       color:var(--text-primary);">
            Oblicz ratę
        </button>
    </form>

    @if(!empty($messages))
        <ul class="errors">
            <h3>Wystąpiły błędy: </h3>
            @foreach($messages as $msg)
                <li>{{ $msg }}</li>
            @endforeach
        </ul>
    @endif

    @if(!empty($infos))
        <ul class="infos">
            <h3>Informacje: </h3>
            @foreach($infos as $msg)
                <li>{{ $msg }}</li>
            @endforeach
        </ul>
    @endif

    @if(!empty($result))
        <div class="result">
            Kwota całkowita: <strong style="color:var(--accent-green);">{{ $result['kwota'] }}</strong><br>
            Rata miesięczna: <strong style="color:var(--accent-green);">{{ $result['rata'] }}</strong>
        </div>
    @endif
@endsection