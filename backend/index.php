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
<bod>
	<h1>Sold Drink</h1>
	<form action="index.php" method="get">
        <?php
        include '../database/connect.php';
        $getAverage = "SELECT name FROM drink";
        $averageList = $conn->query($getAverage);
        while ($item = $averageList->fetch_assoc()) {
            $drinkName = $item["name"];
            echo "<input type='submit' value='$drinkName' class='btn btn-secondary btn-lg btn-block' name='name'>";
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
</bod>