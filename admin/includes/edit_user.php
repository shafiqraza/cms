<?php
if(isset($_GET['edit_user'])){
    
    $the_user_id = $_GET['edit_user'];
    $query = "SELECT * FROM users WHERE user_id=$the_user_id";
    $the_edit_query  = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($the_edit_query)){
        
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $db_user_password = $row['user_password'];
       
    }
    
    
    edite_user();
}else{
    header("Location: index.php");
}


?>
<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
       
        <input value="<?php echo $the_user_id; ?>" type="hidden" class="form-control" name="the_user_id">
        
        <label for="">Firstname</label>     
        <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
        <label for="">Lastname</label>
       <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
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
        <input value="" type="password" class="form-control" name="user_password">
    </div>
    
    
    <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    
</form>
