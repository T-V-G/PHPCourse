<?php
require "header.php";
?>

<br<br>
<div class = "container">
    <h1 class="fw-light text-center text-lg-start mt-4 mb-0"><br>Edit Tickets</h1><br>
    <div class="col-md-6 offset-md-3">

<?php
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role'] == 2){
            echo '<p class="text-white bg-dark text-center">Set the nubmer of tickets for a specific date</p><br>';

            if(isset($_GET['error4'])){
                if($_GET['error4'] == "sqlerror1") {   
                    echo '<h5 class="bg-danger text-center">Error</h5>';
                }
                if($_GET['error4'] == "emptyfields") {  
                    echo '<h5 class="bg-danger text-center">Error, Empty fields</h5>';
                }
                }
                if(isset($_GET['tickets'])){
                if($_GET['tickets'] == "success") {   
                    echo '<h5 class="bg-success text-center">Tickets was successfully submited</h5>';
                }
                }
                echo'
                <div class="signup-form">
                  <form action="func/tickets.func.php" method="post">
                     <div class="form-group">
                         <label>Enter Date</label>
        	             <input type="date" class="form-control" name="date_tickets" placeholder="Date">
                     </div>
                     <div class="form-group">
                         <label>Number of tickets</label>
                         <input type="number" class="form-control" min="1" name="num_ticket" required="required">
                     </div>
                     <div class="form-group">
                         <button type="submit" name="tickets" class="btn btn-dark btn-lg btn-block">Submit Tickets</button>
                     </div>
                 </form>
                    <br><br>
                </div> ';
        }

    }
    else{
        echo '<p class="text-center"><br>You are have no permission!<br><br></p>';
    }

?>
    </div>
</div>
<br><br>