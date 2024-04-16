<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //set the is_featured checkbox to 0 if it is marked unchecked

    $is_featured = $is_featured == 1 ?: 0;

    //form validation

    if (!$title) {
        $_SESSION['add-post-error'] = "Enter Post Title";
    } elseif (!$category_id) {
        $_SESSION['add-post-error'] = "Select Post Category";
    } elseif (!$body) {
        $_SESSION['add-post-error'] = "Enter Post Body";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post-error'] = "Add Post Thumbnail";
    } else {
        //now we work on the thumbnail
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = "../images/" . $thumbnail_name;

        $allowed_files = ['png', 'jpg', 'jpeg'];

        $extension = explode('.', $thumbnail_name);

        $extension = end($extension);

        if (in_array($extension, $allowed_files)) {
            //now we check the size of the image

            if ($thumbnail['size'] < 2_000_000) {
                // move forward
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                //file size too big
                $_SESSION['add-post-error'] = "File size too big, should be less than 2mb";
            }
        } else {
            //make sure the file is allowed
            $_SESSION['add-post-error'] = "File should be png, jpg, or jpeg";
        }
    }

    //we now make sure if there was any error encountered, then we redirect back to the add post page with the given form data.

    if (isset($_SESSION['add-post-error'])) {
        //get the form data first
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    } else {
        //we move forward to insert the post into database

        //now when we add a post that is set to be a featured post, make sure to unset all other posts to 0 for is_featured
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        //insert the post

        $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES ('$title', '$body', '$thumbnail_name', $category_id, $author_id, $is_featured)";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            //insert post was successul
            $_SESSION['add-post-success'] = "New Post added successfully";
            header('location: ' . ROOT_URL . 'admin/');
            die();
        }
    }
}

header("location: " . ROOT_URL . 'admin/add-post.php');
die();
