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

</body>