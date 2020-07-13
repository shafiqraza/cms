<?php
include("delete_modal.php");
if(isset($_POST['checkBoxArray'])){

    foreach ($_POST['checkBoxArray'] as $checkboxValue) {

        $select_option = $_POST['bulkOption'];

        switch ($select_option) {
            case 'published':
                $query = "UPDATE posts SET post_status = '{$select_option}' WHERE post_id = $checkboxValue ";
                $update_to_publish = mysqli_query($connection,$query);
                confirmQuery($update_to_publish);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$select_option}' WHERE post_id = $checkboxValue ";
                $update_to_draft = mysqli_query($connection,$query);
                confirmQuery($update_to_draft);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = $checkboxValue ";
                $update_to_delete = mysqli_query($connection,$query);
                confirmQuery($update_to_delete);

                $query = "DELETE FROM comments WHERE comment_post_id = $checkboxValue ";
                $delete = mysqli_query($connection,$query);
                confirmQuery($delete);


                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = $checkboxValue ";
                $select_clone = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_clone)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_user = $row['post_user'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_cat_id = $row['post_category_id'];
                }

                $query = "INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES (NULL, '$post_cat_id', '$post_title', '$post_user', now(), '$post_image', '$post_content', '$post_tags', '$post_status') ";

                $clone_post_query = mysqli_query($connection,$query);
                confirmQuery($clone_post_query);


                break;
        }

    }
}
?>

<form method="post">
    <div id="blockOptionContainer" class="col-xs-4">
        <select class="form-control" name="bulkOption" id="">
            <option value="">Select option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>


        </select>
    </div>

    <div class="col-xs-4">
        <button type="submit" name="submit" class="btn btn-success">Apply</button>
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>
    <table class="table table-bordered table-hover">
        <tr>
            <th><input type="checkbox" name="" id="selectAllBoxes"></th>
            <th>Id</th>
            <th>Category</th>
            <th>Title</th>
            <th>User</th>
            <th>Date</th>
            <th>Image</th>
            <th>Content</th>
            <th>Tags</th>
            <th>Status</th>
            <th>Comment</th>
            <th>Post Views</th>
            <th>Edit</th>
            <th>Delete</th>

    <!--                                <th>User</th>-->
        </tr>
        <?php

        // $query = "SELECT * FROM posts ORDER BY post_id DESC";

        $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_title, posts.post_user, ";
        $query .= "posts.post_date, posts.post_image, posts.post_content, posts.post_tags , posts.post_comment_count, ";
        $query .= " posts.post_status , posts.post_views_count, categories.cat_id, categories.cat_title ";
        $query .= "FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY post_id DESC";
        $select_post = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_post)){
            echo "<tr>";
            $post_id = $row['post_id'];
            $post_category_id = $row['post_category_id'];
            $post_title = $row['post_title'];
            $post_user = $row['post_user'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];
            $post_views_count = $row['post_views_count'];
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            ?>

            <td>
                <input type="checkbox" name="checkBoxArray[]" class="checkBoxes" value="<?php echo $post_id; ?>">
            </td>

            <?php
            echo "<td>$post_id</td>";


            // $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
            // $select_cat_id = mysqli_query($connection,$query);
            //
            // while($row = mysqli_fetch_assoc($select_cat_id)){
            //     $the_cat_id = $row['cat_id'];
            //     $the_cat_title = $row['cat_title'];

                echo "<td>$cat_title</td>";
            //}

            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            echo "<td>$post_user</td>";
            echo "<td>$post_date</td>";
            echo "<td><img src='../images/$post_image' width='100'></td>";
            echo "<td>$post_content</td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_status</td>";


            $comments_query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $query_send = mysqli_query($connection,$comments_query);

            $post_comment_count = mysqli_num_rows($query_send);
            echo "<td><a href='comments_post.php?id=$post_id'>$post_comment_count</a></td>";



            echo "<td>$post_views_count</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'> Edit</a></td>";

            echo "<td><a href='javascript:void(0)' rel='$post_id' class='delete_link'> DELETE </a></td>";

            //echo "<td><a onClick=\"javascript: return confirm('Are you sure yoou want to delete this?');\" href='posts.php?delete=$post_id'> DELETE </a></td>";

            echo "</tr>";
        }
        ?>
    </table>
</form>




<?php
if(isset($_GET['delete'])){

    if(isset($_SESSION['user_role'])){

        if($_SESSION['user_role'] == 'admin'){

            $post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id=$post_id";
            $delete_query = mysqli_query($connection,$query);
            header("Location: posts.php");
            confirmQuery($delete_query);


            $query = "DELETE FROM comments WHERE comment_post_id= $post_id";
            $delete_comment_query = mysqli_query($connection,$query);
            header("Location: posts.php");
            confirmQuery($delete_comment_query);

        }

    }

}
?>
<script>
$(document).ready(function(){


    $(".delete_link").on("click",function(){

        var id = $(this).attr('rel');

        var delete_url = 'posts.php?delete='+ id +' ';

        $(".delete_modal_btn").attr('href',delete_url);


        $("#myModal").modal('show');

    });

});



</script>
