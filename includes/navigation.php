<div class="nav-bar py-4">
    <div class="container-lg">
        <!-- Collect the nav links, forms, and other content for toggling -->

        <div class="row align-items-center justify-content-between">
            <div class="col-md-7">
                <div class="logo">
                    <a class="text-decoration-none" href="index">CMS Front</a>
                </div>
            </div>

            <div class="col-md-5">
                <ul class="d-flex flex-row align-items-center justify-content-between mb-0">
                    <?php
                    $query = "SELECT * FROM categories WHERE cat_title IN ('Business Travel', 'Leisure Travel')";
                    $select_all_categories_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li class='p-0 mb-0 list-unstyled'><a class='text-decoration-none' href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    }
                    ?>
                    <li class='p-0 mb-0 list-unstyled'><a href="#" class='text-decoration-none'>Our Mission</a>
                    <li class='p-0 mb-0 list-unstyled'><a href="#" class='text-decoration-none'>Popular</a>
                   
                </ul>

            </div>

            <!--<div class="col-md-2">
                <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                    
                            <button name="submit" class="btn btn-primary" type="submit">Search</button>
                        
                    </div>
                </form>search form

            </div>-->

        </div>

        <!-- /.navbar-collapse -->

    </div>
    <!-- /.container -->
</div>

<!----                 NAVIGATION BACKUP
 <ul class="d-flex flex-row align-items-center justify-content-between p-0 m-0">

             
                </ul> ---->