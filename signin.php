<?php  
require 'config/constants.php' ;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog Website</title>
        <!-- Main css file -->
        <link rel="stylesheet" href="css/style.css">
        <!-- ICONSCOUT CDN -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <!-- Google Fonts (Monteserrat) -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    </head>
</head>

<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign In</h2>
            <!-- We would want to display some alert messages, error or success so we create a separate div for that -->
            <?php  
             if(isset($_SESSION['signup-success'])) {
                ?>
                <div class="alert__message success">
                    <p>
                        <?php 
                        echo $_SESSION['signup-success'] ;
                        unset($_SESSION['signup-success'])
                        ?>
                    </p>
            </div>

            

            <?php
             }
            ?>
            <form action="<?php echo ROOT_URL ?>signin-logic.php" enctype="multipart/form-data">
                <input type="text" name="username_email" placeholder="Username or Email">
                <input type="password" name="password" placeholder="Password">


                <button type="submit" name="submit" class="btn">Sign In</button>
                <small>Don't have an account? <a href="<?= ROOT_URL ?>signup.php">Sign Up</a></small>

            </form>
        </div>
    </section>
</body>

</html>