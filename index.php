<?php 
session_start();

	include("connection.php");
	include("functions.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Jegyfoglalás</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

	<a href="logout.php" class="signup_text">Kijelentkezés</a>
	<section class="search">
	<form action="" method="post">
    <input type="text" name="search">
    <input type="submit" name="submit" value="Keresés">
	<a href="reserv.php" class="signup_text">Jegyfoglalás</a>
    </form>
    </section>
<?php


if (isset($_POST['submit'])) {
    $searchValue = $_POST['search'];
    $con = new mysqli("localhost", "root", "", "teszt");
    if ($con->connect_error) {
        echo "connection Failed: " . $con->connect_error;
    } else {
        $sql = "SELECT * FROM play WHERE play_title LIKE '%$searchValue%'";

        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo'<ul class="articles">';
            echo'<li class="preview">
            <div><h2>';
            echo $row['play_title'] . "</h2>";
            echo'<p>Előadás időtartama: ';
            echo $row['play_length'] . "perc </p>";
            echo'<p>Műfaj: ';
            echo $row['play_genre'] . "</p>";
            echo'<p>';
            echo $row['play_description'] . "</p>";
            echo' </div>
            
        </li>
            </ul>';
                

        }

    exit();
    }   
}
?>
<?php
    

echo'<ul class="articles">';

$sql = "SELECT * FROM play";
$result = mysqli_query($con, $sql);
                
$read = 1;
                        
foreach($result as $record)
{
    $play_title = $record['play_title'];
    $play_length = $record['play_length'];
    $play_act = $record['play_act'];
    $play_genre = $record['play_genre'];
    $play_description = $record['play_description'];
    
    
    echo'	<li class="preview">

            <div>
                <h2>'. $play_title .'</h2>
                <p>Előadás időtartama: '. $play_length .' perc</p>
                <p>Felvonás: '. $play_act .'</p>
                <p>Műfaj: '. $play_genre .'</p>
                <p>'. $play_description .'</p>
            </div>

        </li>';
    
    $read++;
}
echo'</ul>';

?>
</body>
</html>