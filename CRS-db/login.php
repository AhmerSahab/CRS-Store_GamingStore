
<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include("php/conn.php");
    // include 'conn.php';
    if($email=='admin@gmail.com' && $pass=='admin'){
        $_SESSION['admin'] = true;
        header("Location: adminPanel.php");
    }else{
    $sql=mysqli_query($conn,"SELECT * FROM login_table where email='$email' and password='$pass'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["ID"] = $row['id'];
        $_SESSION["Email"] = $row['email'];
        $username = $row['username'];
        $_SESSION["Username"] = $row['username'];
        $sql2="INSERT INTO login_stamp (`username`, `email`) VALUES ('$username', '$email')";
        if (mysqli_query($conn, $sql2)) {
            echo "";
            header("Location: index.php");
            } else {
              echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
            }
        // $_SESSION["Mobile"] = $row['mobile'];
    }else{
        echo "Invalid Email ID/Password";
    }
}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>CRS Login Page</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="button.css"/>
<style>
    h2, p{
        text-align: center;
    }
    body{
        background-image: url(./images/crs-logo.png);
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
  backdrop-filter: blur(15px);
        padding: 10rem 31rem;
    }

    .signup-form{
        padding: 3.5rem 3rem;
        background-color: #ffffffca;
        border-radius: 2.5rem;
        /* backdrop-filter: blur(.5); */
    }
    /* :root {
  --color-primary-blue: #0fa69e;
  --color-primary-dark: #000000;
  --color-primary-dark-transparent: #0000009e;
  --color-primary-white: #ffffff;
  --color-primary-transparent: rgba(0, 0, 0, 0);

  --avg-font-size: 1rem;
}

button {
  padding: 0.4rem 1rem;
  border: none;
  font-size: var(--avg-font-size);
  outline: none;
  transition: all 0.5s ease;
  cursor: pointer;
  color: var(--color-primary-blue);
  background-color: var(--color-primary-transparent);
  border: 2px solid var(--color-primary-blue);
}
button:hover {
  color: var(--color-primary-white);
  background-color: var(--color-primary-blue);
} */

</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
<div class="signup-form">
    <form action="login.php" method="post" enctype="multipart/form-data">
		<h2>Login</h2>
		<p class="hint-text">Enter Login Details to visit CRS Store</p>
        <div class="form-group">
        	<input type="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  class="form-control" name="email" placeholder="abc@xyz.com" required="required">
        </div>
		<div class="form-group">
        <!-- pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"   -->
            <input type="password" class="form-control" name="pass" placeholder="Password" required="required">
        </div>
		<div class="form-group">
        <!-- btn btn-success btn-lg btn-block -->
            <button type="submit" name="save" class=" btn-block">Login</button>
        </div>
        <div class="text-center">Don't have an account? <a href="register.php">Register Here</a></div>
    </form>
</div>
</body>
</html>