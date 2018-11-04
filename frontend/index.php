<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<?php
include '../database/connect.php';

$getDrinks = "SELECT id, name, minPrice, maxPrice, currentPrice, soldUnits, salesTime FROM drink";
$drinkList = $conn->query($getDrinks);

if ($drinkList->num_rows > 0) {
    // output data of each row
    while ($drink = $drinkList->fetch_assoc()) {
        echo "<hr>";

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

        if ($currentPrice <= $minPrice ) {
            if ($currentPrice >= $minPrice) {
                echo "bärse krash";

            } else {
                $currentPrice = $minPrice;

                echo "bärse krash";

            }
        } else {
            if ($currentPrice > $maxPrice) {
                $currentPrice = $maxPrice;
            }
            $updateCurrentPrice = "UPDATE drink SET currentPrice='$currentPrice' WHERE id='$id'";
            $conn->query($updateCurrentPrice);
            $name = $drink["name"];
            echo "Preis für <h1>$name</h1> ist momentan:";
            echo $currentPrice;

        }

    }
}
/*
        if ($drink["soldUnits"] > $average) {
            $newPrice = $drink["currentPrice"] + 0.50;
            if ($newPrice >= $drink["maxPrice"]) {
                $newPrice = $drink["maxPrice"];
            }
        } elseif ($drink["soldUnits"] < $average) {
            $newPrice = $drink["currentPrice"] - 0.50;
            if ($newPrice < $drink["minPrice"]) {
                $newPrice = $drink["minPrice"];
            }
        } elseif ($drink["soldUnits"] = $average) {
            $newPrice = ($drink["maxPrice"] + $drink["minPrice"]) / 2;
        } else {
            $newPrice = $drink["currentPrice"];
        }
        switch (rand(1, 1000)) {
            case 1:
                $newPrice = $drink["minPrice"];
                echo "<br><br><div class='alert alert-danger' role='alert'>Achtung Börsencrash! Preis für " . $drink["name"] . " ist <b>" . $newPrice . " Fr. </b><br></div>";
                break;
            default:
                echo "<br>Preis für " . $drink["drinkname"] . ": " . $newPrice . " Fr. <br>";
                break;
        }
        if ($newPrice == $drink["minPrice"]) {
            echo "<br><br><div class='alert alert-danger' role='alert'>Achtung Börsencrash! Preis für " . $drink["name"] . " ist <b>" . $newPrice . " Fr. </b><br></div>";
        }
        $id = $drink["id"];
        $sql3 = "UPDATE drink SET currentPrice='$newPrice' WHERE id=$id";
        if ($conn->query($sql3) === TRUE) {
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "0 results";
}
*/
header("refresh: 60;");
?>