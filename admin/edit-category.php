<?php
include 'partials/header.php'
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Category</h2>
        <!-- We would want to display some alert messages, error or success so we create a separate div for that -->

        <form action="" enctype="multipart/form-data">
            <input type="text" placeholder="Title">
            <textarea rows="5" placeholder="Description"></textarea>


            <button type="submit" class="btn">Edit Category</button>


        </form>
    </div>
</section>

<?php
include '../partials/footer.php'
?>