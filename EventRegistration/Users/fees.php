<?php 
ob_start();
session_start();
require 'fpdf/fpdf.php';
require '../assets/db.php';
if($_SESSION['logged_in'] != 1) {
    $_SESSION['message'] = "Cannot Find Page";
    header("location: ../Login/error.php");
}
else if($_SESSION['usertype'] > 1) {
    $_SESSION['message'] = "Not authorised to view this page";
    header("location: ../Login/error.php");
} 
else {
    $pdf = new FPDF('P','mm',"A4");
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',14);
    $eventname = $_SESSION['eventname'];
    $eventid = $_SESSION['eventid'];

    $sql = "Select * from members where eventid =".$eventid;
    $result = $mysqli->query($sql);

    //Library Copy

    $pdf->Cell(189,8,$eventname." Entries",0,1,"C");
    $pdf->Cell(189,3,"",0,1);

    //Starting Library Details
    $pdf->Cell(15,7,"ID",1,0,"C"); 
    $pdf->Cell(60,7,"Name",1,0,"C");
    $pdf->Cell(30,7,"Mobile",1,0,"C");
    $pdf->Cell(85,7,"College",1,1,"C");

    $pdf->SetFont('Arial',"",10);

    //Start printing member details
    while($mem = $result->fetch_assoc()) {
        $pdf->Cell(15,6,$mem['memid'],1,0,"C");
        $pdf->Cell(60,6,$mem['fname']." ".$mem['lname'],1,0,"C");
        $pdf->Cell(30,6,$mem['mobile'],1,0,"C");
        $pdf->Cell(85,6,$mem['college'],1,1,"C");
    }

    $pdf->output($eventname." Entries.pdf",'I');
}
?>
<?php ob_end_flush(); ?>