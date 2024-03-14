<?php

include 'connect.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query faild');

    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'user already exist!';
    }else{
        if($pass != $cpass){
            $message[] = 'Confirm Password Not Matched!';
        }else{
            mysqli_query($conn, "INSERT INTO `users`(name,email,password,user_type) VALUES('$name','$email','$cpass','$user_type') ") or die('query failed');
            $message[] = 'Registered Sucessfully!';
            header('location:login.php');
        }
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom css file link -->
    <link rel="stylesheet" href="style.css">
</head>
<body>



<?php
if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>
    <div class="form-container">

        <form action="" method="post">
            <h3>Register Now</h3>
            <input type="text" name="name" placeholder="Enter Your Name" required class="box">
            <input type="email" name="email" placeholder="Enter Your email" required class="box">
            <input type="password" name="password" placeholder="Enter Your password" required class="box">
            <input type="password" name="cpassword" placeholder="Confirm Your password" required class="box">
            <select name="user_type" class="box">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <input type="submit" name="submit" value="register now" class="btn">
            <p>Already have an account? <a href="login.php">Login Now</a></p>
        </form>
    </div>
    
</body>
</html>