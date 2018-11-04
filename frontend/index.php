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
include '../database/connect.php';

$getDrinks = "SELECT id, name, minPrice, maxPrice, currentPrice, soldUnits, salesTime FROM drink";
$drinkList = $conn->query($getDrinks);

if ($drinkList->num_rows > 0) {
    // output data of each row
    while ($drink = $drinkList->fetch_assoc()) {

        $fk_drinkId = $drink["id"];
        $id = $drink["id"];
        $getAverage = "SELECT AVG(salesTime) AS average FROM ( SELECT * FROM salesHistory WHERE fk_drinkId='$fk_drinkId' ORDER BY id DESC LIMIT 7 ) AS average";
        $averageList = $conn->query($getAverage);
        while ($item = $averageList->fetch_assoc()) {
            $average = $item["average"];
        }
        $percent = (100 / $average) * $drink["salesTime"];
        //echo "<br> percent: " . $percent . "<br>";
        $drinkCurrentPrice = $drink["currentPrice"];
        if ($percent < 50) {
            $currentPrice = $drinkCurrentPrice + 1;
        } elseif ($percent < 75) {
            $currentPrice = $drinkCurrentPrice + 0.5;
        } elseif ($percent < 125) {
            $currentPrice = $drinkCurrentPrice - 0.5;
        } elseif ($percent < 200) {
            $currentPrice = $drinkCurrentPrice - 1;
        } else {
            $currentPrice = $drinkCurrentPrice;
        }
        $addPriceHistory = " INSERT INTO priceHistory( fk_drinkId, price) VALUES ('$fk_drinkId', '$currentPrice')";
        $conn->query($addPriceHistory);
        $getSalesTime = "SELECT * FROM drink WHERE id='$fk_drinkId' ORDER BY id DESC LIMIT 1";
        $salesTimeList = $conn->query($getSalesTime);
        while ($item = $salesTimeList->fetch_assoc()) {
            $salesTime = $item["salesTime"] + 1;
        }
        $addSalesTime = "UPDATE drink SET salesTime='$salesTime' WHERE id='$id'";
        $conn->query($addSalesTime);
        $addSalesTimeHistory = " INSERT INTO salesHistory( fk_drinkId, salesTime, time) VALUES ('$fk_drinkId', '$salesTime', '0')";
        $conn->query($addSalesTimeHistory);
        $minPrice = $drink["minPrice"];
        $maxPrice = $drink["maxPrice"];

        if ($currentPrice <= $minPrice) {
            $name = $drink["name"];
            if ($currentPrice >= $minPrice) {
                echo "<div class='item alert alert-danger' role='alert'><b>Börsencrash</b><br><h1>$currentPrice Fr.</h1> $name</div>";

            } else {
                $currentPrice = $minPrice;

                echo "<div class='item alert alert-danger' role='alert'><b>Börsencrash</b><br><h1>$currentPrice Fr.</h1> $name</div>";

            }
        } else {
            if ($currentPrice > $maxPrice) {
                $currentPrice = $maxPrice;
            }
            $updateCurrentPrice = "UPDATE drink SET currentPrice='$currentPrice' WHERE id='$id'";
            $conn->query($updateCurrentPrice);
            $name = $drink["name"];
            $random = rand(0, 100);
            if ($random !== 1) {
                if ($currentPrice <= $minPrice + 2) {
                    echo "<div class='item alert alert-warning' role='alert'><b>Warning</b><br><h1>$currentPrice Fr.</h1> $name</div>";
                } elseif ($currentPrice >= $maxPrice - 3) {
                    echo "<div class='item alert alert-success' role='alert'><h1>$currentPrice Fr.</h1> $name</div>";
                } else {
                    echo "<div class='item'></h1><h1>$currentPrice Fr.</h1> $name</div>";
                }

            } else {

                echo "<div class='item alert alert-danger' role='alert'><b>Special</b><br><h1>$minPrice Fr.</h1> $name</div>";
            }

        }
        echo "<hr>";
    }
}
header("refresh: 60;");
?>
</body>
