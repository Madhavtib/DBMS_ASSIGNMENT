<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
    $cpassword = stripslashes($_REQUEST['cpassword']);
    $cpassword = mysqli_real_escape_string($con,$cpassword);
    $errors=array();
  if($password!=$cpassword){
    array_push($errors, "Password Does Not Match");
    echo "<div class='form'>
<h3>Passwords Does Not Match.</h3>
<br/>Click here to <a href='registration.php'>Retry</a></div>";
                           }
    $user_check_query="SELECT * FROM user WHERE username='$username' or email='$email' LIMIT 1";
    $results=mysqli_query($con,$user_check_query);
    $user=mysqli_fetch_assoc($results);

    if($user)
    {
     if($user['username']===$username && $username!="")
      {
       array_push($errors, "Username Already Exists");
       echo "<div class='form'>
       <h3>Username Already Exists.</h3>
       <br/>Click here to <a href='registration.php'>Retry</a></div>";
       }
     else if($user['email']===$email && $email!="")
     {
      array_push($errors, "Email Already Exists");
      echo "<div class='form'>
      <h3> Email Already Exists.</h3>
      <br/>Click here to <a href='registration.php'>Retry</a></div>";
     }
    }

    if(count($errors)==0){
        $query = "INSERT into user (username,email,password)
                  VALUES ('$username', '$email','".md5($password)."')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
            <h3>You are registered successfully.</h3>
            <br/>Click here to <a href='login.php'>Login</a></div>";
                   }
                         }
    
}
            else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="password" name="cpassword" placeholder="Confirm Password" required />
<input type="submit" name="submit" value="Register" />
</form>
</div>
<?php } ?>
</body>
</html>
