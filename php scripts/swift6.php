<?php
	$username = $_POST["username"];
        require 'database.php';
        ob_start();
        $pdo = Database::connect();
        ob_end_clean();
	$sql0 = "SELECT date, lift, ROUND(CASE WHEN unit = 1 THEN weight / 2.2 ELSE weight END, 1) as weight, sets, reps, id FROM workout WHERE user = '$username' ORDER BY id DESC";
	$sql1 = "SELECT date, lift, ROUND(CASE WHEN unit = 0 THEN weight * 2.2 ELSE weight END, 1) as weight, sets, reps, id FROM workout WHERE user = '$username' ORDER BY id DESC";
	//$row0 = $pdo->query($sql0)->fetchAll(PDO::FETCH_ASSOC);

	$unit_check = "SELECT unit FROM users where username = '$username'";
        foreach ($pdo->query($unit_check) as $row) {
                if ($row['unit'] == 1) {
                        $result = $pdo->query($sql1)->fetchAll(PDO::FETCH_ASSOC);
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                }
                if ($row['unit'] == 0) {
                        $result = $pdo->query($sql0)->fetchAll(PDO::FETCH_ASSOC);
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                }
        }

        //$row = $pdo->query($sql0)->fetchAll(PDO::FETCH_ASSOC);
        //echo json_encode($row, JSON_UNESCAPED_SLASHES);


?>

