<?php
ob_start();

if(isset($_POST['delete-submit'])){ //delete reservation
    require 'dbh.php';

    $reservation_id = $_POST['reserv_id'];

    $sql = "DELETE FROM reservation WHERE reserv_id ='$reservation_id'";
    if(mysqli_query($conn, $sql)){
        header("Location: ../view_reservation.php?delete=success");
    }
    else{
        header("Location: ../view_reservation.php?delete=error");
    }
}

if(isset($_POST['delete-ticket'])){ //delete tickets
    require 'dbh.php';

    $tickets_id = $_POST['tickets_id'];

    $sql = "DELETE FROM tickets WHERE tickets_id = '$tickets_id'";
    if(mysqli_query($conn, $sql)){
        header("Location: ../view_tickets.php?delete=success");
    }
    else{
        header("Location: ../view_tickets.php?delete=error");
    }

}
mysqli_close($conn);
?>