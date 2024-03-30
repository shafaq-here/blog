<?php
require 'config/database.php' ;

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ;

    //FOR LATER
    //posts that belong to this category will now be moved to the uncategorized category, which we will do later



    //delete the category
    $query = "DELETE from categories where id=$id" ;
    $result = mysqli_query($connection, $query) ;

    if(mysqli_errno($connection)) {
        $_SESSION['delete-category-error'] = "Failed to delete the category." ;
    } else {
        $_SESSION['delete-category-success'] = "Category deleted successfully" ;
    }

}

header('location: '.ROOT_URL.'admin/manage-categories.php') ;
die() ;
