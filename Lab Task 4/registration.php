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

$name = $email = $dd= $mm=$yyyy=$gender= $password = $cpassword ="";
$nameE= $emailE = $dobE=$genderE = $passwordE = $cpasswordE ="";

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

	if(empty($_POST["email"])) {
    	$emailE = "Email is required";
  	} 
  	else 
  	{
	    $email = test_input($_POST["email"]);
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    $emailE = "Invalid email format. Format: example@something.com";}
  	}

  	if(empty($_POST["dd"]) or empty($_POST["mm"]) or empty($_POST["yyyy"])){
		$dobE="Full Date of birth input is requied";
		$dd = test_input($_POST["dd"]);
		$mm = test_input($_POST["mm"]);
		$yyyy = test_input($_POST["yyyy"]);

	}
	else
	{
		$dd = test_input($_POST["dd"]);
		$mm = test_input($_POST["mm"]);
		$yyyy = test_input($_POST["yyyy"]);

		if( !filter_var($dd,FILTER_VALIDATE_INT,array('options' => array(
            'min_range' => 1, 
            'max_range' => 31
        )))|!filter_var($mm,FILTER_VALIDATE_INT,array('options' => array(
            'min_range' => 1, 
            'max_range' => 12
        )))|!filter_var($yyyy,FILTER_VALIDATE_INT,array('options' => array(
            'min_range' => 1953, 
            'max_range' => 1998
        ))))
			{$dobE="Must be valid numbers(dd:1-31,mm: 1-12,yyyy: 1953-1998)";}
	}

	if(!isset($_POST["gender"]))
	{
		$genderE="At least one of them must be selected";
	}

    if(empty($_POST["password"])){
		$passwordE = " Password Field is Empty";
	}

	if(empty($_POST["cpassword"])){
		$cpasswordE = "Confirm Password Field is Empty";
	}else{
		$cpassword = test_input($_POST["cpassword"]);
		if($cpassword != $password){
			$cpasswordE = " Password didn't match with typed password";
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
				<td style="text-align: right" class = "nobtd"><a href="index.php">Home |</a><a href="login.php">LogIn |</a><a href="">Registration</a></td>
			</tr>

			<tr>
				<td colspan = "2" height = "200" id = "lline">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"style="padding-top: 10px">
                    <fieldset style="width: 400px; " class = "field">
                        <legend><b>Registration</b></legend>
                        <label for="name">Name :</label>
                        <input type="text" name="name" value="<?php echo $name;?>" ><span class="error">*<br> <?php echo $nameE;?> </span><br>
                        <label for="email">Email :</label>
                        <input type="text" name="email" value="<?php echo $email;?>"><span class="error">* <br><?php echo $emailE;?></span><br>
                        <label for="dateofbirth">Date Of Birth :</label>
                        <table>
                        <tr style="text-align: center;">
                            <th style="font-weight: normal;"><label for="dd" >dd</label></th>
                            <th></th>
                            <th style="font-weight: normal;"><label for="mm" >mm</label></th>
                            <th></th>
                            <th style="font-weight: normal;"><label for="yyyy" >yyyy</label></th>
                            <th></th>
                        </tr>
                        <tr>
                        <td><input type="text" name="dd" style="width: 30px" value="<?php echo $dd;?>"></td>
                        <td>/</td>
                        <td><input type="text" name="mm" style="width: 30px" value="<?php echo $mm;?>"></td>
                        <td>/</td>
                        <td><input type="text" name="yyyy" style="width: 30px;" value="<?php echo $yyyy;?>"></td>
                        <td style="padding-left: 10px"><span class="error">* <?php echo $dobE;?></span></td>
                        </tr>
                        </table>
                        

                        <br><label for="gender">Gender :</label><br>
                        <input  type="radio" name="gender"<?php if(isset($gender) && $gender=="female") echo "checked";?> value="female">Female

                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male	

                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other 
                                
                        	
                        <span class="error" >* <?php echo $genderE;?></span	>

                        <br><br><label for="password">Password &ensp;:</label>
                        <input type="text" name="password" value="<?php echo $password;?>" ><span class="error">* <br> <?php echo $passwordE;?> </span><br>

                        <label for="cpassword">Confirm Password &ensp;:</label>
                        <input type="text" name="cpassword" value="<?php echo $cpassword;?>" ><span class="error">* <br><?php echo $cpasswordE;?> </span><br>

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