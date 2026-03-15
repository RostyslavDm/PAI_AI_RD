<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charsheet="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Kredytowy</title>

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="templatemo-605-xmas-countdown.css">
    <style>
        body{
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        header {
            position:static; 
            padding: 20px 40px; 
            border-bottom: 1px solid var(--border-glass);
        }

        .calc-wrapper {
            width: 100%;
            max-width: 460px;
            padding: 40px;
            border-radius: 24px;
        }

        .field-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        select {
            width: 100%;
            padding: 18px 24px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--global-glass);
            border-radius: 16px;
            color: var(--text-primary);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
            appearance: none;
        }

        select:focus {
            border-color: var(--accent-gold);
            background: rgba(255, 255, 255, 0.08);
        }

        select option{
            background: #1a1a2e;
        }

        .errors{
            margin-top: 20px;
            padding: 14px 18px;
            background: rgba(255, 61, 90, 0.08);
            border 1px solid rgba(255,61,90,0.3);
            border-radius: 12px;
            color: var(--accent-red);
            font-size: 0.9rem;
        }

        .errors ul {
            margin: 0;
            padding-left: 18px;
        }

        .result {
            margin-top: 20px;
            padding: 20px 24px;
            background: rgba(0, 212, 170, 0.07);
            border: 1px solid rgba(0, 212, 170, 0.25);
            border-radius: 14px;
            line-height: 2;
        }
    </style>
</head>
<body>

    <header>
        <a href="#" class="logo">
            <div class="logo-icon">🏦</div>
            <span class="logo-text">Kalkulator<span>Kredytowy</span></span>
        </a>
    </header>
    <main>
        <div class="glass-strong calc-wrapper">

            <h2 class="section-title" style="font-size:1.8rem; margin-bottom:28px;">
                    Kalkulator Kredytowy
            </h2>
            
            <form action="calc.php" method="get">

                <div class="field-group">
                    <label for="id_k">Kwota kredytu: </label>
                    <div class="newsletter-form">
                        <input id="id_k" name="k" type="text" 
                        placeholder="np. 50000"
                        value="<?php if(isset($kwota)) print($kwota); ?>">
                    </div>
                </div>

                <div class="field-group"> 
                    <label for="id_op">Oprocentowanie roczne: </label>
                    <select id="id_op" name="op">
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
                        value="<?php if(isset($lata)) print($lata); ?>">
                    </div>
                </div>
                
                <button type="submit" class="btn-templatemo"
                        style="width:100%; justify-content:center; margin-top:8px;
                               background:linear-gradient(135deg,var(--accent-red),#ff6b6b);
                               color:var(--text-primary);">
                    Oblicz ratę
                </button>
            </form>

    <?php
    if (!empty($messages)){
        echo "<div class='errors'><ul>";
        foreach ($messages as $msg){
            echo "<li>$msg</li>";
        }
        echo "</ul></div>";
    }
    ?>

    <?php
    if (isset($kwotaCalkowita) && isset($rata)){
        echo "<div class='result'>";
        echo "Kwota całkowita: <strong style=\"color:var(--accent-green);\">".number_format($kwotaCalkowita,2)."</strong><br>";
        echo "Rata miesięczna: <strong style=\"colot:var(--accent-green);\">".number_format($rata,2)."</strong>";
        echo "</div>";
    }
    ?>
    </main>

    <footer style="padding: 20px 40px; border-top: 1px solid var(--border-glass); text-align:center;">
        <p style="font-size:0.85rem; color:var(--text-dim);">
            Widok oparty na stylach i szablonie 
            <a href="https://templatemo.com/tm-605-xmas-countdown" target="_blank">Templatemo</a>
        </p>
    </footer>
</body>
</html>