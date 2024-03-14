<?php

include 'connect.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}
if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart!';
    }else{
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="home">
    <div class="content">
        <h3>hand picked book to your door.</h3>
        <p>Instagram These captions often use a conversational tone, use emojis, and convey a sense of being in the moment.</p>
        <a href="about.php" class="white-btn">discover more</a>
    </div>
</section>

<section class="products">
    <h1 class="title">latest products</h1>
    <div class="box-container">
        <?php
           $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
           if(mysqli_num_rows($select_products) > 0){
              while($fetch_products = mysqli_fetch_assoc($select_products)){  
        ?>
        <form action="" method="post" class="box">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_products['name']; ?></div>
            <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
            <input type="number" min="1" name="product_quantity" value="1" class="qty">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
        </form>
        <?php
           }
        }else{
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>
        
    </div>


</section>

<section class="about">
    <div class="flex">
        <div class="image">
            <img src="images/about-img.jpg" alt="">
        </div>
        <div class="content">
            <h3>about us</h3>
            <p>Communicate the story of your business and why you started it. Describe the customers or the cause that your business serves. </p>
            <a href="about.php" class="btn">read more</a>
        </div>
    </div>
</section>

<section class="home-contact">
    <div class="content">
        <h3>have any questions?</h3>
        <p>Call me if you have any questions. (questions is plural) Call me if you have any information.</p>
        <a href="contact.php" class="white-btn">contact us</a>
    </div>
</section>






<?php include 'footer.php'; ?>


<!-- custom js file link -->
<script src="script.js"></script>
    
</body>
</html>