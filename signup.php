<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name) && !empty($name) && !empty($email))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,name,email,password) values ('$user_id','$user_name','$name','$email','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Regisztráció</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div id="box">
	<div class="inside">
       <section>
        <h2>Regisztráció</h2>
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>

			<input id="text" type="text" name="user_name" placeholder="Felhasználónév"><br><br>
			
			<input id="text" type="text" name="name" placeholder="Név"><br><br>
            
            <input id="text" type="email" name="email" placeholder="E-mail cím"><br><br>
            
			<input id="text" type="password" name="password" placeholder="Jelszó"><br><br>

			<input id="button"  type="submit" value="Regisztráció">

			<a href="login.php" class="signup_text">Belépés</a><br><br>
		</form>
	</div>
</body>
</html>