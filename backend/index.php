<h1>Sold Drink</h1>
<form action="index.php" method="get">
    <?php
    include '../database/connect.php';
    $getAverage = "SELECT name FROM drink";
    $averageList = $conn->query($getAverage);
    while ($item = $averageList->fetch_assoc()) {
        $drinkName = $item["name"];
        echo "<input type='submit' value='$drinkName' name='name'>";
    }
    ?>
</form>
<?php
include '../database/connect.php';

$name = $_GET["name"];
$sql = "SELECT soldUnits FROM drink WHERE name='$name'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $soldUnits = $row["soldUnits"];
}
$soldUnits = $soldUnits + 1;
$sql2 = "UPDATE drink SET salesTime='0' WHERE name='$name'";
if ($conn->query($sql2) === TRUE) {
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
date_default_timezone_set("Europe/Zurich");
?>
