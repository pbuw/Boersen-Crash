<h1>Add Drink</h1>
<form action="addDrink.php" method="get">
    name: <input type="text" name="drinkname"><br>
    minPrice: <input type="text" name="minPrice"><br>
    maxPrice: <input type="text" name="maxPrice"><br>
    currentPrice: <input type="text" name="currentPrice"><br>
    soldUnits: <input type="text" name="soldUnits"><br>
    <input type="submit">
</form>
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
$drinkname = $_GET["drinkname"];
$maxPrice = $_GET["maxPrice"];
$minPrice = $_GET["minPrice"];
$currentPrice = $_GET["currentPrice"];
$soldUnits = $_GET["soldUnits"];

$sql = "INSERT INTO drink(drinkname, minPrice, maxPrice, currentPrice, soldUnits)
VALUES ('$drinkname', '$minPrice', '$maxPrice', '$currentPrice', '$soldUnits')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

