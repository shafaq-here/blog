<?php
include 'partials/header.php';
//fetch all the users except the current admin, because we dont want to display ourselves !
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * from users where not id=$current_admin_id";
$users = mysqli_query($connection, $query);

?>
<section class="dashboard">
    <?php if (isset($_SESSION['add-user-success'])) : //print the success message everytime a new user is added by the admin
    ?>
        <div class="alert__message success container">
            <p>
                <?php
                echo $_SESSION['add-user-success'];
                unset($_SESSION['add-user-success'])
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-user-success'])) : //print the success message everytime a user is updated by the admin
    ?>
        <div class="alert__message success container">
            <p>
                <?php
                echo $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success'])
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-user-error'])) : //print the error message everytime a user is failed to be updated by the admin
    ?>
        <div class="alert__message error container">
            <p>
                <?php
                echo $_SESSION['edit-user-error'];
                unset($_SESSION['edit-user-error'])
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user-error'])) : //print the error message everytime a user is failed to be deleted by the admin
    ?>
        <div class="alert__message error container">
            <p>
                <?php
                echo $_SESSION['delete-user-error'];
                unset($_SESSION['delete-user-error'])
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user-success'])) : //print the error message everytime a user is failed to be updated by the admin
    ?>
        <div class="alert__message success container">
            <p>
                <?php
                echo $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success'])
                ?>
            </p>
        </div>
    <?php endif ?>

    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle">
            <i class="uil uil-angle-right-b"></i>
        </button>
        <button id="hide__sidebar-btn" class="sidebar__toggle">
            <i class="uil uil-angle-left-b"></i>
        </button>

        <aside>
            <ul>
                <li>
                    <a href="<?php echo ROOT_URL ?>admin/add-post.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ROOT_URL ?>admin/index.php"><i class="uil uil-postcard"></i>
                        <h5>Manage Posts</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="<?php echo ROOT_URL ?>admin/add-user.php"><i class="uil uil-user-plus"></i>
                            <h5>Add User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL ?>admin/manage-users.php" class="active"><i class="uil uil-users-alt"></i>
                            <h5>Manage Users</h5>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL ?>admin/add-category.php"><i class="uil uil-edit"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL ?>admin/manage-categories.php"><i class="uil uil-list-ul"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Users</h2>
            <!-- show the table only when there is a user present in the database except the current admin -->
            <?php if (mysqli_num_rows($users) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                            <tr>
                                <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><a href="<?php echo ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?php echo ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Delete</a></td>
                                <td><?= $user['is_admin'] ? "Yes" : "No"; ?></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error">
                    <p>No user found!</p>
                </div>
            <?php endif ?>
        </main>
    </div>
</section>

<?php
include '../partials/footer.php'
?>