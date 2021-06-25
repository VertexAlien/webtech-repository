<!DOCTYPE html>
<html>
<head>
	<style>
		.error
		{
			color: RED;
		}
	</style>
</head>
<body>

<?php
$currentPassword = "abc@1234";
$name =  $password = $cpassword = $npassword = $repassword ="";
$nameE=  $passwordE = $npasswordE = $cpasswordE = $repasswordE ="";

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

	if(empty($_POST["cpassword"])){
		$cpasswordE = "* Password Field is Empty";
	}else{
		$cpassword = test_input($_POST["cpassword"]);
		if($cpassword != $currentPassword){
			$cpasswordE = "* Password didn't match with old password";
		}
	}

	if(empty($_POST["npassword"])){
		$npasswordE = "* Password Field is Empty";
	}else{
		$npassword = test_input($_POST["npassword"]);
		if($npassword == $currentPassword){
			$npasswordE = "* Password is same as old password";
		}
	}

	if(empty($_POST["repassword"])){
		$repasswordE = "* Password Field is Empty";
	}else{
		$repassword = test_input($_POST["repassword"]);
		if($repassword != $npassword){
			$repasswordE = "* Password didn't match with new password";
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

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"style="padding-top: 10px">

<fieldset style="width: 300px; ">
<legend><b>LOGIN</b></legend>
<label for="username">User Name :</label>
<input type="text" name="name" value="<?php echo $name;?>" ><span class="error">* <?php echo $nameE;?> </span><br><br>
<label for="password">Password &ensp;:</label>
<input type="text" name="password" value="<?php echo $password;?>" ><span class="error">* <?php echo $passwordE;?> </span><br>
<hr style="border: 0.1px solid;">
<input type="checkbox" id="rememberme" name="rememberme" value="rememberme">
<label for="rememberme">Remember Me</label><br><br>
<input type="submit" name="submit" value="submit" style="width: 100px">
</fieldset>
<br>

<fieldset style="width: 400px; ">
<legend><b>Change Password</b></legend>
<table>
<tr>
	<td style="text-align: right"><label for="cpassword">Current Password &ensp;:</label></td>
	<td><input type="text" name="cpassword" value="<?php echo $cpassword;?>" ><span class="error">*</span><br></td>
</tr>
<tr>
	<td colspan="2"><span class="error"> <?php echo $cpasswordE;?> </span></td>	
</tr>
<tr>
	<td style="text-align: right"><label for="npassword">New Password &ensp;:</label></td>
	<td><input type="text" name="npassword" value="<?php echo $npassword;?>" ><span class="error">*</span><br></td>
</tr>
<tr>
	<td colspan="2"><span class="error"> <?php echo $npasswordE;?> </span></td>	
</tr>
<tr>
	<td style="text-align: right"><label for="repassword">Re-Type Password &ensp;:</label></td>
	<td><input type="text" name="repassword" value="<?php echo $repassword;?>" ><span class="error">* </span><br></td>
</tr>
<tr>
	<td colspan="2"><span class="error"> <?php echo $repasswordE;?> </span></td>	
</tr>
</table>

<hr style="border: 0.1px solid;">
<input type="submit" name="submit" value="submit" style="width: 100px">
</fieldset>
<br>


</form>
</body>
</html>