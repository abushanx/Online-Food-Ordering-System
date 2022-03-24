<?php

session_start();

include("connectdbFood.php");

include ("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($password) && !is_numeric($username))
        {

            //read from database
            $query = "select * from tbl_admin where username = '$username' limit 1";
            $result = mysqli_query($conn, $query);

    
            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {

                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['usertype'] === "admin"){
                        header('location: admin/index.php');
                        die;
                    }
                    if($user_data['password'] === $password)
                    {
                        
                        $_SESSION['userid'] = $user_data['userid'];
                        header("location: index.php");
                        die;
                    }
                }
            }
            
            echo "wrong username or password!";
        }
        else
        {
            echo "wrong username or password!";
        }
    }





?>




<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
        <link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body style="color:black;">
		<div class="login">
			<h1>Welcom To FoodZone</h1>
			<form method="POST" >
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="password" id="password" required>
				<input type="submit" name="submit" value="Login"><br><br>
                <a href="register.php" style="font-size:15px; padding:2%;  margin:2%; text-decoration: none; font-weight:bold;">Sign up here</a>
			</form>
		</div>
	</body>
</html>
