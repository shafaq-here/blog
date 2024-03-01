<?php
require 'config/constants.php';

//the form data that we have received fromt the post super global, lets get all the values

$firstname = $_SESSION['signup-data']['firstname']  ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

//unset the values right after that
unset($_SESSION['signup-data']) ;


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog Website</title>
        <!-- Main css file -->
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>css/style.css">
        <!-- ICONSCOUT CDN -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <!-- Google Fonts (Monteserrat) -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    </head>
</head>

<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign Up</h2>
            <!-- We would want to display some alert messages, error or success so we create a separate div for that -->
            <?php  
             if(isset($_SESSION['signup-error'])) {
                ?>
                <div class="alert__message error">
                    <p>
                        <?php 
                        echo $_SESSION['signup-error'] ;
                        unset($_SESSION['signup-error'])
                        ?>
                    </p>
            </div>

            

            <?php
             }
            ?>


            <form action="<?php echo ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
                <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
                <div class="form__control">
                    <label for="avatar">User Avatar</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Sign Up</button>
                <small>Already have an account? <a href="<?php echo ROOT_URL ?>signin.php">Sign In</a></small>

            </form>
        </div>
    </section>
</body>

</html>