<?php include "includes/db.php"?>
<?php include "includes/header.php"?>
<?php session_start(); ?>

    <!-- Navigation -->
   <?php include "includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">


            <!-- Blog Entries Column -->

           <div class="col-md-8">
                <?php

                    $per_page = 5;

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = "";
                    }

                    if($page == 0 || $page == 1){
                        $page_1 = 0;
                    }else{
                        $page_1 = ($page * $per_page) - $per_page;
                    }

                    // this if statement is for counting rows
                     if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {

                       $post_query_count = "SELECT * FROM posts";

                     } else {

                       $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";

                     }

                    $find_count = mysqli_query($connection,$post_query_count);
                    $count = mysqli_num_rows($find_count);

                    if($count < 1){
                        echo "<h3>NO POSTS AVAILABLE !</h3>";
                    }else{

                      $count  = ceil($count / $per_page);

                      if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                        $query = "SELECT * FROM posts LIMIT $page_1,$per_page";
                      }else {
                        $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1,$per_page";
                      }


                      $select_all_posts_query = mysqli_query($connection,$query);

                      while($row = mysqli_fetch_array($select_all_posts_query)){
                          $post_id = $row['post_id'];
                          $post_title = $row['post_title'];
                          $post_content = $row['post_content'];
                          $post_user = $row['post_user'];
                          $post_image = $row['post_image'];
                          $post_date = $row['post_date'];
                          $post_status = $row['post_status'];
                        ?>

                        <h2>
                            <a href="post/<?php echo $post_id?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">by <a href="author_post.php?author_name=<?php echo $post_user;?>&p_id=<?php echo $post_id;?>"><?php echo $post_user; ?></a></p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="/cms/images/<?php echo $post_image;?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo $post_content;?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>
                        <?php } } ?>
             </div>

                <!-- First Blog Post -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>
            <!-- /.row -->

        <hr>
        <!-- Footer -->
        <?php include "includes/footer.php"?>

            <ul class="pager">
                <?php

    for($i = 1; $i <= $count; $i++){
        if($i == $page){
            echo "<li><a href='index.php?page=$i' class='activeLink'>$i</a></li>";
        }else{
            echo "<li><a href='index.php?page=$i'>$i</a></li>";
        }

    }


                ?>
            </ul>
