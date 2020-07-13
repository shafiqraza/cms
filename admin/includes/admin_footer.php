</div>
    <!-- /#wrapper -->

    
    

 <!-- ck EDITOR CDN-->
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>      
<script type="text/javascript" src="js/script.js"></script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">
      


    </script>
    
    

    




    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="./js/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

          <?php 

          $element_text = ['All Posts','Active Posts','Draft Posts','comments','Pending Comments' ,'users','Subscriber', 'categories'];
          $element_count = [$posts_count,$published_posts_count,$draft_posts_count, $comments_count,$unapproved_comments_count, $users_count, $subsriber_count, $categories_count];
          for($i = 0; $i < 7; $i++){
          	echo "['$element_text[$i]'" . "," . "$element_count[$i] ],";
          }

          ?>
          // ['Posts', 1000]
          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    
    <script src="js/index.js"></script>
	




 

</body>

</html>
