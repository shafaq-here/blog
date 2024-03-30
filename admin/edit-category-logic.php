<?php 

require 'config/database.php' ;

//check for the submit button

if(isset($_POST['submit'])) {
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT) ;
    //get the details from the post

    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS) ;
    $description = filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS) ;

    //validate input fields

    if(!$title || !$description) {
        $_SESSION['edit-category-error'] = "Invalid form input on edit page!" ;
    } else {
        //update the category
        $query = "UPDATE categories SET title='$title', description='$description' WHERE id=$id limit 1" ;
        $result = mysqli_query($connection, $query) ;

        if(mysqli_errno($connection)) {
            $_SESSION['edit-category-error'] = "Failed to update category." ;
        } else{
            $_SESSION['edit-category-success'] = "Category $title updated successfully" ;
        }
    }

}
header('location: '.ROOT_URL.'admin/manage-categories.php') ;
die() ;