<?php include "includes/db.php"?>
<?php include "includes/header.php"?>
<?php include "admin/functions.php" ?>

    <!-- Navigation -->
   <?php include "includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Entries Column -->

           <div class="col-md-8">

                <?php
                if (isset($_GET['p_id'])) {
                  $post_id = $_GET['p_id'];

                  $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id ";
                  $increase_views_count = mysqli_query($connection,$query);

                  if(!$increase_views_count){
                      die(mysqli_error($connection));
                  }

                  if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                    $query = "SELECT * FROM posts WHERE post_id = $post_id ";
                  }else{
                    $query = "SELECT * FROM posts WHERE post_id = $post_id AND post_status = 'published'";
                  }


                  $send_query = mysqli_query($connection,$query);
                  $count = mysqli_num_rows($send_query);
                  if ($count < 1) {
                    echo "NO POST AVAILABLE";
                  }else {

                      while ($row = mysqli_fetch_assoc($send_query)) {
                        $post_title = $row['post_title'];
                        $post_content = $row['post_content'];
                        $post_user = $row['post_user'];
                        $post_image = $row['post_image'];
                        $post_date = $row['post_date'];

                        ?>
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">by <a href="index.php"><?php echo $post_user; ?></a></p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="/cms/images/<?php echo $post_image;?>" alt="">
                        <hr>
                        <p><?php echo $post_content;?></p>

                        <hr>

                       <div class="well">
                          <?php
                          create_post_comment();

                           ?>

                          <form role="form" action="" method="Post">
                              <div class="form-group">
                                  <label>Author</label>
                                  <input type="Text"class="form-control" name="comment_author" required>
                              </div>
                              <div class="form-group">
                                  <label>Email</label>
                                  <input type="email" class="form-control" name="comment_email" required>
                              </div>
                              <div class="form-group">
                                  <label>Comment</label>
                                  <textarea class="form-control" rows="3" name="comment_content" required></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                          </form>
                      </div>

                      <?php




                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER BY comment_id DESC ";

                    $select_comment = mysqli_query($connection,$query);
                    confirmQuery($select_comment);

                    while ($row = mysqli_fetch_assoc($select_comment)) {
                        $the_author = $row['comment_author'];
                        $the_date = $row['comment_date'];
                        $the_content = $row['comment_content'];

                ?>

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $the_author; ?>
                            <small><?php echo $the_date; ?></small>
                        </h4>
                       <?php echo $the_content; ?>
                    </div>
                </div>
                <?php
              }// POSTED comments showing loop
                      }
                  }
                    }else{
                      header("Location: index.php");
                    }

                ?>

                <hr>

             </div> <!-- Column end -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>

            <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"?>
