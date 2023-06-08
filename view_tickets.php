<?php
require "header.php";
?>

<br><br>
<div class="container">
    <h1 class="fw-light text-center text-lg-start mt-4 mb-0"><br>View Tickets</h1>

<?php
    if(isset($_SESSION['user_id'])){
        if(isset($_GET['delete'])){
            if($_GET['delete'] == "error"){
                echo '<h5 class="bg-danger text-center">Error!</h5>';
            }
            if($_GET['delete'] == "success"){ 
                echo '<h5 class="bg-success text-center">Delete was successfull</h5>';
            }
        }
        require 'func/view.tickets.php';
    }
    else{
        echo '<p class="text-center"><br>You are have no permission<br><br></p>';  
    }
?>
</div>
<br><br>