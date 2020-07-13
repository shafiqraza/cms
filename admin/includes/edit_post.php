<?php
if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id=$the_post_id";
    $edit_query  = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($edit_query)){

        $post_category_id = $row['post_category_id'];
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        $post_content = $row['post_content'];
    }
}
?>

<?php
if(isset($_POST['edit_post'])){
    $the_post_id = $_POST['post_id'];

    $post_category  = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_img = $_FILES['image']["name"];
    $post_img_temp = $_FILES['image']["tmp_name"];

    $post_tags = $_POST['post_tags'];
    $post_status = $_POST['post_status'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_img_temp,"../images/" . $post_img);

    if(empty($post_img)){
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_img = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_img)){
            $post_img = $row['post_image'];
        }
    }

    // RESET VIEWS QUERY
    $reset_views_query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $the_post_id ";
    $select_reset_view_query = mysqli_query($connection,$reset_views_query);
     confirmQuery($select_reset_view_query);

    //  EDIT QUERY
    $query = "UPDATE posts SET ";
    $query .= "post_category_id = '$post_category', ";
    $query .= "post_title = '$post_title', ";
    $query .= "post_date = now(), ";
    $query .= "post_image = '$post_img', ";
    $query .= "post_content = '$post_content', ";
    $query .= "post_tags = '$post_tags', ";
    $query .= "post_status = '$post_status' ";
    $query .= "WHERE post_id = $the_post_id ";

    $edit_query = mysqli_query($connection,$query);

    confirmQuery($edit_query);

    echo "<div class='alert alert-success'>
            Post Edited<strong> Successfully</strong>
            <a href='../post.php?p_id=$the_post_id'>View Post</a>
            or
            <a href='posts.php'>Edit more Post</a>
        </div>";
}
?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="">Post Title</label>
        <input value="<?php echo $post_id; ?>" type="hidden" class="form-control" name="post_id">
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">

        <label for="">Category</label>
        <select name="post_category" id="" class="">
            <?php
                $query  = "SELECT * FROM categories ";
                $showAllCatQuery = mysqli_query($connection,$query);
                confirmQuery($showAllCatQuery);

            while($row = mysqli_fetch_assoc($showAllCatQuery)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                if ($post_category_id == $cat_id) {
                  echo "<option selected value='$cat_id'>$cat_title</option>";
                }else {
                  echo "<option value='$cat_id'>$cat_title</option>";
                }


            }
            ?>
        </select>
    </div>
<!--
     <div class="form-group">
        <label for=""> User</label>
        <select class="" name="post_user">
-->
            <?php
//            $query_users = "SELECT * FROM users ";
//            $view_all_users = mysqli_query($connection,$query_users);
//
//
//            echo "<option value='$username'>$post_user</option>";
//            confirmQuery($view_all_users);
//            while($row = mysqli_fetch_assoc($view_all_users)){
//                $user_id = $row['user_id'];
//                $username = $row['username'];
//                echo "<option value='$username'>$username</option>";
//            }
            ?>

<!--
        </select>
    </div>
-->
    <div class="form-group">
        <label for="">Post Image</label>
        <img src='<?php echo "../images/$post_image"?>' alt="" width="100">
        <input type="file" class="form-control-file" name="image">
    </div>

    <div class="form-group">
        <label for="">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <select name="post_status">
            <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
            <?php
            if ($post_status == 'draft') {
                echo "<option value='published'>Publish</option>";
            }else{
                echo "<option value='draft'>Draft</option>";
            }

            ?>
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="">Post Status</label>
        <input value="<?php// echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div> -->
     <div class="form-group">
        <label for="">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="body"><?php echo $post_content; ?></textarea>
    </div>

    <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">

</form>
