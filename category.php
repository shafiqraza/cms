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
                    if(isset($_GET['cat_id'])){
                        $cat_id = $_GET['cat_id'];


                        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {



                          $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_date, post_user,post_image, post_content FROM posts WHERE post_category_id = ? ");



                        }else{


                          $stmt2 =  mysqli_prepare($connection, "SELECT post_id, post_title, post_date, post_user,post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ");

                          $published = "published";

                        }
                        if (isset($stmt1)) {

                              mysqli_stmt_bind_param($stmt1,'i',$cat_id);

                              mysqli_stmt_execute($stmt1);

                              mysqli_stmt_bind_result($stmt1,$post_id,$post_title, $post_date, $post_user,$post_image, $post_content);

                              $stmt = $stmt1;


                        }else{

                              mysqli_stmt_bind_param($stmt2,'is',$cat_id,$published);

                              mysqli_stmt_execute($stmt2);

                              mysqli_stmt_bind_result($stmt2,$post_id,$post_title, $post_date, $post_user,$post_image, $post_content);

                              $stmt = $stmt2;

                        }

                        // if (mysqli_stmt_num_rows($stmt) === 0) {
                        //
                        //   echo "<h4>No Category Found !</h4>";
                        //
                        // }


                        while(mysqli_stmt_fetch($stmt)){

                  ?>

                      <h2>

                          <a href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                      </h2>
                      <p class="lead">by <a href="index.php"><?php echo $post_user; ?></a></p>
                      <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                      <hr>
                      <img class="img-responsive" src="/cms/images/<?php echo $post_image;?>" alt="">
                      <hr>
                      <p><?php echo $post_content;?></p>
                  <?php
                }//endwhile; // WHILE LOOP ends

              } //  if(){} GET request ends
                ?>










             </div> <!-- Column end -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>

            <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"?>
