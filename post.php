<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<?php ob_start(); ?>
<!-- Page Content -->

<div class="row w-100 g-0">
    <!-- Blog Entries Column -->
    <div class="col-md-12">

        <?php
        if (isset($_GET['p_id'])) {

            $the_post_id = $_GET['p_id'];

            $view_query = "UPDATE posts SET post_view_counts = post_view_counts + 1 WHERE post_id = $the_post_id";
            $send_query = mysqli_query($connection, $view_query);
            if (!$send_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }

            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                ?>

                <!-- First Blog Post -->
                <div class="main-content">
                    <img class="img-fluid" style="width:100%; height:100vh;" src="images/<?php echo $post_image; ?>" alt="">
                </div>

                <div class="container-lg">
                    <div class="row my-5 align-items-start">
                        <div class="col-md-9">
                            <div class="pe-5">
                                <h1 class="mb-4"><?php echo $post_title ?></h1>
                                <p class="content-text">
                                    <?php echo $post_content ?>
                                </p>

                                <div class="share-buttons">
                                    <h3 class="my-4">SHARE THIS:</h3>
                                    <!-- Facebook -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://tourismknowledgehub.com" target="_blank">
                                        <button class="btn btn-primary f-bold">Share on Facebook</button>
                                    </a>

                                    <!-- Twitter -->
                                    <a href="https://twitter.com/intent/tweet?url=https://tourismknowledgehub.com&text=Check+out+this+amazing+content!"
                                        target="_blank">
                                        <button class="btn btn-info f-bold">Share on Twitter</button>
                                    </a>

                                    <!-- LinkedIn -->
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=https://tourismknowledgehub.com"
                                        target="_blank">
                                        <button class="btn btn-secondary f-bold">Share on LinkedIn</button>
                                    </a>
                                </div>
                                <hr class="mt-5">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <form action="search.php" method="post">
                                <div class="input-group mb-3">
                                    <input name="search" type="text" class="form-control  border-dark">
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

                            <p><a class="text-decoration-none" href="contact.php">Contact Us</a></p>
                        </div>
                    </div>

                </div>

            <?php }
        } else {
            header("Location: index.php");
        }
        ?>

        <!-- Blog Comments -->
        <div class="container-lg">

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

                    header("Location:/post.php?p_id=$the_post_id");
                } else {
                    echo "<script>alert('Fields cannot be empty');</script>";
                }
            }
            ?>

            <!-- Comments Form -->

            <div class="col-md-8">
                <h4 class="f-bold">Leave a Comment:</h4>
                <form role="form" action="" method="post">

                    <div class="form-group  mb-2">
                        <label for="Author">Author</label>
                        <input type="text" class="form-control border-dark" name="comment_author">
                    </div>

                    <div class="form-group mb-2">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control border-dark" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="Comment">Your Comment</label>
                        <textarea class="form-control border-dark" name="comment_content" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-dark mt-3 w-100">Submit</button>
                </form>
                <hr class="mt-4">
            </div>

            <!-- Posted Comments -->

            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($connection, $query);
            if (!$select_comment_query) {
                die('Query Failed' . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                ?>

                <div class="media mt-5">
                    <h4>Comments:</h4>
                    <div class="media-body">
                        <p class="media-heading">
                            <?php echo $comment_author; ?> /
                            <small>
                                <?php echo $comment_date; ?>
                            </small>
                        </p>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div> <!-- .col-md-12 -->

</div> <!-- .row.main-content -->

<?php include "includes/footer.php" ?>