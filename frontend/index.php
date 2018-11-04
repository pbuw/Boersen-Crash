<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "bc";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, drinkname, minPrice, maxPrice, currentPrice, soldUnits FROM drink";
$result = $conn->query($sql);
$sql2 = "SELECT AVG(soldUnits) AS average FROM drink";

try {
    $result2 = $conn->query($sql2);
    while ($row = $result2->fetch_assoc()) {
        $average = $row["average"];
        echo $average;
    }
} catch (Exception $e) {
    echo 'Exception abgefangen: ', $e->getMessage(), "\n";
};

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row["soldUnits"] > $average) {
            $newPrice = $row["currentPrice"] + 0.50;
            if ($newPrice >= $row["maxPrice"]) {
                $newPrice = $row["maxPrice"];
            }
        } elseif ($row["soldUnits"] < $average) {
            $newPrice = $row["currentPrice"] - 0.50;
            if ($newPrice < $row["minPrice"]) {
                $newPrice = $row["minPrice"];
            }
        } elseif ($row["soldUnits"] = $average) {
            $newPrice = ($row["maxPrice"] + $row["minPrice"]) / 2;
        } else {
            $newPrice = $row["currentPrice"];
        }
        switch (rand(1, 1000)) {
            case 1:
                $newPrice = $row["minPrice"];
                echo "<br><br><div class='alert alert-danger' role='alert'>Achtung Börsencrash! Preis für " . $row["drinkname"] . " ist <b>" . $newPrice . " Fr. </b><br></div>";
                break;
            default:
                echo "<br>Preis für " . $row["drinkname"] . ": " . $newPrice . " Fr. <br>";
                break;
        }
        if ($newPrice == $row["minPrice"]) {
            echo "<br><br><div class='alert alert-danger' role='alert'>Achtung Börsencrash! Preis für " . $row["drinkname"] . " ist <b>" . $newPrice . " Fr. </b><br></div>";
        }
        $id = $row["id"];
        $sql3 = "UPDATE drink SET currentPrice='$newPrice' WHERE id=$id";
        if ($conn->query($sql3) === TRUE) {
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "0 results";
}
header("refresh: 3;");

?>