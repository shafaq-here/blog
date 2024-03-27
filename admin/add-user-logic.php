<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //write the logic for getting data from form...

    //get the values, befre we use the input values, we are usign the filter function to prevernt from i guess attacks and sql injections

    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];


    //now validate the user input data

    if (!$firstname) {
        //means that the user did not pass any value or according to a condition
        //for this create a session message and save it throw an error on signup page

        $_SESSION['add-user-error'] = "Please enter your First Name";
    } elseif (!$lastname) {
        //means that the user did not pass any value or according to a condition
        //for this create a session message and save it throw an error on signup page

        $_SESSION['add-user-error'] = "Please enter your Last Name";
    } elseif (!$username) {
        //means that the user did not pass any value or according to a condition
        //for this create a session message and save it throw an error on signup page

        $_SESSION['add-user-error'] = "Please enter your Username";
    } elseif (!$email) {
        //means that the user did not pass any value or according to a condition
        //for this create a session message and save it throw an error on signup page

        $_SESSION['add-user-error'] = "Please enter a valid email address";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        //means that the user did not pass any value or according to a condition
        //for this create a session message and save it throw an error on signup page

        $_SESSION['add-user-error'] = "Password should be minimum 8 characters long"; }
    // } elseif (!$is_admin) {
    //     //check if the admin has not provided the role for user
    //     $_SESSION['add-user-error'] = "Please select a user role";
    // } 
        elseif (!$avatar['name']) {
        //means that the user did not pass any value or according to a condition
        //for this create a session message and save it throw an error on signup page

        $_SESSION['add-user-error'] = "Please add an avatar";
    } else {
        //now the inputs have been validated, check if the passwords dont match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['add-user-error'] = "Passwords dont match";
        } else {
            //create the hashed password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            //now while signing up, we need to make sure that the email or username entered does not exist in the database if it does we would send the message to the signup page

            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                //username or password already exists
                $_SESSION['add-user-error'] = "Username or Email already exists.";
            } else {
                //  every thing is on order we can proceed to save the avatar then saving the user in the database.

                //we will save only unique named images, so for that use time to generate randome number
                $time = time();
                $avatar_name = $time . $avatar['name'];
                //get the avatar's temp name from the dump
                $avatar_tmp_name = $avatar['tmp_name']; // The temporary filename of the file on the server., when we use move uploaded file, from this filename (location) to a permanent location of your choice, in our caae, we will upload it to /images with file name avatar_name

                //set a destination path for the image as well
                $avatar_destination_path = '../images/' . $avatar_name;

                //after all that we need to make sure that the file being uploaded is an image only, which can only be check from the extension

                $allowed_files = ['png', 'jpg', 'jpeg'];

                //get the extension from the avatar name
                $extension = explode('.', $avatar_name);
                $extension = end($extension);

                //now check if the extension is permissible
                if (in_array($extension, $allowed_files)) {
                    //means it is an image, now check for file size
                    if ($avatar['size'] < 1000000) {
                        //ready to upload the image
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        //too big
                        $_SESSION['add-user-error'] = "File size too large, should be less then 1mnb";
                    }
                } else {
                    //now allowed so send a message to signup
                    $_SESSION['add-user-error'] = "Please upload only png, jpg, or jpeg file";
                }
            }
        }
    }

    //now before proceeding to insert we need to make sure that there are no errors in the signuup
    if (isset($_SESSION['add-user-error'])) {
        //before we head back, lets grab the form data that we have just received to reprint it, even if the users makes a mistake while submitting the form

        $_SESSION['add-user-data'] = $_POST;

        //head back and die()
        header('location:' . ROOT_URL . 'admin/add-user.php');
        die();
    } else {
        //insert
        $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', $is_admin)";

        //we probably need to execute this query as well

        $insert_user_result = mysqli_query($connection, $insert_user_query);
        if (!mysqli_errno($connection)) {
            $_SESSION['add-user-success'] = "User added successfully.";
            header('location:' . ROOT_URL . 'admin/manage-users.php');
            die();
        }
    }
} else {
    //this page was accessed somehow else, so redirect back to signup
    header('location:' . ROOT_URL . 'admin/add-user.php');
    die();
}
