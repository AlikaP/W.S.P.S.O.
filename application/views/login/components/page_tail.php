
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>   

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) 
    {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	
	<!--
    <script language="javascript">
        function autoResizeDiv()
        {
            document.getElementById('main').style.height = window.innerHeight +'px';
        }
        window.onresize = autoResizeDiv;
        autoResizeDiv();
    </script>
	-->

    <!-- (Datepicker) -->
	<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>

	<script>
	$(function() 
	{
		$('.datepicker').datepicker({ format : 'dd-mm-yyyy' });
	});

	
	</script>

    <!-- jQuery generator šifre -->

    <script>
        $("#generate").click(function(){
          var charset = '1234567890'; //znakovi korišteni za lozinku
          var password = ''; 
          var password_length = 7;      //duljina lozinke

          for(var i = 0; i < password_length; i++)
          {
            var random_position = Math.floor(Math.random() * charset.length);
            password += charset[random_position];
          }
          if(password.length == password_length)
          {
            password = password.replace();
              $('#passwords').val(password); //treba zamijeniti   
          }
          else
          {
            console.log(password.length , password_length);
          }

        });

    </script>


    <script>
        function generatePassword() {
        var length = 8,
            charset = "abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;
        }
    </script>

</body>
</html>