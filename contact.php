<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php  include "admin/functions.php"; ?>

    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>


<?php

// THis will not until you upload this project online.
if(isset($_POST['submit'])){


//    $to         = "shafiqraza503@gmail.com";
//    $header    = "From: " . escape($_POST['email']);
//    $subject    = escape($_POST['subject']);
//    $body       = escape($_POST['body']);
//
//
//   $mail_function = mail($to,$subject,$body,$header);
//
//    if($mail_function){
//
//        $message = "<div class='alert alert-success'>Your form has been submitted <strong>Successfully</strong></div>";
//
//    }else{
//
//    $message = "<div class='alert alert-danger'><strong>Fields cannot be empty!</strong></div>";
//
//    }
        


}

?>



    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>

                     <?php
                    if(isset($message)){
                        echo $message;
                    }
                    ?>


                    <form role="form" action="" method="post" id="login-form" autocomplete="off">

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>

                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
