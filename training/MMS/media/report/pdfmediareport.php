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
$data = json_decode(file_get_contents('php://input'), true);
$data = json_decode($_REQUEST["infoData"], true);
// echo "<pre>";
// print_r( $data);
// echo "</pre>";
require_once "../../../tcpdf/tcpdf.php";

try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo ->prepare('
    SELECT medias.Title, COUNT(recordsdetails.MediaId) AS TOTAL FROM recordsdetails
    JOIN medias ON
    recordsdetails.MediaId = medias.MediaId
    WHERE DateIssued BETWEEN :f AND :t
    GROUP BY medias.Title 
    ORDER BY COUNT(recordsdetails.MediaId) DESC
    ');
    $stmt->bindValue(':f',$data['datefrom'],PDO::PARAM_STR);
    $stmt->bindValue(':t',$data['dateto'],PDO::PARAM_STR);
    $stmt->execute();
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
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
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
   
                <h1>Media Management System - Media Report</h1>
                <h3>FROM:". $data['datefrom'] ." TO:". $data['dateto'] ."<h3>
            </div>";
$html .= "  <table cellspacing=\"0\" cellpadding=\"1\" border=\"1\" style=\"border-color:gray;\">
                <tr style=\"background-color:#414141;color:white;\">
                    <td style=\"text-align:center\">Top</td>
                    <td style=\"text-align:center\">Title</td>
                    <td style=\"text-align:center\">Total In and Out</td>
                </tr>
            ";
$dats = count($getstmt);
// for ($i = 1; $i <= $dats; $i++){
// $html .= '  <tr>
//             <td>'.  intval($key).'</td>
//             </tr>';
//         }
$cnt = 1;
foreach($getstmt as $key => $val)
{
$html .= "  <tr>

            <td style=\"text-align:center\">{$cnt}</td>
            <td style=\"text-align:center\">{$val['Title']}</td>
            <td style=\"text-align:center\">{$val['TOTAL']}</td>
            </tr>";
    $cnt=$cnt+1;
}
$html .= "</table>";
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
