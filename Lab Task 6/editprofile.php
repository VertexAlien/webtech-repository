<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";
 
$username =  htmlspecialchars($_SESSION["username"]);
$email =  htmlspecialchars($_SESSION["email"]);;
$gender =  htmlspecialchars($_SESSION["gender"]);;
$password = "";
$username_err = $password_err = $email_err = $gender_err ="";

 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } elseif(trim($_POST["username"]) !=  htmlspecialchars($_SESSION["username"])){
		$username = trim($_POST["username"]);
        $sql = "SELECT id FROM users WHERE name = '$username'";
        

		$result = mysqli_query($link,$sql);
		$count = mysqli_num_rows($result);

		if($count == 1){
			$username_err = "This username is already taken.";
		}else{
			$username = trim($_POST["username"]);
		}
    }

	if(empty($_POST["email"])) {
    	$email_err = "Email is required";
  	} 
  	else 
  	{
	    $email = trim($_POST["email"]);
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    $email_err = "Invalid email format. Format: example@something.com";
    }
  	}

	if(!isset($_POST["gender"]))
	{
		$gender_err="At least one of them must be selected";
	}else{
		$gender = trim($_POST["gender"]);
	}
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
        $tempusername = htmlspecialchars($_SESSION["username"]);

        $sql = "SELECT id FROM users WHERE name = '$tempusername' and password = '$password'";
        

		$result = mysqli_query($link,$sql);
		$count = mysqli_num_rows($result);

		if($count == 1){
            if(empty($username_err) && empty($password_err) && empty($gender_err)&& empty($email_err)){
        
                
                $sql = "UPDATE users SET name = '$username', email='$email', gender ='$gender' WHERE name = '$tempusername' and password = '$password'";
        
                if(mysqli_query($link,$sql)){

                    $_SESSION["username"] = $username;                            
                    $_SESSION["email"] = $email;
                    $_SESSION["gender"] = $gender;

                    header("location: viewprofile.php");
                }else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
            }
		}else{
			$password_err = "Invalid Password";
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
				<td style="text-align: right" class = "nobtd">Logged in as <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> | <a href="home.php">Home</a></td>
			</tr>

			<tr>
                <td width = "200px" id = "lline" valign = "top">
                    <label for="dashboard"><b>Dashboard</b></label>
                    <hr style="border: 0.1px solid;">
                    <ul>
                        <li><a href="viewprofile.php">View Profile</a></li>
                        <li><a href="">Edit Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </td>
				<td height = "200" id = "lline" >
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"style="padding-top: 10px">
                    <fieldset style="width: 400px; " class = "field">
                        <legend><b>Registration</b></legend>
                        <label for="username">User Name :</label>
                        <input type="text" name="username" value="<?php echo $username;?>" ><span class="error">*<br> <?php echo $username_err;?> </span><br>
                        <label for="email">Email &ensp;&ensp;&ensp;&ensp;:</label>
                        <input type="text" name="email" value="<?php echo $email;?>"><span class="error">* <br><?php echo $email_err;?></span><br>
                        

                        <label for="gender">Gender :</label><br>
                        <input  type="radio" name="gender"<?php if(isset($gender) && $gender=="female") echo "checked";?> value="female">Female

                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male	

                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other 
                                
                        	
                        <span class="error" >* <?php echo $gender_err;?></span	>

                        <br><br><label for="password">Password &ensp;:</label>
                        <input type="text" name="password" value="<?php echo $password;?>" ><span class="error">* <br> <?php echo $password_err;?> </span><br>

                        <hr style="border: 0.1px solid;">
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