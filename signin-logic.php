<?php

require 'config/database.php';

//check if the user hit the sign in button
$username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);  //the filter_var function is used to filter and sanitize the input according to the filter passed, we dont want to process any chracter that can harm our computer.
$password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//now check if the user actually passed some values in the signin form, if not then set a session message and head back to signin page
if (!$username_email) {
    $_SESSION['signin-error'] = "Username or email required";
} elseif (!$password) {
    $_SESSION['signin-error'] = "Password is required";
} else {
    //check fetch userdata, and check
}

if (isset($_POST['submit'])) {
    //move forward and get the form data
} else {
    //this page is not supposed to be accessed anyway else, head back to signin page and die()
    header('location:' . ROOT_URL . 'signin.php');
    die();
}
