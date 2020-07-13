<?php include "includes/db.php"?>
<?php include "includes/header.php"?>

    <!-- Navigation -->
   <?php include "includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Entries Column -->

           <div class="col-md-8">

                <?php

                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];

                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";

                        $search_query = mysqli_query($connection,$query);
                        if(!$search_query){
                            die(mysqli_error($connection));
                        }
                        $count = mysqli_num_rows($search_query);
                        if($count == 0){
                            echo "No result found.";
                        }else{
                            while($row = mysqli_fetch_array($search_query)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_content = $row['post_content'];
                            $post_user = $row['post_user'];
                            $post_image = $row['post_image'];
                            $post_date = $row['post_date'];

                        ?>

                            <h2>
                                <a href="post/<?php echo $post_id?>"><?php echo $post_title; ?></a>
                            </h2>
                            <p class="lead">by <a href="index.php"><?php echo $post_user; ?></a></p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                            <hr>
                            <p><?php echo $post_content;?></p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>
     <?php
                            }
                    }


                     }

               ?>
             </div>

                <!-- First Blog Post -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>

            <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php";?>
