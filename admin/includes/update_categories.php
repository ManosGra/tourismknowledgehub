<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>

        <?php
        if (isset($_GET['edit'])) {
            $cat_id = escape($_GET['edit']);
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $select_categories_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                $cat_image = $row['cat_image'];
                ?>

                <!-- Εμφάνιση του τίτλου -->
                <input value="<?php if (isset($cat_title)) {
                    echo $cat_title;
                } ?>" type="text" class="form-control"
                    name="cat_title">

                <!-- Εμφάνιση και Επεξεργασία της Εικόνας -->
                <hr>
                <label for="cat_image">Current Image</label><br>
                <?php if (!empty($cat_image)) { ?>
                    <img src="images/categories/<?php echo $cat_image; ?>" width="100" alt="Category Image"><br>
                <?php } ?>
                <hr>
                <label for="cat_image">Upload New Image</label>
                <input type="file" class="form-control" name="cat_image">

            <?php }
        } ?>

        <?php
        if (isset($_POST['update_category'])) {
            $the_cat_title = escape($_POST['cat_title']);

            // Επεξεργασία Εικόνας
            $cat_image = $_FILES['cat_image']['name'];
            $cat_image_temp = $_FILES['cat_image']['tmp_name'];

            if (!empty($cat_image)) {
                $upload_dir = "images/categories/";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                move_uploaded_file($cat_image_temp, $upload_dir . $cat_image);

                // Ενημέρωση τίτλου και εικόνας
                $query = "UPDATE categories SET cat_title = '{$the_cat_title}', cat_image = '{$cat_image}' WHERE cat_id = {$cat_id}";
            } else {
                // Ενημέρωση μόνο τίτλου
                $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";
            }

            $update_query = mysqli_query($connection, $query);

            if (!$update_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            } else {
                echo "Category updated successfully!";
            }
        }
        ?>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_category" value="Update Category">
    </div>
</form>