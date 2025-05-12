<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container-lg">
    <div class="row search-content">

        <!-- Blog Entries Column -->
        <div class="col-md-9">

            <?php

            if (isset($_POST['submit'])) {
                $search = trim($_POST['search']); // Remove extra spaces for additional safety
            
                if (!empty($search)) { // Ensure there is something to search for
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                    $search_query = mysqli_query($connection, $query);

                    if (!$search_query) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }

                    $count = mysqli_num_rows($search_query);

                    if ($count == 0) {
                        echo "<h1 class='text-center'>No results found</h1>";
                    } else {
                        while ($row = mysqli_fetch_assoc($search_query)) {
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
                            <div class="search-post blog-post me-5 pe-5 mb-5">
                                <h2>
                                    <a class="text-dark" href="post.php?p_id=<?php echo $post_id; ?>">
                                        <?php echo $post_title ?>
                                    </a>
                                </h2>

                                <p><span class="glyphicon glyphicon-time"></span>
                                    <?php echo $post_date ?>
                                </p>

                                <p class="me-5 pe-5 text-white">
                                    <?php echo $post_content ?>
                                </p>
                                <a class="text-secondary f-bold" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <hr>
                        <?php }
                    }
                } else {
                    echo "<h1 class='text-white text-center'>Please enter a search term</h1>";
                }
            }
            ?>

        </div>

        <div class="col-md-3">
            <form action="search.php" method="post">
                <div class="input-group mb-3">
                    <input name="search" type="text" class="form-control border-dark">
                    <button name="submit" class="btn btn-dark"
                        type="submit"><?php include 'svg/search.svg'; ?></button>
                </div>
            </form>

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