<!DOCTYPE html>
<html>
<head>
	<title>Összegzés</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<a href="logout.php" class="signup_text">Kijelentkezés</a>
<?php

session_start();
include("connection.php");

$sqle = "SELECT * FROM reservation ORDER BY res_id DESC LIMIT 1";
$result = mysqli_query($con, $sqle);
$lol = strval($_SESSION['rs']);
$uid= $_SESSION['user_id'];
$sqlee = "SELECT * FROM `play` WHERE play_title = '$lol'";
$resultt = mysqli_query($con, $sqlee);
$sqleee = "SELECT * FROM `users` WHERE user_id = '$uid'";
$resulttt = mysqli_query($con, $sqleee);

if($result){
    $row = mysqli_fetch_array($result);
	echo'<ul class="articles">';
    echo'	<li class="preview">
            <div>
				<h2>Ezt a bizonylatot mutassa be a pénztárnál!</h2>
				<h2>Előadás címe: '. $row['res_play_title'] .'</h2>
                <p>Felhasznaló azonosító: '. $row['res_user_id'] .'</p>
                <p>Oldal : '. $row['seat_side'] .'</p>
                <p>Sor: '. $row['seat_row'] .'</p>
                <p>Szék száma: '. $row['seat_num'] .'</p>
            </div>
        </li>';
	echo'</ul>';
	
	$roww = mysqli_fetch_array($resultt);
	echo'<ul class="articles">';
    echo'	<li class="preview">
            <div>
                <h2>Előadás időtartama: '. $roww['play_length'] .' perc</h2>
                <p>Felvonás: '. $roww['play_act'] .'</p>
                <p>Műfaj: '. $roww['play_genre'] .'</p>
                <p>Leírás: '. $roww['play_description'] .'</p>
            </div>
        </li>';
	echo'</ul>';
	
	$rowww = mysqli_fetch_array($resulttt);
	echo'<ul class="articles">';
    echo'	<li class="preview">
            <div>
				<h2>Név: '. $rowww['name'] .'</h2>
                <p>Felhasznaló név: '. $rowww['user_name'] .'</p>
                <p>E-mail: '. $rowww['email'] .'</p>
            </div>
        </li>';
	echo'</ul>';
    
}
else{
	echo "Something went wrong!";
}
?>
</body>
</html>