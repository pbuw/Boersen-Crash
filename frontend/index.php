<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <meta charset="UTF-8">
</head>
<body>
<?php
include '../database/database.php';
include 'alert.php';
$connection = database::getConnection();
$drinkList = database::getDrinks($connection);

if ($drinkList->num_rows > 0) {
    while ($drink = $drinkList->fetch_assoc()) {
        $part = ($drink["maxPrice"] - $drink["minPrice"]) / 3;
        if ($drink["currentPrice"] < $drink["minPrice"] + $part) {
            if (rand(1, 3) == 3) {
                if ($drink["minPrice"] > $drink["currentPrice"] - 0.5) {
                    $price = $drink["currentPrice"];
                } else {
                    $price = $drink["currentPrice"] - 0.5;
                }
            } else {
                $price = $drink["currentPrice"] + 0.5;
            }
        }
        if ($drink["currentPrice"] > $drink["minPrice"] + $part && $drink["currentPrice"] < $drink["maxPrice"] - $part) {
            if (rand(1, 2) == 2) {
                if ($drink["minPrice"] > $drink["currentPrice"] - 0.5) {
                    $price = $drink["currentPrice"];
                } else {
                    $price = $drink["currentPrice"] - 0.5;
                }
            } else {
                $price = $drink["currentPrice"] + 0.5;
            }
        }
        if ($drink["currentPrice"] > $drink["maxPrice"] - $part) {
            if (rand(1, 3) == 3) {
                if ($drink["maxPrice"] < $drink["currentPrice"] + 0.5) {
                    $price = $drink["currentPrice"];
                } else {
                    $price = $drink["currentPrice"] + 0.5;
                }
            } else {
                $price = $drink["currentPrice"] - 0.5;
            }
        }
        database::updateDrinkPrice($drink["id"], $price, $connection);

        echo $drink["name"];
        echo "<br>";
        echo $drink["currentPrice"];
        echo "<hr>";

        //alert::normal($name, $currentPrice);
        $drinkCurrentPrice = $drink["currentPrice"];
        //alert::normal($name, $drinkCurrentPrice);
    }
} else {
    alert::error("No drinks registered");
}
header("refresh: 60;");
?>
</body>
