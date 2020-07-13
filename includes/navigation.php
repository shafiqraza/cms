       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms/index">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php
                    $query = "SELECT * FROM categories";

                    $select_all_catagories_query = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_array($select_all_catagories_query)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];


                        // THIS IS FOR LINKS ON NAV
                        $category_class = "";
                        $registration_class = "";
                        $contact_class = "";
                        $page_name = basename($_SERVER['PHP_SELF']); // current active page url

                        if (isset($_GET['cat_id']) && $_GET['cat_id'] == $cat_id) {
                          $category_class = "active";
                        }elseif ($page_name == 'registration.php') {
                          $registration_class = "active";
                        }elseif ($page_name == 'contact.php') {
                          $contact_class = "active";
                        }elseif ($page_name == 'login.php') {
                          $login_class = "active";
                        }


                        echo "<li class='$category_class'><a href='/cms/category/$cat_id'>$cat_title</a></li>";
                    }
                ?>
                <li class="<?php echo $contact_class; ?>">
                    <a href="/cms/contact">Contact</a>
                </li>

                <?php if(isset($_SESSION['user_role'])): ?>

                  <li>
                      <a href="admin/">Admin</a>
                  </li>

                <?php else: ?>
                  <li class="<?php echo $registration_class; ?>">
                      <a href="/cms/registration">Registration</a>
                  </li>
                  <li class="<?php echo $login_class; ?>">
                      <a href="/cms/includes/login.php">Login</a>
                  </li>
                <?php endif; ?>



<!--
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
