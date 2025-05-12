<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<div class="container">
    <div class="login-page">
        <h3 class="text-white mb-4">Login to Admin</h3>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control mb-3" placeholder="Enter Username">
            </div>

            <div class="form-group">
                <input name="password" type="password" class="form-control mb-3" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="login" type="submit">Login</button>
            </div>
        </form><!--search form-->
    </div>

    <!-- /.input-group -->
</div>