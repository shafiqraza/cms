<?php include "admin/functions.php"; ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>


    <?php


if($_SERVER['REQUEST_METHOD'] == "POST"){

        $username  = $_POST['username'];
        $email    = $_POST['email'];
        $password = $_POST['password'];

        $errors = [
          'username' => '',
          'email' => '',
          'password' => ''
        ];

        if (strlen($username) < 4) {

          $errors['username'] = "<ul><li style='color:red;'>Username needs to be longer.</li></ul>";

        }
        if (empty($username)) {

          $errors['username'] = "<ul><li style='color:red;'>Username can not be empty.</li></ul>";

        }
        if (username_exist($username)) {

          $errors['username'] = "<ul><li style='color:red;'>Username is already exists.</li></ul>";

        }

        if (empty($email)) {

          $errors['email'] = "<ul><li style='color:red;'>Email can not be empty.</li></ul>";

        }
        if (email_exist($email)) {

          $errors['email'] = "<ul><li style='color:red;'>Email is already exists</li></ul>";

        }

        if (empty($password)) {

          $errors['password'] = "<ul><li style='color:red;'>Password can not be empty.</li></ul>";

        }

        foreach ($errors as $key => $value) {

          if (empty($value)) {

            unset($errors[$key]);

          }

        } // foreach loop ends

        if (empty($errors)) {

          register_user($username,$email,$password);

        }
    }

    ?>



    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <?php echo isset($errors['username']) ? $errors['username'] : ''?>
                            <input type='text' name='username' id='username' class='form-control' placeholder='Enter Desired Username' autocomplete='on' value='<?php echo isset($username) ? $username : ''; ?>'>
                        </div>
                         <div class='form-group'>
                            <label for='email' class='sr-only'>Email</label>
                            <?php echo isset($errors['email']) ? $errors['email'] : ''?>
                            <input   type='email' name='email' id='email' class='form-control' placeholder='somebody@example.com' autocomplete='on'value='<?php echo isset($email) ? $email : ''; ?>'>
                        </div>
                         <div class='form-group'>
                            <label for='password' class='sr-only'>Password</label>
                            <?php echo isset($errors['password']) ? $errors['password'] : ''?>
                            <input   type='password' name='password' id='key' class='form-control' placeholder='Password'>
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>
<?php include "includes/footer.php";?>
