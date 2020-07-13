<?php
if(isset($_POST['create_user'])){
    $user_firstname  = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
    
    // $post_img = $_FILES['image']["name"];
    // $post_img_temp = $_FILES['image']["tmp_name"];
    
   

    //$post_date = date('d-m-y');
    
    //move_uploaded_file($post_img_temp,"../images/" . $post_img);
    
//   $user_firstname =  mysqli_real_escape_string($connection,$user_firstname);
//    $user_lastname = mysqli_real_escape_string($connection,$user_lastname);
//    $username = mysqli_real_escape_string($connection,$username);
//    $user_email = mysqli_real_escape_string($connection, $user_email);
//     $user_password = mysqli_real_escape_string($connection, $user_password);
    
    $pasword = password_hash($user_password,PASSWORD_BCRYPT,['option' => 10]);
    
    $query = "INSERT INTO `users` (`user_firstname`, `user_lastname`, `user_role`, `username`, `user_email`, `user_password`) VALUES ('$user_firstname', '$user_lastname', 'subscriber', '$username', '$user_email', '$pasword') ";
    
    $create_user_query = mysqli_query($connection,$query);
    
    confirmQuery($create_user_query);
    echo "<div class='alert alert-success'>
            User added<strong> Successfully</strong>
            <a href='users.php'>View Users</a>
        </div>";


}


?>

   
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
    
    <!-- <div class="form-group">
        <label for="">Post Image</label>
        <input type="file" class="form-control-file" name="image">
    </div> -->
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    
   <div class="form-group">
        <label for="">Email</label>
        <input type="Email" class="form-control" name="user_email">
    </div>
    
     <div class="form-group">
        <label for="">Pasword</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    
    <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    
</form>