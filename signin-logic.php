<?php

require 'config/database.php';

if (isset($_POST['submit'])) {
    //
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);  //the filter_var function is used to filter and sanitize the input according to the filter passed, we dont want to process any chracter that can harm our computer.
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //check for empty submission
    if (!$username_email) {
        $_SESSION['signin-error'] = "Username or email required";
    } elseif (!$password) {
        $_SESSION['signin-error'] = "Password is required";
    } else {
        // do the job
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";

        //execute the query
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        //if the num rows of the result is 1, hence the user is found and we will compare the password, from the result using the fetch assoc
        if (mysqli_num_rows($fetch_user_result) == 1) {
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];

            //compare the passwords
            if (password_verify($password, $db_password)) {
                // log in

                //set session for access control
                $_SESSION['user-id'] = $user_record['id'] ;

                if($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true ;
                }
                header('location:' . ROOT_URL . 'admin/');
            } else {
                //passwords not match
                $_SESSION['signin-error'] = "Please check your password";
            }
        } else {
            //user not found
            $_SESSION['signin-error'] = "User not found";
        }
    }

    if (isset($_SESSION['signin-error'])) {
        //get the signin data
        $_SESSION['signin-data'] = $_POST;
        header('location:' . ROOT_URL . 'signin.php');
        die();
    }
} else {
    //redirect
    header('location:' . ROOT_URL . 'signin.php');
}
