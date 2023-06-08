<?php

if(isset($_SESSION['user_id'])){
    
    require 'dbh.php';

    $user = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    
    //user's role
    if($role==1){
    $sql = "SELECT * FROM reservation WHERE user_fk = $user";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo
        '
            <table class="table table-hover table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Tickets</th>
                        <th scope="col">Reservation Date</th>
                        <th scope="col">Time Zone</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Comments</th>
                    </tr>
                </thead> ';
        while($row = $result->fetch_assoc()) {
        echo"
                <tbody>
                    <tr>
                    <form action='func/delete.php' method='POST'>
                    <input name='reserv_id' type='hidden' value=".$row["reserv_id"].">
                      <th scope='row'>".$row["f_name"]." ".$row["l_name"]."</th>
                      <td>".$row["num_tickets"]."</td>
                      <td>".$row["rdate"]."</td>
                      <td>".$row["time_zone"]."</td>
                      <td>".$row["telephone"]."</td>
                      <td>".$row["reg_date"]."</td>
                      <td><textarea readonly>".$row["comment"]."</textarea></td>
                      <td class='table-danger'><button type='submit' name='delete-submit' class='btn btn-danger btn-sm'>Cancel</button></td>
                          </form>
                    </tr>
              </tbody>";
        }   
        echo "</table>";
    }
    else {    echo "<p class='text-white text-center bg-danger'>Your reservation list is empty!<p>"; }
    }
    
    //admin's role
    else if($role==2){
    $sql = "SELECT * FROM reservation";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo
        '
            <table class="table table-hover table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Tickets</th>
                        <th scope="col">Reservation Date</th>
                        <th scope="col">Time Zone</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Comments</th>
                    </tr>
                </thead> ';
        while($row = $result->fetch_assoc()) {
        echo"
                <tbody>
                    <tr>
                    <form action='func/delete.php' method='POST'>
                      <input name='reserv_id' type='hidden' value=".$row["reserv_id"].">
                      <th scope='row'>".$row["reserv_id"]."</th> 
                      <td>".$row["f_name"]." ".$row["l_name"]."</td>
                      <td>".$row["num_tickets"]."</td>
                      <td>".$row["rdate"]."</td>
                      <td>".$row["time_zone"]."</td>
                      <td>".$row["telephone"]."</td>
                      <td>".$row["reg_date"]."</td>
                      <td><textarea readonly>".$row["comment"]."</textarea></td>
                      <td class='table-danger'><button type='submit' name='delete-submit' class='btn btn-danger btn-sm'>Cancel</button></td>
                          </form>
                    </tr>
              </tbody>";
            
        }   
        echo "</table>";
    }
    else {    echo "<p class='text-white text-center bg-danger'>Your reservation list is empty!<p><br/>"; }
}
mysqli_close($conn);
}
?>
