<?php
require "header.php";
?>
    
<br><br>
<div class="container">
<h1 class="fw-light text-center text-lg-start mt-4 mb-0"><br>View Reservations</h1><br>
<?php
    if(isset($_SESSION['user_id'])){
        echo '<p class="text-white bg-dark text-center">'. $_SESSION['username'] .', Here you can check your reservation history</p><br>';
    
    if(isset($_GET['delete'])){
        if($_GET['delete'] == "error") {  
            echo '<h5 class="bg-danger text-center">Error!</h5>';
        }
        if($_GET['delete'] == "success"){ 
            echo '<h5 class="bg-success text-center">Delete was successfull</h5>';
        }
    }  
    require 'func/view.reservation.php';
 }
    else {
        echo '	<p class="text-center text-danger"><br>You are currently not logged in!<br></p>
       <p class="text-center">In order to make a reservation you have to create an account!<br><br><p>';   
    }    
?>
</div>
<br><br>


