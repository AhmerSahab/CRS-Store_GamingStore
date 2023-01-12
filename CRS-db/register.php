
<?php
if(isset($_POST['save']))
{
    extract($_POST);
    include("php/conn.php");
    $username = $_POST["username"]; 
    // echo $username;
$sql=mysqli_query($conn,"SELECT * FROM login_table where email='$email'");
if(mysqli_num_rows($sql)>0):
    echo "Email Id Already Exists"; 
	exit;

elseif($pass != $cpass):
    echo 'confirm Passwords does not match !';

else:
    isset($_POST['save']);
    $query123 = mysqli_query($conn, "INSERT INTO `login_table` (`id`, `username`, `email`, `mobile`, `password`) VALUES (NULL, '$username',  '$email',  '$mobile', '$pass')") ;
    echo $username;
    header("Location: login.php?status=success");
endif;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>CRS Store SignUp</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="button.css"/>

<style>
    h2, p{
        text-align: center;
    }
    body{
        padding: 10rem 28rem;
    }
</style>

</head>

<body>
<div class="signup-form">
    <form action="register.php" method="post" enctype="multipart/form-data">
		<h2>Register</h2>
		<p class="hint-text">Create your account to visit CRS Store</p>
        <div class="form-group">
			<input type="text" minlength="6" maxlength="20"  class="form-control" title="username must contain (upper & lower case) letters & digits only" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,14}$" name="username" placeholder="Username" required="required">
        </div>   	
        </div>
        <div class="form-group">
        	<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" name="email" placeholder="Email" required="required">
        </div>
        <div class="form-group">
        	<input type="number" class="form-control" name="mobile"  minlength="10" maxlength="15"   placeholder="Mobile No." required="required">
        </div>
		<div class="form-group">
            <input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$" class="form-control"  title="Must contain at least one number and one uppercase and lowercase letter, and 8-15 characters" name="pass" placeholder="Password" required="required">
        </div>
		<div class="form-group">
            <input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8-15 characters" class="form-control" name="cpass" placeholder="Confirm Password" required="required">
        </div>      
       
		<div class="form-group">
            <button type="submit" name="save" class=" btn-block">Register Now</button>
        </div>
        <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
    </form>
	
</div>
</body>
</html>