<!DOCTYPE html>
<html lang="pl">
    <style>
body{
    font-family: Arial, sans-serif;
    background:#f4f4f4;
}

.container{
    width:400px;
    margin:50px auto;
    padding:20px;
    background:white;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

input, select{
    width:100%;
    padding:8px;
    margin-top:5px;
    margin-bottom:15px;
}

input[type=submit]{
    background:#4CAF50;
    color:white;
    border:none;
    cursor:pointer;
}

input[type=submit]:hover{
    background:#45a049;
}

.errors{
    color:red;
}

.result{
    margin-top:15px;
    font-weight:bold;
}
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Kredytowy</title>
</head>
<body>
    <div class="container">
    <form action="calc.php" method="get">
        <label for="id_k">Kwota kredytu: </label>
        <input id="id_k" name="k" type="text" value="<?php if(isset($kwota)) print($kwota); ?>"><br>
        <label for="id_op">Oprocentowanie roczne: </label>
        <select id="id_op" name="op">
            <option value="0.02">2%</option>
            <option value="0.04">4%</option>
            <option value="0.05">5%</option>
            <option value="0.07">7%</option>
        </select><br>
        <label for="id_l">Okres spłaty (lata): </label>
        <input id="id_l" name="l" type="text" value="<?php if(isset($lata)) print($lata); ?>"><br>
        <input type="submit" value="Oblicz">
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
        echo "Kwota całkowita: ".number_format($kwotaCalkowita,2)."<br>";
        echo "Rata miesięczna: ".number_format($rata,2);
        echo "</div>";
    }
    ?>
    </div>
</body>
</html>