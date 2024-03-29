<?php
include 'partials/header.php';

//get the data that

$title =  $_SESSION['add-category-data']['title'] ?? null;
$description =  $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']) ;

?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <!-- We would want to display some alert messages, error or success so we create a separate div for that -->
        <?php if (isset($_SESSION['add-category-error'])) : ?>
            <div class="alert__message error">
                <?= $_SESSION['add-category-error'];
                unset($_SESSION['add-category-error']);
                ?>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
            <input type="text" value="<?= $title ?>" name="title" placeholder="Title">
            <textarea rows="5" name="description" placeholder="Description"><?= $description ?></textarea>


            <button type="submit" name="submit" class="btn">Add Category</button>


        </form>
    </div>
</section>

<?php
include('../partials/footer.php');
?>