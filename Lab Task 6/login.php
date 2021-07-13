<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
require_once "config.php";
 
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, name, password, email, gender FROM users WHERE name = '$username' and password = '$password'";

		$result = mysqli_query($link,$sql);
		$row=mysqli_fetch_row($result);
		$count = mysqli_num_rows($result);

		if($count == 1){
			session_start();
                            
			$_SESSION["loggedin"] = true;
			$_SESSION["id"] = $row[0];
			$_SESSION["username"] = $username;                            
			$_SESSION["email"] = $row[3];
			$_SESSION["gender"] = $row[4];
			
			header("location: home.php");
			exit;
		}else{
			$login_err = "Invalid username or password.";
		}
    }
    
    mysqli_close($link);
}
?>



<!DOCTYPE html>
<html>
<head>
	<style>
		.error
		{
			color: RED;
		}
		.maintable{
			width: 800px;
			
		}
		table,td{
  			border: 1px solid black;
  			border-collapse: collapse;
		}

		h2{
			color: green
		}

		body {
			display: table-cell;
			vertical-align: middle;
		}
		html, body {
			height: 100%;
		}

		html {
			display: table;
			margin: auto;
		}

		.nobtd{
			border: 0px solid black;
			padding: 10px;
		}

		#lline{
			padding: 10px;
            
		}

        .field{
            margin-left: auto; 
            margin-right: auto;
        }

		
	</style>
</head>
<body>

		<table class = "maintable">
			<tr>
				<td class = "nobtd"><h2 >Playgroud Reservation</h2></td>
				<td style="text-align: right" class = "nobtd"><a href="index.php">Welcome |</a><a href="">LogIn |</a><a href="registration.php">Registration</a></td>
			</tr>

			<tr>
				<td colspan = "2" height = "200" id = "lline">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"style="padding-top: 10px">
                    <fieldset style="width: 300px; " class = "field">
                        <legend><b>LOGIN</b></legend>
                        <label for="username">User Name :</label>
                        <input type="text" name="username" value="<?php echo $username;?>" ><span class="error">* <?php echo $username_err;?> </span><br><br>
                        <label for="password">Password &ensp;:</label>
                        <input type="password" name="password" value="<?php echo $password;?>" ><span class="error">* <?php echo $password_err;?> </span><br>
                        <hr style="border: 0.1px solid;">
						<span class="error">* <?php echo $login_err;?> </span><br>
                        <input type="checkbox" id="rememberme" name="rememberme" value="rememberme">
                        <label for="rememberme">Remember Me</label><br><br>
                        <input type="submit" name="submit" value="submit" style="width: 100px">
                        </fieldset>
                </form>
                        
                </td>
			</tr>

			<tr>
				<td colspan = "2" style="text-align: center" height = "50"><label for="copyright">Copyright @ 2017</label></td>
			</tr>
		</table>
</body>
</html>