<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<?php
// Ορισμός του τίτλου της κατηγορίας πριν το layout
$post_category_id = isset($_GET['category']) ? $_GET['category'] : 0;

// Fetch the category title based on the category ID
$query = "SELECT cat_title, cat_image FROM categories WHERE cat_id = $post_category_id";
$category_query = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($category_query)) {
    $cat_title = $row['cat_title'];
    $cat_image = $row['cat_image']; // Ανάκτηση της εικόνας
} else {
    $cat_title = "No category found";
    $cat_image = "path/to/default-image.jpg"; // Εικόνα εναλλακτικής αν δεν υπάρχει
}
?>

<div class="main-content">

    <img src="images/<?php echo $cat_image; ?>" style="width:100%; height:100vh;">

    <h1 class="text-center content-title text-uppercase"><?php echo $cat_title; ?></h1>
</div>

<!-- Page Content -->
<div class="container-lg">
    <div class="row justify-content-center align-items-start mt-5">
        <!-- Blog Entries Column -->
        <div class="col-md-9">
            <?php
            $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = isset($row['post_content']) && !empty($row['post_content'])
                    ? substr(html_entity_decode(stripslashes($row['post_content'])), 0, 350) . '...'
                    : "No content available.";
                ?>

                <!-- First Blog Post -->
                <div class="blog-post pe-5 me-5">
                    <div class="pe-5 me-5 mb-5">
                        <h2>
                            <a class="text-dark"
                                href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                        </h2>

                        <p class="mb-0 mt-1 text-secondary"><span class="glyphicon glyphicon-time"></span>
                            <?php echo $post_date ?></p>

                        <p class="text-white pe-5 me-5"><?php echo $post_content ?></p>

                        <a class="text-secondary f-bold" href="post.php?p_id=<?php echo $post_id; ?>">Read more</a>
                    </div>
                    <hr>
                </div>
            <?php } ?>
        </div>

        <!-- Sidebar (Categories + Search) -->
        <div class="col-md-3">
            <form action="search.php" method="post">
                <div class="input-group mb-3">
                    <input name="search" type="text" class="form-control border-dark">
                    <button name="submit" class="btn btn-dark"
                        type="submit"><?php include 'svg/search.svg'; ?></button>
                </div>
            </form>

            <h5 class="my-3 f-bold">CATEGORIES</h5>

            <ul class="d-flex flex-column justify-content-around p-0 m-0">
                <?php
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo "<li class='p-0 mb-2 list-unstyled'><a class='text-decoration-none' href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?>