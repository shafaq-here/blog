<?php

require 'config/database.php';

//check if the user hit the sign in button


if (isset($_POST['submit'])) {
    //move forward and get the form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);  //the filter_var function is used to filter and sanitize the input according to the filter passed, we dont want to process any chracter that can harm our computer.
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //now check if the user actually passed some values in the signin form, if not then set a session message and head back to signin page
    if (!$username_email) {
        $_SESSION['signin-error'] = "Username or email required";
    } elseif (!$password) {
        $_SESSION['signin-error'] = "Password is required";
    } else {
        //check fetch userdata, and check
        $fetch_user_query = "SELECT FROM users WHERE username='$username_email' OR email='$username_email'";

        //execute the query
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        //if the num rows of the result is 1, hence the user is found and we will compare the password, from the result using the fetch assoc
        if (mysqli_num_rows($fetch_user_result) == 1) {
            //create a user record array, get the hashed password from it and compare it with the password from the form
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            //compare the passwords
            if (password_verify($password, $db_password)) {
                //hence the passwords match

                //add the user id to a new session for access control
                $_SESSION['user-id'] = $user_record['id'];

                //also check if user is admin or not, if yes then set another session
                if($user_record['is_admin']==1) {
                    $_SESSION['user_is_admin'] = true ;
                }

                //and log the user in
                header('location:'. ROOT_URL. 'admin/') ;
            } else {
                $_SESSION['signin-error'] = "Password is Incorrect, Please try again.";
            }
        } else {
            //user not found, so add a sesssion message
            $_SESSION['signin-error'] = "User not Found";
        }
        //now make sure that the signin-error session variable is set or not, if yes then get all the post data, and head back to the signin page, and die()
        if(isset($_SESSION['signin-error'])) {
            $_SESSION['signin-data'] = $_POST ;
            header('location:'.ROOT_URL.'signin.php') ;
        }
}
} else {
    //this page is not supposed to be accessed anyway else, head back to signin page and die()
    header('location:' . ROOT_URL . 'signin.php');
    die();
}
