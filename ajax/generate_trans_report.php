<?php

include '../connection.php';
include_once("../dist/libs/phpjasperxml/PHPJasperXML.inc.php");
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $itemType = @$_POST['itemType'];
    $action = $_POST['action'];

    if ($action == 'transaction') {
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->arrayParameter = array('status' => $itemType, 'fromdate' => $fromdate, 'todate' => $todate);
        $PHPJasperXML->load_xml_file("../reports/transaction_reports.jrxml");
        $PHPJasperXML->transferDBtoArray("localhost", "root", "", "borrows");
        $PHPJasperXML->outpage("F", "../reports/outputs/transaction.pdf");
    } else if ($action == 'penalties') {
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->arrayParameter = array('fromdate' => $fromdate, 'todate' => $todate);
        $PHPJasperXML->load_xml_file("../reports/penalties.jrxml");
        $PHPJasperXML->transferDBtoArray("localhost", "root", "", "borrows");
        $PHPJasperXML->outpage("F", "../reports/outputs/penalties.pdf");
    } else if ($action == 'stock') {
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->arrayParameter = array('fromdate' => $fromdate, 'todate' => $todate);
        $PHPJasperXML->load_xml_file("../reports/stockin.jrxml");
        $PHPJasperXML->transferDBtoArray("localhost", "root", "", "borrows");
        $PHPJasperXML->outpage("F", "../reports/outputs/stockin.pdf");
    } else if ($action == 'retirement') {
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->arrayParameter = array('fromdate' => $fromdate, 'todate' => $todate);
        $PHPJasperXML->load_xml_file("../reports/retirement.jrxml");
        $PHPJasperXML->transferDBtoArray("localhost", "root", "", "borrows");
        $PHPJasperXML->outpage("F", "../reports/outputs/retirement.pdf");
    }
}
