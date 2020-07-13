<?php
if(isset($_POST['create_post'])){
    $post_cat_id  = $_POST['post_cat_id'];
    $post_title = $_POST['post_title'];
    $post_user = $_POST['post_user'];
    
    $post_img = $_FILES['image']["name"];
    $post_img_temp = $_FILES['image']["tmp_name"];
    
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_status = $_POST['post_status'];
    $post_date = date('d-m-y');
    
    move_uploaded_file($post_img_temp,"../images/" . $post_img);
    
    
    $post_cat_id = escape($post_cat_id);
    $post_title = escape($post_title);
    $post_img = escape($post_img);
    $post_tags = escape($post_tags);
    $post_content = escape($post_content);
    $post_status = escape($post_status);
    
    $query = "INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES (NULL, '$post_cat_id', '$post_title', '$post_user', now(), '$post_img', '$post_content', '$post_tags', '$post_status') ";
    
    $create_post_query = mysqli_query($connection,$query);
    
    confirmQuery($create_post_query);
    $the_post_id = mysqli_insert_id($connection);

echo "<div class='alert alert-success'>
            Post added<strong> Successfully</strong>
            <a href='../post.php?p_id=$the_post_id'>View Post</a>
            <a href='posts.php'>View all Posts</a>
            <a href='posts.php?source=add_post'>Add more Posts</a>
            
        </div>";
}


?>

   
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Category</label>
        <select class="form-control" name="post_cat_id">
            <?php
            $query_cat = "SELECT * FROM categories ";
            $view_all_cat = mysqli_query($connection,$query_cat);
            
            confirmQuery($view_all_cat);
            while($row = mysqli_fetch_assoc($view_all_cat)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='$cat_id'>$cat_title</option>";
            }
            ?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for=""> User</label>
        <select class="" name="post_user">
            <?php
//            $query_users = "SELECT * FROM users";
//            $view_all_users = mysqli_query($connection,$query_users);
//            
//            confirmQuery($view_all_users);
//            
//            while($row = mysqli_fetch_assoc($view_all_users)){
//                $user_id = $row['user_id'];
//                $username = $row['username'];
//                echo "<option value='$username'>$username</option>";
//            }
            
            
            
            $current_user = $_SESSION['username'];
            echo "<option value='$current_user'>$current_user</option>";
         
            ?>
            
        </select>
    </div>
<!--
    <div class="form-group">
        <label for="">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
-->
    <div class="form-group">
        <label for="">Post Image</label>
        <input type="file" class="form-control-file" name="image">
    </div>
   
    <div class="form-group">
        <label for="">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <select name="post_status" >
            <option value="draft">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
       </select>
    </div>
     <div class="form-group">
        <label for="">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="body"></textarea>
    </div>
    
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    
</form>