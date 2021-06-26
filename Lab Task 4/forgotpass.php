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

$email ="";
$emailE ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(empty($_POST["email"])) {
    	$emailE = "Email is required";
  	} 
  	else 
  	{
	    $email = test_input($_POST["email"]);
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    $emailE = "Invalid email format. Format: example@something.com";}
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
				<td style="text-align: right" class = "nobtd"><a href="index.php">Home |</a><a href="login.php">LogIn |</a><a href="registration.php">Registration</a></td>
			</tr>

			<tr>
				<td colspan = "2" height = "200" id = "lline">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"style="padding-top: 10px">
                    <fieldset style="width: 300px; " class = "field">
                        <legend><b>Forgot Password</b></legend>
                        <label for="email">Email :</label>
                        <input type="text" name="email" value="<?php echo $email;?>"><span class="error">* <br><?php echo $emailE;?></span><br>
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