<?php 
require 'config/database.php' ;

//check if the submit button was clicked or not

if(isset($_POST['submit'])) {
    //sanitize the inputs

    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS) ;
    $description = filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS) ;


    //validate the user input

    if(!$title) {
        $_SESSION['add-category-error'] = "Enter Title" ;
    } elseif(!$description) {
        $_SESSION['add-category-error'] = "Enter Description" ;
    } 

    //if there is any error, head back to add category page and display the error messages but display the typed formm data as well

    if(isset($_SESSION['add-category-error'])) {
        $_SESSION['add-category-data'] = $_POST ;
        header('location: '. ROOT_URL . 'admin/add-category.php') ;
        die() ;
    } else {
        //insert into database
        $query = "INSERT into categories (title, description) VALUES ('$title', '$description')" ;
        $result = mysqli_query($connection, $query) ;
        if(mysqli_errno($connection)) {
            $_SESSION['add-category-error'] = "Could'nt add a new category" ;
            header('location: '.ROOT_URL.'admin/add-category.php') ;
            die() ;
        } else {
            //category created successfully
            $_SESSION['add-category-success'] = "Category $title added successfully" ;
            header('location: '.ROOT_URL.'admin/manage-categories.php') ;
        }
    }

}