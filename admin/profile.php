<?php include "includes/admin_header.php"; ?>

<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '$username' ";
    $select_user_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_user_query)){

        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $username = $row['username'];
        $user_role = $row['user_role'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];

    }
}




if(isset($_POST['edit_profile'])){
    $user_firstname = $_POST['user_firstname'];

    $user_lastname  = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];

    // $post_img = $_FILES['image']["name"];
    // $post_img_temp = $_FILES['image']["tmp_name"];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    // move_uploaded_file($post_img_temp,"../images/" . $post_img);

    // if(empty($post_img)){
    //     $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    //     $select_img = mysqli_query($connection, $query);
    //     while($row = mysqli_fetch_assoc($select_img)){
    //         $post_img = $row['post_image'];
    //     }
    // }




    // QUERY
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '$user_firstname', ";
    $query .= "user_lastname = '$user_lastname', ";
    $query .= "user_role = '$user_role', ";
    $query .= "username = '$username', ";
    $query .= "user_email = '$user_email', ";
    $query .= "user_password = '$user_password' ";
    $query .= "WHERE username = '$username' ";

    $edit_profile_query = mysqli_query($connection,$query);

    confirmQuery($edit_profile_query);
}

?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin area
                            <small><?php echo $username; ?></small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Firstname</label>
                               <!--  <input value="<?php //echo $the_user_id; ?>" type="hidden" class="form-control" name="the_user_id"> -->
                                <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
                            </div>
                            <div class="form-group">
                                <label for="">Lastname</label>
                               <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
                            </div>
                            <div class="form-group">
                                <label for="">Role</label>
                                 <select name="user_role" id="" class="form-control">
                                    <option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>;
                                    <?php
                                        if ($user_role == 'admin') {
                                            echo "<option value='subscriber'>subscriber</option>";
                                        }else{
                                            echo "<option value='admin'>admin</option>";
                                        }
                                    ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
                            </div>
                           <!--  <div class="form-group">
                                <label for="">Post Image</label>
                                <img src='<?php // echo "../images/$post_image"?>' alt="" width="100">
                                <input type="file" class="form-control-file" name="image">
                            </div> -->

                            <div class="form-group">
                                <label for="">Email</label>
                                <input value="<?php echo $user_email; ?>" type="text" class="form-control" name="user_email">
                            </div>
                            <div class="form-group">
                                <label for="">password</label>
                                <input value="<?php echo $_SESSION['password']; ?>" type="password" class="form-control" name="user_password">
                            </div>


                            <input type="submit" class="btn btn-primary" name="edit_profile" value="Edit Profle">

                        </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php"; ?>
