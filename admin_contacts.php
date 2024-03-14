<?php

include 'connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

// for delete message

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messages</title>

     <!-- Font Awesome CDN Link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- Custom Admin CSS File Link -->
     <link rel="stylesheet" href="admin_style.css">
</head>
<body>

<?php

include 'admin_header.php';
    
?>

<section class="messages">
    <h1 class="title">  messages</h1>
    <div class="box-container">
    <?php
        $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
        if(mysqli_num_rows($select_message) > 0){
            while($fetch_message = mysqli_fetch_assoc($select_message)){ 
         
    ?>
    <div class="box">
        <p>name: <span><?php echo $fetch_message['name']; ?></span></p>
        <p>number: <span><?php echo $fetch_message['number']; ?></span></p>
        <p>email: <span><?php echo $fetch_message['email']; ?></span></p>
        <p>message: <span><?php echo $fetch_message['message']; ?></span></p>
        <a href="admin_contacts.php?delete=<?php echo $fetch_message['id'] ; ?>" onclick="return confirm('delete this message!');" class="delete-btn">delete message</a>
    </div>
    <?php
        };
    }else{
        echo '<p class="empty">you have no messages!</p>';
    }
    ?>
    </div>
</section>




<!-- custom Admin jS file link -->
<script src="admin_script.js"></script>

</body>
</html>