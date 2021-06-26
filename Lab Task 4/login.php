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

<?php

$name =  $password ="";
$nameE=  $passwordE ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(empty($_POST["name"])){
		$nameE="Name is requied";
	}
	else
	{
		$name = test_input($_POST["name"]);
		if( preg_match("/^[0-9]/", $name))
			{$nameE="Must start with letter";}
		else if (!preg_match("/^[a-zA-Z-. ?!]{2,}$/",$name)) {
      	{$nameE = "At least two words and can only contain letters,period,dash";}
	}
    }

	if(empty($_POST["password"])){
		$passwordE = "Password is required";
	}
	else{
		$password = test_input($_POST["password"]);
		if(strlen($password) < 8){
			
				$passwordE = "Password length must be 8 character";
			
		}else if(!preg_match("/[\W]/", $password))
		{
			$passwordE = "At least one special character needed";
		}
	}

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


		<table class = "maintable">
			<tr>
				<td class = "nobtd"><h2 >Playgroud Reservation</h2></td>
				<td style="text-align: right" class = "nobtd"><a href="index.php">Home |</a><a href="">LogIn |</a><a href="registration.php">Registration</a></td>
			</tr>

			<tr>
				<td colspan = "2" height = "200" id = "lline">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"style="padding-top: 10px">
                    <fieldset style="width: 300px; " class = "field">
                        <legend><b>LOGIN</b></legend>
                        <label for="username">User Name :</label>
                        <input type="text" name="name" value="<?php echo $name;?>" ><span class="error">* <?php echo $nameE;?> </span><br><br>
                        <label for="password">Password &ensp;:</label>
                        <input type="text" name="password" value="<?php echo $password;?>" ><span class="error">* <?php echo $passwordE;?> </span><br>
                        <hr style="border: 0.1px solid;">
                        <input type="checkbox" id="rememberme" name="rememberme" value="rememberme">
                        <label for="rememberme">Remember Me</label><br><br>
                        <input type="submit" name="submit" value="submit" style="width: 100px">
                        <a href="forgotpass.php">Forgot Password ?</a>
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