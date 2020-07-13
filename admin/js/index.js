$(document).ready(function(){

    
    //Checked all the rows
      $('#selectAllBoxes').click(function(event){
          if (this.checked) { 
              $('.checkBoxes').each(function(){
                  this.checked = true;
              });
          }else{
             $('.checkBoxes').each(function(){
                  this.checked = false;
              });
          }
      });
    
    
    
    
    

      // Screen loading         
      var div = "<div id='load-screen'><div id='loading'></div></div>";
      $('body').prepend(div);
      $('#load-screen').delay(200).fadeOut(300,function(){
          $(this).remove();
      });
    
    
          
      


    //users online 
    function loadUsersOnline() { 

        $.get("functions.php?onlineusers=result",function(data){

            $(".usersonline").text(data);    
            console.log(data);

        });

    }


    setInterval(function(){

        loadUsersOnline();

    },1000);
    
    
    
    
    
    
    
    
    
    
    
    
    
});// Ending document ready function