<?php
//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 011 for TCPDF class
//               Colored Table (very simple table)
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+
// echo "<pre>";
// print_r( $data);
// echo "</pre>";
require_once "../../tcpdf/tcpdf.php";

try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->query('
    SELECT CardNumber,
    branches.Name AS Branch,
    userlevels.UserLevelName,
    employees.Name,
    employees.Address,
    employees.ContactNumber,
    employees.BirthDate,
    employees.Username 
    FROM employees 
    JOIN branches ON
    employees.BranchId = branches.BranchId
    JOIN userlevels ON
    employees.UserLevelId = userlevels.UserLevelid
    WHERE CardNumber LIKE "C%"
    ');
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
} catch (PDOException $th) {
    echo $th->getMessage();
}



// $pdf = new TCPDF();


// create new PDF document
$pdf = new TCPDF();

// set document information
$pdf->SetCreator('mark');
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 011');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
$pdf->setFooterData(array(0, 0, 0), array(255, 255, 255));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// // ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('courierB', '', 14, '', true);

$pdf->AddPage('L', 'A3');

ini_set('memory_limit', '640M');

$html = "
            <div class=\"container-fluid\">
   
                <h1>Media Management System - Customer Master List</h1>
            </div>";



$html .= "  <table cellspacing=\"0\" cellpadding=\"1\" border=\"1\" style=\"border-color:gray;\">
            <tr style=\"background-color:#414141;color:white;\">
                <td style=\"text-align:center\">Card Number</td>
                <td style=\"text-align:center\">Branch</td>
                <td style=\"text-align:center\">Type</td>
                <td style=\"text-align:center\">Name</td>
                <td style=\"text-align:center\">Address</td>
                <td style=\"text-align:center\">Contact No.</td>
                <td style=\"text-align:center\">Birth Date</td>
                <td style=\"text-align:center\">Username</td>
            </tr>
        ";
foreach ($getstmt as $key => $val) {
    $html .= 
    "
    <tr>
    <td style=\"text-align:center\">{$val['CardNumber']}</td>    
    <td style=\"text-align:center\">{$val['Branch']}</td>  
    <td style=\"text-align:center\">{$val['UserLevelName']}</td> 
    <td style=\"text-align:center\">{$val['Name']}</td>  
    <td style=\"text-align:center\">{$val['Address']}</td>  
    <td style=\"text-align:center\">{$val['ContactNumber']}</td>  
    <td style=\"text-align:center\">{$val['BirthDate']}</td>  
    <td style=\"text-align:center\">{$val['Username']}</td>  





    </tr>
    ";
}

$html .= "</table>";


// $dats = count($getstmt);

// $cnt = 1;
// foreach($getstmt as $key => $val)
// {
// $html .= "  <tr>
// {$val->Title}
//             <td style=\"text-align:center\">{$cnt}</td>
//             <td style=\"text-align:center\">{$val['Title']}</td>
//             <td style=\"text-align:center\">{$val['TOTAL']}</td>
//             </tr>";
//     $cnt=$cnt+1;
// }
// $html .= "</table>";



// // data loading
// $data = $pdf->LoadData('data/table_data_demo.txt');

// // print colored table
// $pdf->ColoredTable($header, $data);

// // ---------------------------------------------------------

// // close and output PDF document
// $pdf->Output('example_011.pdf', 'I');

$pdf->writeHTML($html, true, false, true, false, '');
ob_end_clean();
$pdf->Output('example.pdf', 'I');

// //============================================================+
// // END OF FILE
// //============================================================+
