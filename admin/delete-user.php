<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch the user data from the database to also remove the avatar and other things related to the current user

    $query = "SELECT * from users where id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    //it is important to make sure we only get one result
    if (mysqli_num_rows($result) == 1) {
        //proceed to delete/unlink the user avatar from the path
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;

        if ($avatar_path) {
            unlink($avatar_path);
        }
    }

    //in future we would also need to remove the post, thumbnails related to this user, will do it later





    //now we want to delete the user successfully

    $query = "DELETE from users where id=$id";
    $result = mysqli_query($connection, $query);
    //check for any errors and store it in the session
    if (mysqli_errno($connection)) {
        $_SESSION['delete-user-error'] = "Failed to Delete the user {$user['firstname']} {$user['lastname']}";
    } else {
        $_SESSION['delete-user-success'] = "Deleted the user {$user['firstname']} {$user['lastname']} successfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();
