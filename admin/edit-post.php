<?php 
include 'partials/header.php'
?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Edit Post</h2>
            <!-- We would want to display some alert messages, error or success so we create a separate div for that -->
            <!-- <div class="alert__message error">
                <p>This is an error message</p>
            </div> -->
            <form action="" enctype="multipart/form-data">
                <input type="text" placeholder="Title">
                <select>
                    <option value="1">Food</option>
                    <option value="2">Travel</option><option value="3">Technology</option>
                </select> 
                <textarea rows="10" placeholder="Body"></textarea>
                <div class="form__control inline">
                    <input type="checkbox" id="is_featured" checked>
                    <label for="is_featured">Featured</label>
                </div>

                <div class="form__control">
                    <label for="thumbnail">Change Thumbnail</label>
                    <input type="file" id="thumbnail">
                </div>
                
                
                <button type="submit" class="btn">Edit Post</button>
    

            </form>
        </div>
    </section>

<?php 
include '../partials/footer.php'
?>