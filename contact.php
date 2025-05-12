<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php

if (isset($_POST['submit'])) {
    $to = "manosgrammos9@gmail.com";
    $subject = wordwrap($_POST['subject'], 70);
    $body = $_POST['body'];
    $header = "From:" . $_POST['email'];

    mail($to, $subject, $body, $header);
}

?>
<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container-lg">
    <div class="row contact-form">
        <div class="col-xs-6 col-xs-offset-3">
            <div class="form-wrap">
                <h1 class="text-center mb-4">Contact Us</h1>
                <form role="form" action="" method="post" id="login-form" autocomplete="off">
                    <div class="form-group mb-3">
                        <label for="email" class="sr-only mb-2 f-bold">Email</label>
                        <input type="email" name="email" id="email" class="form-control border-dark" placeholder="Enter your Email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="subject" class="sr-only mb-2 f-bold">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control border-dark"
                            placeholder="Enter your Subject">
                    </div>

                    <div class="form-group mb-3">
                        <textarea name="body" id="body" class="form-control border-dark" style="height:225px" cols="50" rows="10"></textarea>
                    </div>

                    <input type="submit" name="submit" id="btn-login" class="btn btn-dark w-100 btn-lg btn-block"
                        value="Submit">
                </form>

            </div>
        </div> <!-- /.col-xs-12 -->
    </div> <!-- /.row -->

</div>
<?php include "includes/footer.php"; ?>