</div>
<!-- /#wrapper -->

<!-- Custom Fonts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/summernote.min.js"></script>
<script src="js/scripts.js"></script>

<!--JQUERY FOR SELECT ALL CHECKBOXES --->

<script>
    $(document).ready(function () {
        $('#selectAllBoxes').on('click', function () {
            $('.checkBoxes').prop('checked', this.checked);
        });
    });
</script>

<script>

    $(document).ready(function () {
        $(".delete_link").on('click', function() {
            var id = $(this).attr("rel");
            var delete_url = "posts.php?delete="+ id +" ";

            $(".modal_delete_link").attr("href", delete_url);

            $("#myModal").modal('show');
        });
    });

</script>
</body>

</html>