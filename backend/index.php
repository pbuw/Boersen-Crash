<h1>Add Drink</h1>
<form action="index.php" method="get">
	<input type="submit" value="Vodka" name="drinkname">
	<input type="submit" value="Bier" name="drinkname">
	<input type="submit" value="Cola" name="drinkname">
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
$sql = "SELECT soldUnits FROM drink WHERE drinkname='$drinkname'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $soldUnits = $row["soldUnits"];
}
$soldUnits = $soldUnits + 1;
$sql2 = "UPDATE drink SET soldUnits='$soldUnits' WHERE drinkname='$drinkname'";
if ($conn->query($sql2) === TRUE) {
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
date_default_timezone_set("Europe/Zurich");
$time = date("h:i:s");
$time = $time - 1:0:0-;
echo $time;
?>

