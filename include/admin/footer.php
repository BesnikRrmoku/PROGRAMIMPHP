  <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
    
  <script type="text/javascript">
    $(function() {
      $(".delbutton").click(function(){
          
          var element = $(this);
          
          var del_id = element.attr("id");
          
          var info = 'id=' + del_id;

          if(confirm("Deshironi ta fshini!")){
              $.ajax({
               type: "GET",
               url: "deleteprod.php",
               data: info,
               success: function(){}
          });
                 
          $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
        		                        .animate({ opacity: "hide" }, "slow");
          }

         return false;

      });
    });
  </script>

  <script src="js/script.js"></script>
</body>
</html>