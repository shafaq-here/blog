<?php
require 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">

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

<body>
    <nav>
        <div class="container nav__container">
            <!-- First there is a logo on the left  -->
            <a href="<?php echo ROOT_URL ?>" class="nav__logo">WebsiteLogo</a>

            <!-- Then in the nav bar we have some items, that are links to differnt pages -->
            <ul class="nav__items">
                <li><a href="<?php echo ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?php echo ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?php echo ROOT_URL ?>services.php">Services</a></li>
                <li><a href="<?php echo ROOT_URL ?>contact.php">Contact</a></li>
               <!-- the one below will only be visible when the user is logged in -->
               <?php if (isset($_SESSION['user-id'])) : ?>
                    <li class="nav__profile">
                        <div class="avatar">
                            <img src="./images/avatar1.jpg" alt="">
                        </div>
                        <ul>
                            <li><a href="<?php echo ROOT_URL ?>admin/index.php">Dashboard</a></li>
                            <li><a href="<?php echo ROOT_URL ?>logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li><a href="<?php echo ROOT_URL ?>signin.php">Signin</a></li>
                <?php endif ?>

            </ul>

            <!-- For mobile and tablet devices there is going to be a hamburger button and a close button -->
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>

    <!-- The nav bar ends here -->