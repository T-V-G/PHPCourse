<?php

if(isset($_SESSION['user_id'])){
    
    require 'dbh.php';
    
    $user = $_SESSION['user_id'];
    $role = $_SESSION['role'];
     
    //view reserved tickets by date 
    if($role==2){
        $sql = "SELECT SUM(num_tickets), rdate, time_zone FROM reservation GROUP BY rdate, time_zone";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
        
            echo
            '<div class="container">
                 <div class="row">
                 <div class="col-sm text-center">
                 <p class="text-white bg-dark text-center">Reserved tickets per date and time-zone</p><br>
                 <table class="table table-hover table-bordered table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time-Zone</th>
                        <th scope="col">Reserved Tickets</th>
                    </tr>
                </thead> ';
        while($row = $result->fetch_assoc()) {
        echo"
              <tbody>
                    <tr>
                      <th scope='row'>".$row["rdate"]."</th>
                      <td>".$row["time_zone"]."</td>
                      <td>".$row["SUM(num_tickets)"]."</td>
                    </tr>
              </tbody>";
            
        }
        echo "</table>";
    }
    else {    echo "<p class='text-center'>List is empty!<p>"; }      
    echo'</div>'; 
        
      
       
    //view total tickets per date that have been submitted from set from admin 
    $sql = "SELECT * FROM tickets ORDER BY t_date";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo'  
         <div class="col-sm text-center">
         <p class="text-white bg-dark text-center">Total tickets per date</p>
         <br>
        ';
        echo
        '
            <table class="table table-hover table-bordered table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Total tickets</th>
                    </tr>
                </thead> ';
        while($row = $result->fetch_assoc()) {
        echo"
                <tbody>
                    <tr>
                    <form action='func/delete.php' method='POST'>
                    <input name='tickets_id' type='hidden' value=".$row["tickets_id"].">
                      <th scope='row'>".$row["t_date"]."</th>
                      <td>".$row["t_tickets"]."</td>
                      <td class='table-danger'><button type='submit' name='delete-ticket' class='btn btn-danger btn-sm'>Delete</button></td>
                          </form>
                    </tr>
              </tbody>";
            
        }   
        echo "</table>";
    }
  
}  
mysqli_close($conn);
}
?>