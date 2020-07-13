<form action="" method="POST">
            <div class="form-group">
                <label for="">Update Category: </label>

                <?php
                if(isset($_GET["edite"])){
                    $cat_id =  $_GET["edite"];
                    $stmt = mysqli_prepare($connection,"SELECT cat_title FROM  categories WHERE cat_id = ?");
                    mysqli_stmt_bind_param($stmt,"i",$cat_id);
                     mysqli_stmt_execute($stmt);
                     mysqli_stmt_bind_result($stmt,$cat_title);
                    while(mysqli_stmt_fetch($stmt)){

                ?>
                <input type="text" class="form-control" name="cat_title" value="<?php if(isset($cat_title)) { echo $cat_title; }?> ">
                <?php
                    }
                }
                ?>

                <?php

                if(isset($_POST["update"])){
                    $cat_title = $_POST["cat_title"];
                    $stmt = mysqli_prepare($connection,"UPDATE categories SET cat_title = ? WHERE cat_id = ? ");
                    mysqli_stmt_bind_param($stmt,"si",$cat_title,$cat_id);
                    $result = mysqli_stmt_execute($stmt);
                    if(!$result){
                        die(mysqli_error($connection));
                    }
                    redirect("categories.php");
                }
                ?>

            </div>
            <div class="form-group">
                <input type="submit" name="update" class="btn btn-primary" value="Update Category">
            </div>
        </form>
