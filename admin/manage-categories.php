<?php
include 'partials/header.php' ;

//fetch all the categories from the database
$query = "SELECT * from categories ORDER BY title" ;
$categories = mysqli_query($connection,$query) ;
?>

<section class="dashboard">
<?php if (isset($_SESSION['add-category-success'])) : //print the success message everytime a new category is added by the admin
    ?>
        <div class="alert__message success container">
            <p>
                <?php
                echo $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success'])
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-category-success'])) : //print the success message everytime a category is updated by the admin
    ?>
        <div class="alert__message success container">
            <p>
                <?php
                echo $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success'])
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-category-error'])) : //print the error message everytime a user is failed to be updated by the admin
    ?>
        <div class="alert__message error container">
            <p>
                <?php
                echo $_SESSION['edit-category-error'];
                unset($_SESSION['edit-category-error'])
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
                <?php if(isset($_SESSION['user_is_admin'])): ?>
                <li>
                    <a href="<?php echo ROOT_URL ?>admin/add-user.php"><i class="uil uil-user-plus"></i>
                        <h5>Add User</h5>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ROOT_URL ?>admin/manage-users.php"><i class="uil uil-users-alt"></i>
                        <h5>Manage Users</h5>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ROOT_URL ?>admin/add-category.php"><i class="uil uil-edit"></i>
                        <h5>Add Category</h5>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ROOT_URL ?>admin/manage-categories.php" class="active"><i class="uil uil-list-ul"></i>
                        <h5>Manage Categories</h5>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if(mysqli_num_rows($categories) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <tr>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?php echo ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm">Edit</a></td>
                        <td><a href="<?php echo ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class="btn sm danger">Delete</a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error">
                    <p>No Category found!</p>
                </div>
            <?php endif ?>
        </main>
    </div>
</section>

<?php
include '../partials/footer.php'
?>