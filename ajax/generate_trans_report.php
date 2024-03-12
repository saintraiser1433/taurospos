<?php

include '../connection.php';
include_once("../dist/libs/phpjasperxml/PHPJasperXML.inc.php");
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $itemType = $_POST['itemType'];
    
    $PHPJasperXML = new PHPJasperXML();
    $PHPJasperXML->arrayParameter = array('status' => $itemType, 'fromdate' => $fromdate, 'todate' => $todate);
    $PHPJasperXML->load_xml_file("../reports/transaction_report.jrxml");
    $PHPJasperXML->transferDBtoArray("localhost", "root", "", "borrows");
    $PHPJasperXML->outpage("F", "../reports/outputs/transaction.pdf");
} 
