<?php session_start(); ?>

<?php
function confirmQuery($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED " . mysqli_error($connection));
    }
}



function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,$string);
}

function redirect($location){
  header("Location: " . $location);
}

function isLoggedIn(){
  if (isset($_SESSION['user_role'])) {
    return true;
  }else {
    return false;
  }
}

function checkIfUserLoggedInAndRedirect($redirecLocation){
  if (isLoggedIn()) {
    redirect($redirecLocation
  );
  }
}

function ifItIsMethod($method){
  if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
    return true;
  }else {
    return false;
  }
}


function create_post_comment(){

  global $connection;
  if (isset($_POST['create_comment'])) {
      $the_post_id = escape($_GET['p_id']);
       $comment_author = escape($_POST['comment_author']);
       $comment_email = escape($_POST['comment_email']);
       $comment_content = escape($_POST['comment_content']);

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
}


function users_online() {


    if(isset($_GET['onlineusers'])) {

    global $connection;

    if(!$connection) {


        include("../includes/db.php");

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL) {

        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");

        } else {

            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }

        $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($users_online_query);


    }






    } // get request isset()


}

users_online();

function add_category(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){

            echo "This field should not be empty.";

        }else{
            $stmt = mysqli_prepare($connection,"INSERT INTO categories(cat_title) VALUES(?) ") ;
            mysqli_stmt_bind_param($stmt,"s",$cat_title);
            $result = mysqli_stmt_execute($stmt);

            // if(!$result){
            //     die(mysqli_error($connection));
            // }else{
            //     echo "Category Added succesfully";
            // }

        }
    }
}

function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr></tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?delete=$cat_id'>DELETE</a></td>";
        echo "<td><a href='categories.php?edite=$cat_id'>Edite</a></td>";

        echo "<tr></tr>";
    }
}

function deleteCategories(){
    global $connection;
    if(isset($_GET['delete'])){
        if(isset($_SESSION['user_role'])){

            if($_SESSION['user_role'] == 'admin'){

                $cat_id = $_GET['delete'];
                $query = "DELETE FROM categories WHERE cat_id = $cat_id ";
                $delete_query = mysqli_query($connection, $query);

                if(!$delete_query){

                    die(mysqli_error($connection));

                }

                header("Location: categories.php");

            }

        }

    }
}





function edite_user(){

    global $connection;



    if(isset($_POST['edit_user'])){
        $the_user_id = $_POST['the_user_id'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname  = $_POST['user_lastname'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];



        // $post_img = $_FILES['image']["name"];
        // $post_img_temp = $_FILES['image']["tmp_name"];

           // move_uploaded_file($post_img_temp,"../images/" . $post_img);

        // if(empty($post_img)){
        //     $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        //     $select_img = mysqli_query($connection, $query);
        //     while($row = mysqli_fetch_assoc($select_img)){
        //         $post_img = $row['post_image'];
        //     }
        // }


        if(!empty($_POST['user_password'])){

            $hashed_password = password_hash($user_password,PASSWORD_BCRYPT,['option' => 10]);

            // QUERY
            $query = "UPDATE users SET ";
            $query .= "user_firstname = '$user_firstname', ";
            $query .= "user_lastname = '$user_lastname', ";
            $query .= "username = '$username', ";
            $query .= "user_email = '$user_email', ";
            $query .= "user_password = '$hashed_password' ";
            $query .= "WHERE user_id = $the_user_id ";

            $edit_user_query = mysqli_query($connection,$query);

            confirmQuery($edit_user_query);
            echo "<div class='alert alert-success'>
                    User Edited With Password<strong> Successfully</strong>
                    <a href='users.php'>Edit more user</a>
                </div>";
        }else{
            $query = "UPDATE users SET ";
            $query .= "user_firstname = '$user_firstname', ";
            $query .= "user_lastname = '$user_lastname', ";
            $query .= "username = '$username', ";
            $query .= "user_email = '$user_email', ";
            $query .= "user_password = '$db_user_password' ";
            $query .= "WHERE user_id = $the_user_id ";

            $edit_user_query = mysqli_query($connection,$query);

            confirmQuery($edit_user_query);
            echo "<div class='alert alert-success'>
                    User Edited<strong> Successfully</strong>
                    <a href='users.php'>Edit more user</a>
                </div>";
        }


    }

}



function count_rows($table_name){
  global $connection;

  $sql = "SELECT * FROM  $table_name ";
  $result = mysqli_query($connection,$sql);

  confirmQuery($result);

  return $count = mysqli_num_rows($result);

}

function count_rows_with_status($table,$column,$status){
  global $connection;
  $query = "SELECT * FROM $table WHERE $column = '$status'";
  $result = mysqli_query($connection,$query);
  confirmQuery($result);
  return mysqli_num_rows($result);
}

function is_admin($username) {

    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $row = mysqli_fetch_array($result);


    if($row['user_role'] == 'admin'){

        return true;

    }else {


        return false;
    }

}


//D32&b=<$Lf%a/pc@
function username_exist($username){
  global $connection;
  $sql = "SELECT username FROM users WHERE username = '$username' ";
  $send = mysqli_query($connection,$sql);
  $user_exist = mysqli_num_rows($send);
  if($user_exist > 0){
      return true;
  }else{
    return false;
  }
}

function email_exist($email){
  global $connection;
  $sql = "SELECT user_email FROM users WHERE user_email = '$email' ";
  $result = mysqli_query($connection,$sql);
  $count = mysqli_num_rows($result);
  if ($count > 0) {
    return true;
  }else {
    false;
  }
}


function register_user($username,$email,$password) {
      global $connection;

      $username = trim($username);
      $email = trim($email);
      $password = trim($password);

      $username = mysqli_real_escape_string($connection,$username);
      $email = mysqli_real_escape_string($connection,$email);
      $password = mysqli_real_escape_string($connection,$password);


      $encrypt_password = password_hash($password,PASSWORD_BCRYPT,['cost' => 10]);

      $insert_query = "INSERT INTO users(username,user_email,user_password,user_role) VALUES('$username','$email','$encrypt_password','subscriber') ";

      $insert_to_db = mysqli_query($connection,$insert_query);

      login_user($username, $password);

}

function login_user($username, $password){
  global $connection;

    $username = trim($username);
    $password = trim($password);

  	$username = mysqli_real_escape_string($connection,$username);
  	$password = mysqli_real_escape_string($connection,$password);


  	$query  = "SELECT * FROM users WHERE username = '$username' ";

  	$select_user_query = mysqli_query($connection,$query);
    confirmQuery($select_user_query);
  	while ($row = mysqli_fetch_assoc($select_user_query)) {
  		$db_user_id = $row['user_id'];
  		$db_user_firstname = $row['user_firstname'];
  		$db_user_lastname = $row['user_lastname'];
  		$db_username = $row['username'];
  		$db_user_email = $row['user_email'];
  		$db_user_password = $row['user_password'];
  		$db_user_role = $row['user_role'];
  	}

  	if (password_verify($password,$db_user_password)) {
  		$_SESSION['firstname'] = $db_user_firstname;
  		$_SESSION['lastname'] = $db_user_lastname;
  		$_SESSION['username'] = $db_username;
  		$_SESSION['user_email'] = $db_user_email;
  		$_SESSION['password'] = $db_user_password;
  		$_SESSION['user_role'] = $db_user_role;

      // echo "LOGIN";
      redirect("/cms/admin/index");

    }else{
      // echo " NOT LOGIN";

  		$msg = "Incorrect username Password!";
    }
}
?>
