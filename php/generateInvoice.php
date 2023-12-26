<?php
//include connection file 
include "dbconnect.php";
include_once('../fpdf186/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{   
    $this->SetFont('Arial','',70);
    $this->Cell(0, 40, 'INVOICE ', 0, 0, 'L');
    // Logo
    $this->Image('../logo/brlogo2.png',140,5,70,50);
    $this->SetFont('Arial','B',10);
    // Line break
    $this->Ln(40);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',13);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    
}
}

$pdf = new PDF();
$pdf->AliasNbPages();

$cid = $_POST['mem_num'];



$query1= "SELECT Address, FirstName, LastName  from customers c JOIN sales s ON c.MembershipNumber = s.CustomerMemNum where s.CustomerMemNum='$cid' ";
$result=mysqli_query($conn, $query1);

$result->num_rows;

if($result->num_rows <= 0) {

    $param = "<p style='color: Red;'> No Record found for <i>'$cid'</i> </p>";

    $encodedData = urlencode($param);

    header("Location: ../user_services.php?data=$encodedData");
    exit();

}

    $customerinfo=mysqli_fetch_assoc($result);
    $pdf->AddPage();
    $pdf->SetFillColor(211, 211, 211);
    $pdf->Cell(0, 10, 'Invoice Number ' , 0, 0, 'L');
    $pdf->SetX(-140);
    $pdf->Cell(0, 10, 'Date Of Issue ', 0, 1, 'L');
    $pdf->Ln(-1);
    $pdf->Cell(12, 8, '2031 ' , 0, 0, 'L','true');
    $pdf->SetX(-140);
    $pdf->Cell(25, 8, date('Y-m-d') , 0, 1, 'L','true');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Billed To ' , 0, 0, 'L');
    $pdf->SetX(-140);
    $pdf->Cell(0, 10, 'BUILDORAMA Ltd.', 0, 1, 'L');
    $pdf->Ln(-1);
    $pdf->Cell(35, 8, $customerinfo['FirstName'].' '.$customerinfo['LastName'] , 0, 0, 'L','true');
    $pdf->SetX(-140);
    $pdf->Cell(65, 8, '35 Cherrycrust Dr Brampton' , 0, 1, 'L','true');
    $pdf->Ln(-1);
    $pdf->Cell(55, 8, $customerinfo['Address'] , 0, 0, 'L','true');
    $pdf->SetX(-140);
    $pdf->Cell(65, 8, '647-899-0000' , 0, 1, 'L','true');
    $pdf->SetX(-140);
    $pdf->Cell(65, 8, 'buildorama@hotmail.com' , 0, 1, 'L','true');
    $pdf->Ln(20);
    $pdf->Cell(80, 10, 'Description', 0, 0, 'L');
    $pdf->Cell(40, 10, 'Unit cost', 0, 0, 'L');
    $pdf->Cell(40, 10, 'Qty', 0, 0, 'L');
    $pdf->Cell(40, 10, 'Amount', 0, 1, 'L');
    $pdf->SetX(-135);
    $pdf->Cell(50, 10, '________________________________________________________________________________________', 0,1,'C');
     // fetching information from the database
    $query2 = "SELECT ProductName , Price, Quantity, TotalAmount from  products p JOIN sales s ON p.ProductID = s.ProductID WHERE CustomerMemNum='$cid'" ;
    $productinfo = mysqli_query($conn, $query2);
    
    if ($productinfo) {
        $sTotal=0;
        
        // showing information in the PDF
        while ($row = mysqli_fetch_assoc($productinfo)) {
            $pdf->Cell(80, 10, $row['ProductName'], 0,0,'L',true);
            $pdf->Cell(40, 10, $row['Price'], 0,0,'L',true);
            $pdf->Cell(40, 10, $row['Quantity'], 0,0,'L',true);
            $pdf->Cell(20, 10, $row['TotalAmount'], 0,1,'L',true);
            $pdf->Ln(2);
            $sTotal=$sTotal+$row['TotalAmount'];
        }
        $discount=0.1*$sTotal;
        $tax=($sTotal-$discount)*0.2;
        $invoiceTotal=$sTotal-$discount+$tax;
        
        
    }
    else {
        echo "Query failed: " . mysqli_error($conn);
    }
    
    $pdf->SetX(-135);
    $pdf->Cell(50, 10, '________________________________________________________________________________________', 0,1,'C');
    $pdf->SetX(-75);
    $pdf->Cell(40, 10, 'Sub Total', 0, 0, 'C');
    $pdf->SetX(-40);
    $pdf->Cell(18, 10,'$'. number_format($sTotal, 2), 0, 1, 'C',true);
    $pdf->Ln(1);
    $pdf->SetX(-75);
    $pdf->Cell(40, 10, 'Discount', 0, 0, 'C');
    $pdf->SetX(-40);
    $pdf->Cell(18, 10, '$'. number_format($discount, 2), 0, 1, 'C',true);
    $pdf->Ln(1);

    $pdf->SetX(-75);
    $pdf->Cell(40, 10, '(Tax Rate)', 0, 0, 'C');
    $pdf->SetX(-40);
    $pdf->Cell(18, 10, '20%', 0, 1, 'C',true);
    $pdf->Ln(1);

    $pdf->SetX(-75);
    $pdf->Cell(40, 10, 'Tax', 0, 0, 'C');
    $pdf->SetX(-40);
    $pdf->Cell(18, 10, '$'.number_format($tax,2), 0, 1, 'C',true);
    $pdf->Ln(8);
    $pdf->SetX(-110);
    $pdf->SetFillColor(222, 184, 135);
    $pdf->Cell(40, 13, 'Invoice Total', 0, 0, 'C',true);
    $pdf->SetFont('Arial','B',30);
    $pdf->Cell(50, 13, '$'.number_format($invoiceTotal,2), 0, 1, 'C',true);
    $pdf->Ln(8);
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(40, 8, 'Terms', 0, 1, 'L');
    // $pdf->SetX(10);
    $pdf->Cell(100, 10, 'Please Pay invoice within 2 weeks', 0, 1, 'L',true);

$pdf->Output();
?>
