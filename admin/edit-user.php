<?php
include 'partials/header.php';
//before we proceed further we need to check if this page was accessed with an id parameter or not
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ;
    //also get all the details for the current user
    $query = "SELECT * from users where id=$id" ;
    $result = mysqli_query($connection, $query) ;
    $user = mysqli_fetch_assoc($result) ;
} else {
    header('Location: ' . ROOT_URL . 'admin/manage-users.php'); // Added colon after Location
    die();
}
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit User</h2>
        <!-- We would want to display some alert messages, error or success so we create a separate div for that -->

        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php?id=<?=$id?>" method="POST">
            <input type="text" name="firstname" value="<?= $user['firstname'] ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?= $user['lastname'] ?>" placeholder="Last Name">

            <select name="userrole">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>

            <button type="submit" name="submit" class="btn">Update User</button>


        </form>
    </div>
</section>

<?php
include '../partials/footer.php'
?>