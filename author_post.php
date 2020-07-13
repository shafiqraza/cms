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
                    if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];
                        $author_name = $_GET['author_name'];
                    }
                    $query = "SELECT * FROM posts WHERE post_user = '$author_name' ";
                    $select_author_posts_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_author_posts_query)){
                        $post_title = $row['post_title'];
                        $post_content = $row['post_content'];
                        $post_user = $row['post_user'];
                        $post_image = $row['post_image'];
                        $post_date = $row['post_date'];
                        
                        ?>

                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">by <a href="index.php"><?php echo $post_user; ?></a></p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                        <hr>
                        <p><?php echo $post_content;?></p>
                        <?php } ?>
                        <hr>
                        
                         <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <?php 
                    if (isset($_POST['create_comment'])) {
                        $the_post_id = $_GET['p_id'];
                         $comment_author = $_POST['comment_author'];
                         $comment_email = $_POST['comment_email'];
                         $comment_content = $_POST['comment_content'];
                        
                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                          
                            $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content,comment_status, comment_date) VALUES ($the_post_id, '$comment_author','$comment_email', '$comment_content','unapprove',now()) ";
                            $create_comment_query = mysqli_query($connection,$query);
                            if (!$create_comment_query){
                                die(mysqli_error($connection));
                            }
                        }else{
                            echo "<script>alert('this filed cannot be empty');</script>";
                        }
                    }

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

                <hr>

                <!-- Posted Comments -->

                <?php 
                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'Approved' ORDER BY comment_id DESC ";
                    $select_comment = mysqli_query($connection,$query);
                    confirmQuery($select_comment);


                    //Increasing comment count 
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id ";
                    $updating_comment_count = mysqli_query($connection,$query);
                    


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

                <?php } ?>
                
                <hr>

             </div> <!-- Column end -->
                
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>
        
            <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"?>