<?php
ob_start();
session_start();

//checks if the characters are within the  set limits
function between($val, $x, $y){
    $val_len = strlen($val);
    return ($val_len >= $x && $val_len <= $y)?TRUE:FALSE;
}

if(isset($_POST['reserv-submit'])) {

require 'dbh.php';

    $user= $_SESSION['user_id'];
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $date= $_POST['date'];
    $time= $_POST['time'];
    $numtickets= $_POST['num_tickets'];
    $tele = $_POST['tele'];
    $comments = $_POST['comments'];
    $a_tickets = 0;
    
    if(empty($fname) || empty($lname) || empty($date) || empty($time) || empty($numtickets) || empty($tele)) {
        header("Location: ../reserv.php?error3=emptyfields");
        exit();
    }
        else if(!preg_match("/^[a-zA-Z ]*$/", $fname) || !between($fname,2,20)) {
        header("Location: ../reserv.php?error3=invalidfname");
        exit();
    }
        else if(!preg_match("/^[a-zA-Z ]*$/", $lname) || !between($lname,2,40)) {
        header("Location: ../reserv.php?error3=invalidlname");
        exit();
    }
        else if(!preg_match("/^[0-9]*$/", $numtickets) || !between($numtickets,1,3)) {
        header("Location: ../reserv.php?error3=invalitickets");
        exit();
    }
        else if(!preg_match("/^[a-zA-Z0-9]*$/", $tele) || !between($tele,6,20)) {
        header("Location: ../reserv.php?error3=invalidtele");
        exit();
    }    
        else if(!preg_match("/^[a-zA-Z 0-9]*$/", $comments) || !between($comment,0,200)) {
        header("Location: ../reserv.php?error3=invalidcomment");
        exit();
    }
    else{
    $sql = "SELECT t_tickets FROM tickets WHERE t_date='$date'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $a_tickets=$row["t_tickets"];
        }
    }
        
    $sql = "SELECT SUM(num_tickets) FROM reservation WHERE rdate='$date' AND time_zone='$time'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $current_tickets=$row["SUM(num_tickets)"];
        }
    }
    if($current_tickets + $numtickets > $a_tickets){
        header("Location: ../reserv.php?error3=full");
    }
    else {
            $sql = "INSERT INTO reservation(f_name, l_name, num_tickets, rdate, time_zone, telephone, comment, user_fk) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
                 if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../reserv.php?error3=sqlerror1");
                    exit();
                }
                else {       
                    mysqli_stmt_bind_param($stmt, "ssssssss", $fname, $lname, $numtickets, $date, $time, $tele, $comments, $user);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../reserv.php?reservation=success");
                    exit();
                }
        }
    }
    
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
}
?>

