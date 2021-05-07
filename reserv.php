<?php
session_start();
include("connection.php");
?>
<html>
<head>
	<title>Jegyfoglalás</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div id="box">
       <div class="inside">
       <section>
        <h2>Töltse ki az adatait a jegyfoglaláshoz</h2>
        
		<form method="post">
			
<?php    
			$sql = "SELECT play_title FROM play";
			$result = mysqli_query($con, $sql);
			echo"<a>Előadás</a><br>";
			echo "<select name='play_title' style='width: 300px'>";
			while ($row = mysqli_fetch_array($result)) {
				echo "<option value='" . $row['play_title'] ."'>" . $row['play_title'] ."</option>";
			}
			echo "</select><br><br>";
			
			echo"<a>Oldal</a><br>";
			echo "<select name='seat_side' style='width: 300px'>";
			echo "<option value='J'>J</option>";
			echo "<option value='B'>B</option>";
			echo "</select><br><br>";
			
			echo"<a>Sor száma</a><br>";	
			echo "<select name='seat_row' style='width: 300px'>";
			for($i=1; $i<16; $i++) {
				echo "<option value='".$i."'>".$i."</option>";
			}
			echo "</select><br><br>";
			
			echo"<a>Szék száma</a><br>";
			echo "<select name='seat_num' style='width: 300px'>";
			for($j=1; $j<31; $j++) {
				echo "<option value='".$j."'>" .$j."</option>";
			}
			echo "</select><br><br>";

?>
<?php
if(isset($_SESSION['user_id'])){
	$uid = $_SESSION['user_id'];
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//something was posted
		$play_title = $_POST['play_title'];
		$seat_side = $_POST['seat_side'];
		$seat_row = $_POST['seat_row'];
		$seat_num = $_POST['seat_num'];
		
		$sql = "SELECT seat_side, seat_row, seat_num FROM reservation WHERE seat_side = '$seat_side' AND seat_row = '$seat_row' AND seat_num = '$seat_num'";
		$result = mysqli_query($con, $sql);
		
		$_SESSION['rs'] = $play_title;

		if($result && mysqli_num_rows($result) > 0)
		{
			echo "A hely foglalt!";
			
		}else
		{
			$query = "insert into reservation (res_user_id, res_play_title, seat_side, seat_row, seat_num) values ($uid, '$play_title','$seat_side','$seat_row','$seat_num')";

			mysqli_query($con, $query);

			header("Location: done.php");
			die;
		}
	}
}
else{
	echo "Kérem jelentkezzen be!";
	echo"<a href='login.php' class='signup_text'>Belépés</a><br><br>";
	session_destroy();
}
?>

			<input id="button" type="submit" value="Foglalás">
		</form>
		</section>
	</div>
	</div>
</body>
</html>