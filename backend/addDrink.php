<h1>Add Drink</h1>
<form action="addDrink.php" method="get">
	name: <input type="text" name="name"><br>
	minPrice: <input type="text" name="minPrice"><br>
	maxPrice: <input type="text" name="maxPrice"><br>
	currentPrice: <input type="text" name="currentPrice"><br>
	soldUnits: <input type="text" name="soldUnits"><br>
	<input type="submit">
</form>
<?php
include '../database/connect.php';

$name = $_GET["name"];
$maxPrice = $_GET["maxPrice"];
$minPrice = $_GET["minPrice"];
$currentPrice = $_GET["currentPrice"];
$soldUnits = $_GET["soldUnits"];

$sql = "INSERT INTO drink(name, minPrice, maxPrice, currentPrice, soldUnits)
VALUES ('$drinkname', '$minPrice', '$maxPrice', '$currentPrice', '$soldUnits')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

