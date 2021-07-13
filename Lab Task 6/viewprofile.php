<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
                        <li><a href="">View Profile</a></li>
                        <li><a href="editprofile.php">Edit Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </td>
				<td height = "200" id = "lline" >
                <fieldset style="width: 300px; " class = "field">
                        <legend><b>Profile</b></legend>
                        <label for="name">Name : <?php echo htmlspecialchars($_SESSION["username"]); ?></label>
                        <hr style="border: 1px solid black;">
                        <label for="email">Email : <?php echo htmlspecialchars($_SESSION["email"]); ?></label>
                        <hr style="border: 1px solid black;">
                        <label for="gender">Gender : <?php echo htmlspecialchars($_SESSION["gender"]); ?></label>
                        <hr style="border: 1px solid black;">
                        <br><a href="editprofile.php">Edit Profile</a>
                        </fieldset>
                        
                </td>
			</tr>

			<tr>
				<td colspan = "2" style="text-align: center" height = "50"><label for="copyright">Copyright @ 2017</label></td>
			</tr>
		</table>
</body>
</html>