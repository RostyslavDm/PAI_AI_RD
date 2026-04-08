@extends('layouts.main')

@section('footer') 💵💵💵 @endsection

@section('content')
    <h2 class="section-title" style="font-size:1.8rem; margin-bottom:28px;">Kalkulator Kredytowy</h2>

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
                @if(isset($form['op_name']))
                    <option value="{{ $form['oprocentowanie'] }}">{{ $form['op_name'] }}</option>
                @endif
                <option value="0.02">2%</option>
                <option value="0.04">4%</option>
                <option value="0.05">5%</option>
                <option value="0.07">7%</option>
            </select>
        </div>

        <div class="field-group">
            <label for="id_l">Okres spłaty (lata): </label>
            <div class="newsletter-form">
                <input id="id_l" name="l" type="text"
                    placeholder="np. 10"
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