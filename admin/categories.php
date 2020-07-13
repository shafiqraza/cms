<?php include "includes/admin_header.php"; ?>

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
                <small>Author</small>
            </h1>
        </div>
    </div> <!-- /.row -->

    <div class="row">
        <div class="col-xs-6">
            <?php add_category();  ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="">Add Category: </label>
                    <input type="text" class="form-control" name="cat_title">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                </div>
            </form>

            <!-- UPDATE FORM -->
            <?php 
            if(isset($_GET['edite'])){
                $cat_id = $_GET['edite'];
                include "includes/update_category.php";
            }
            ?>
        </div>
        <div class="col-xs-6">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Category Id</th>
                    <th>Category Title</th>
                </tr>
            </thead>
            <tbody>
                <?php findAllCategories(); ?>
                <?php deleteCategories(); ?>

            </tbody>
        </table>
        </div>
        </div>
            
    </div><!-- /.container-fluid -->

</div><!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>