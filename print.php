<?php
require('tcpdf/tcpdf.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $studentName = isset($_POST['studentName']) ? $_POST['studentName'] : '';
    $regNo = isset($_POST['regNo']) ? $_POST['regNo'] : '';
    $Year = isset($_POST['Year']) ? $_POST['Year'] : '';
    $Department = isset($_POST['Department']) ? $_POST['Department'] : ''; // Corrected variable name
    $Section = isset($_POST['Section']) ? $_POST['Section'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : ''; // Removed extra space
    $date1 = isset($_POST['date1']) ? $_POST['date1'] : ''; 
    $reason = isset($_POST['reason']) ? $_POST['reason'] : '';
    $Location = isset($_POST['Location']) ? $_POST['Location'] : '';

    // Create PDF
    
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', true);
    $pdf->SetTitle('ON DUTY LETTER');
    $pdf->AddPage();

    $pdf->SetFont('times', '', 16);
    $html='<div style="text-align:center;"><h1>ON DUTY LETTER</h1></div>';
    $pdf->writeHTML($html,true,false,false,false,'');
   
    $pdf->writeHTML
    ("
    <style>
    *{
      text-align: left;
    }
    </style>
    <p>
    $studentName ($regNo) <br>
    $Year year $Department-$Section section<br>
    Adhiyamaan college of engineering(autonomous)<br>
    Hosur-635109 </p>

    <p>  $date1</p>

   <P> Head of the department<br>
 Department of CSE<br>
 Adhiyamaan College of Engineering(Autonomous)<br>
 Hosur-635109</p>

<p><b>RESPECTED MADAM/SIR,</b><br></p>
<b>Sub:</b> Requesting for On-duty</p> 


<p>As I am going to participate in <b>$reason</b> which is going to held on  <b>$date</b> <br> at <b>$Location</b> .So please kindly provide for on <b>$date</b>.Do kindly oblige.<br>
<br>Thanking you,<br><br>
<b>Yours faithfully</b><br>
$studentName
</p>


    ");
   
   $pdf->writeHTMLCell(0, '', '', '', ' ', 0, 1, false, true, 'L');

// Create a cell for "Tutor Sign" with 50% width
$pdf->Cell(0, 40, 'TUTOR SIGN:', 0, 0, 'L', 0, false, false, false, 'T');

// Set right alignment for "HOD Sign" cell (remaining 50% width)
$pdf->Cell(0, 40, 'HOD SIGN:', 0, 1, 'R', 0, false, false, false, 'T');





    // Output PDF
    $pdf->Output($studentName .'-'.'od.pdf', 'D');
} else {
    echo "Form submission error!";
}
?>
