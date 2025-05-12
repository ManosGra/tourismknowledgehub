<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<?php include "includes/hero.php" ?>

<div class="container-lg">
  <div class="row main-index align-items-center">

    <div class="col-md-12">
      <div class="row my-5 align-items-center">
        <div class="col-md-6">
          <h2 class="mb-4">Exploring Tourism Together</h2>

          <p>Welcome to [Your Website Name], your go-to source for insights and expertise in the tourism
            and hospitality industry.</p>

          <p>At [Your Website Name], we are passionate about exploring the ever-evolving world of travel, hospitality,
            and
            guest experiences. Whether you're a professional in the industry, a business owner, or simply someone with a
            love for tourism, we provide the knowledge and tools you need to stay ahead in this fast-paced sector.</p>
        </div>

        <div class="col-md-6 text-end">
          <img src="images/placeholder.jpg" class="img-fluid box-shadow rounded" style="height:400px; width:600px;">
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="row align-items-center mb-5">
        <div class="col-md-6">
          <img src="images/placeholder.jpg" class="img-fluid box-shadow rounded" style="height:400px; width:600px;">
        </div>

        <div class="col-md-6">
          <h2 class="mb-4">What We Offer</h2>

          <ul class="p-3">
            <li class="mb-3">In-depth Tourism Insights: Dive into trends, market analysis, and strategies shaping the
              future of travel.
              Hospitality Expertise: Discover best practices for creating unforgettable guest experiences and managing
              thriving hospitality businesses.</li>

            <li class="mb-3">Global Perspectives: Explore stories and case studies from around the world, showcasing
              innovation and
              excellence in the industry.</li>

            <li class="mb-3">Our mission is to empower tourism and hospitality professionals with actionable insights
              and
              inspiration,
              fostering a community of innovators dedicated to making travel better for everyone.</li>
          </ul>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="row align-items-center mb-5">
        <h2 class="mb-5">Popular</h2>
        <?php
        $query = "SELECT * FROM categories";
        $select_all_categories_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
          $cat_title = $row['cat_title'];
          $cat_id = $row['cat_id'];
          $cat_image = $row['cat_image']; // Ανάκτηση της στήλης εικόνας
          ?>

          <div class='col-md-3'>
            <a class='text-decoration-none' href='category.php?category=<?php echo $cat_id; ?>'>
              <div class="category-container">
                <!-- Έλεγχος για την εικόνα -->
                <?php if (!empty($cat_image)) { ?>
                  <img class="img-fluid rounded" src="admin/images/categories/<?php echo $cat_image; ?>"
                    alt="<?php echo $cat_title; ?>">
                <?php } else { ?>
                  <img class="img-fluid" src="images/default.jpg" alt="Default Image">
                  <!-- Εμφάνιση προεπιλεγμένης εικόνας αν δεν υπάρχει -->
                <?php } ?>
                <div class="category-container-name">
                  <h5>
                    <a class='text-decoration-none' href='category.php?category=<?php echo $cat_id; ?>'>
                      <?php echo $cat_title; ?>
                    </a>
                  </h5>
                </div>
              </div>
            </a>
          </div>
        <?php }
        ?>
      </div>
    </div>

    <div class="col-md-12">
      <div class="row align-items-center g-0 mt-5">
        <div class="col-md-6">

          <h2 class="mb-5">About Me</h2>

          <p>I’m Vasiliki, a passionate tourism and hospitality professional with 20
            years of experience in hotel management, tourism marketing, and destination planning. Over the years, I’ve
            gained invaluable knowledge and insights, and this blog is my way of sharing them with you.</p>

          <p>Whether you’re a professional eager to refine your skills, a student preparing to step into the industry,
            or
            simply a curious traveler wanting a deeper understanding of tourism, you’re in the right place. Together,
            we’ll uncover industry trends, explore strategies for success, and dive into inspiring stories that foster
            sustainable and meaningful travel.</p>

          <p>For me, tourism is far more than just travel. It’s about connecting people, celebrating cultures, and
            creating
            memories that last a lifetime. My goal is to empower and inspire you to grow, innovate, and make a
            difference
            in this dynamic field.</p>

          <p>I invite you to explore the blog, share your thoughts, and
            connect with me. Together, we can transform tourism into a passion that enriches lives and shapes the
            future!</p>

          <h6 class="f-bold mt-5">Thank you for joining me on this exciting journey!</h6>
        </div>

        <div class="col-md-6 text-end">
          <img src="images/placeholder.jpg" class="img-fluid box-shadow rounded" style="height:500px; width:600px;">
        </div>
      </div>
    </div>

    <div class="col-md-12">

      <h2 class="mt-5 pt-5 mb-4">Latest Articles</h2>

      <div class="row align-items-center">
        <?php
        $query = "SELECT * FROM posts ORDER BY post_date DESC LIMIT 3";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $post_title = $row['post_title'];
            $post_date = $row['post_date'];
            $post_content = substr($row['post_content'], 0, 100);
            $post_image = $row['post_image'];
            ?>

            <div class='col-md-4 mb-4'>
              <div class='blog-post category-container'>

                <a href='post.php?p_id=<?php echo $row['post_id']; ?>'><img src="images/<?php echo $post_image; ?>"
                    alt="<?php echo $post_title; ?>" class="img-fluid mb-3 rounded"></a>

                <p class="mb-0 text-secondary"><span class="glyphicon glyphicon-time"></span>
                  <?php echo $post_date ?></p>

                <a class="text-dark" href='post.php?p_id=<?php echo $row['post_id']; ?>'>
                  <h4 class="mb-2 f-bold text-dark"><?php echo $post_title; ?></h4>
                </a>

                <a class="text-secondary f-bold" href='post.php?p_id=<?php echo $row['post_id']; ?>'>Read more</a>
              </div>
            </div>
            <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>

<?php include "includes/footer.php" ?>