<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php include "includes/hero.php"; ?>
<!-- Page Content -->
<div class="container">
    <div class="row  justify-content-center">
        <!-- Blog Entries Column -->
        <div class="col-md-2"></div>

        <div class="col-md-8">

            <?php
            // Check if 'author' parameter is set in the URL
            if (isset($_GET['author'])) {
                $the_post_author = $_GET['author'];

                // Fetch posts by the specified author
                $query = "SELECT * FROM posts WHERE post_user = '{$the_post_author}' ";
                $select_all_posts_query = mysqli_query($connection, $query);

                // Check if any posts are returned
                if (mysqli_num_rows($select_all_posts_query) > 0) {
                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_id = $row['post_id'];
                        ?>

                        <!-- Display each post -->
                        <div class="row align-items-center">

                            <div class="col-md-4 text-start">
                                <img class="img-responsive" style="width:243px; height:163px;"
                                    src="images/<?php echo $post_image; ?>" alt="">
                            </div>

                            <div class="col-md-8">
                                <div class="d-flex flex-row align-items-center mb-2">
                                    <a href="author_posts.php?author=<?php echo $post_author; ?>">
                                        <p class="lead m-0"><?php echo $post_author; ?></p>
                                    </a>
                                    <p class="mb-0 mt-1 ms-3"><span class="glyphicon glyphicon-time"></span>
                                        <?php echo $post_date ?></p>
                                </div>

                                <h2>
                                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?>
                                    </a>
                                </h2>

                            </div>
                        </div>
                        <hr>
                    <?php }
                } else {
                    // No posts found for the specified author
                    echo "<h2>No posts found for the author {$the_post_author}</h2>";
                }
            } else {
                // Handle the case where the 'author' parameter is missing
                echo "<h1>Author not specified.</h1>";
            }
            ?>

            <!-- Blog Comments -->
            <?php
            if (isset($_POST['create_comment'])) {
                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                    $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                    $create_comment_query = mysqli_query($connection, $query);

                    if (!$create_comment_query) {
                        die('QUERY FAILED' . mysqli_error($connection));
                    }

                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
                    $update_comment_count = mysqli_query($connection, $query);
                } else {
                    echo "<script>alert('Fields cannot be empty')</script>";
                }
            }
            ?>

        </div>
        <div class="col-md-2"></div>
    </div>

</div>

<?php include "includes/footer.php"; ?>