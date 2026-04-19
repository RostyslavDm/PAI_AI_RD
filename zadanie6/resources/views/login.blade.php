@extends('layouts.main')

@section('footer') 💵💵💵 @endsection

@section('content')
    <h2 class="section-title" style="font-size:1.8rem; margin-bottom:28px;">Logowanie</h2>

    @if(isset($error))
        <div class="errors" style="margin-bottom:20px;">{{ $error }}</div>
    @endif

    <form action="/login" method="post">
        @csrf
        <div class="field-group">
            <label for="username">Login: </label>
            <div class="newsletter-form">
                <input id="username" name="username" type="text" placeholder="login">
            </div>
        </div>

        <div class="field-group">
            <label for="password">Hasło: </label>
            <div class="newsletter-form">
                <input id="password" name="password" type="password" placeholder="hasło">
            </div>
        </div>

        <button type="submit" class="btn-templatemo"
                style="width:100%; justify-content:center; margin-top:8px;
                       background:linear-gradient(135deg,var(--accent-red),#ff6b6b);
                       color:var(--text-primary);">
            Zaloguj się
        </button>
    </form>
@endsection