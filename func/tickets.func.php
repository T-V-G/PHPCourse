<?php
ob_start();

if(isset($_POST['tickets'])){
    
require 'dbh.php';
            
    $date= $_POST['date_tickets'];
    $tickets = $_POST['num_ticket'];
        
    if(empty($date) || empty($tickets)) {
        header("Location: ../ticket_edit.php?error4=emptyfields");
        exit();
    }
    else{
     $sql = "SELECT t_date FROM tickets WHERE t_date=?";
       $stmt = mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt, $sql)){
           header("Location: ../ticket_edit.php?error4=sqlerror1");
           exit();
       }
       else {
           mysqli_stmt_bind_param($stmt, "s", $date);     //check if the date is already written
           mysqli_stmt_execute($stmt);
           mysqli_stmt_store_result($stmt);
           $resultCheck = mysqli_stmt_num_rows($stmt);
             if($resultCheck != 0){
               $sql = "UPDATE tickets SET t_tickets=? WHERE t_date=?";
               $stmt = mysqli_stmt_init($conn);
                 if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../ticket_edit.php?error4=sqlerror1");
                    exit();
                }                   
                    mysqli_stmt_bind_param($stmt, "ss", $tickets, $date);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../ticket_edit.php?tickets=success");
                    exit();
           }
           else{
                $sql = "INSERT INTO tickets(t_date, t_tickets) VALUES(?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../ticket_edit.php?error4=sqlerror1");
                    exit();
                }                      
                    mysqli_stmt_bind_param($stmt, "ss", $date, $tickets);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../ticket_edit.php?tickets=success");
                    exit();
           }
       }
    }
   
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
}
?>