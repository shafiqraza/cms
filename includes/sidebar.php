<div class="col-md-4">

                <?php



                ?>

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="/cms/search" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="=submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>

                    <!-- /.input-group -->
                </div>

                <!-- LOGIN FORM    -->
                <div class="well">
                  <?php if (isset($_SESSION['username'])): ?>
                    <h4>You are logged in as <strong> <?php echo $_SESSION['username']; ?></strong></h4>
                    <a href="includes/logout.php" class="btn btn-danger">Logout</a>
                  <?php else: ?>
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Enter password">
                        </div>
                        <button class="btn btn-primary" type="submit" name="login">Login</button>
                    </form>
                    <div class="mt-2" style="margin-top:15px;">
                      <a href="forgot.php?source=<?php echo uniqid(true); ?>">Forgot Password?</a>
                    </div>
                  <?php endif; ?>


                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            <?php

                            $query = "SELECT * FROM categories";
                            $result = mysqli_query($connection,$query);

                            while($row = mysqli_fetch_assoc(($result))){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                                echo "<li><a href='/cms/category/$cat_id'>$cat_title</a></li>";
                            }
                            ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->


                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
               <?php include"includes/widget.php";?>


        </div>
