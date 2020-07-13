<?php


$password = '123';
$option = ['cost' => 12];
$hashed_password = password_hash($password,PASSWORD_BCRYPT,$option);
echo $hashed_password;



if(password_verify($password,$hashed_password)){
    echo "Passwords Matched";
}
echo "<br><br>";

echo $page = $_SERVER['PHP_SELF'];

 ?>
