<?php

//check for the id param
if(isset($_GET['id'])) {
    //get the id and sanitize it
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ;
    require 'partials/header.php' ;
    //fetch the category with the id
    $query = "SELECT * from categories where id=$id" ;
    $result = mysqli_query($connection, $query) ;

    //it is important that we get only 1 category so check 
    if(mysqli_num_rows($result)==1) {
        $category = mysqli_fetch_assoc($result) ;
    }


} else {
    require 'config/constants.php' ;
    header('location: '.ROOT_URL.'admin/manage-categories.php') ;
}
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Category</h2>
        <!-- We would want to display some alert messages, error or success so we create a separate div for that -->

        <form action="<?= ROOT_URL?>admin/edit-category-logic.php?id=<?= $id ?>" method="POST">
            <input type="text" name="title" value="<?= $category['title'] ?>" placeholder="Title">
            <textarea rows="5" name="description" placeholder="Description"><?= $category['description'] ?></textarea>


            <button type="submit" class="btn">Edit Category</button>


        </form>
    </div>
</section>

<?php
include '../partials/footer.php'
?>