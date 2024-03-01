<?php 
    include 'partials/header.php';
?>

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Add Category</h2>
            <!-- We would want to display some alert messages, error or success so we create a separate div for that -->
            <div class="alert__message error">
                <p>This is an error message</p>
            </div>
            <form action="" enctype="multipart/form-data">
                <input type="text" placeholder="Title">
                <textarea rows="5" placeholder="Description"></textarea>
                
                
                <button type="submit" class="btn">Add Category</button>
    

            </form>
        </div>
    </section>

<?php 
    include('../partials/footer.php') ;
?>