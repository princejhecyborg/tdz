<?php
require_once(realpath(APPPATH ."../plugins/fpdf/break_line_fpdf.php"));
ini_set("memory_limit","512M");
set_time_limit(900000);
error_reporting(0);


$pdf = new PDF_Break_Line("L");


$width = array(60, 60, 60, 60);

$pdf->lineBreak = 0;
$pdf->widths = $width;
$pdf->headerTitle = (Object)array(
    (Object)array(
        'title' => array('Unassigned Job(s):',$count),
        'FontFamily' => 'Arial',
        'FontStyle' => 'B',
        'FontSizePt' => 14,
        'TextColor' => (Object)array(
                'r' => 0,
                'g' => 0,
                'b' => 0
            ),
        'FillColor' => (Object)array(
                'r' => 255,
                'g' => 255,
                'b' => 255
            ),
        'Fills' => array(0),
        'Widths' => $pdf->widths,
        'Aligns' => array('L')
    ),
    (Object)array(
        'title' => array('Date Received', 'Ref', 'Job Code', 'Job Name', 'Area'),
        'FontFamily' => 'Arial',
        'FontStyle' => '',
        'FontSizePt' => 10,
        'TextColor' => (Object)array(
                'r' => 255,
                'g' => 255,
                'b' => 255
            ),
        'FillColor' => (Object)array(
                'r' => 0,
                'g' => 0,
                'b' => 0
            ),
        'Fills' => array(1, 1, 1, 1, 1),
        'Widths' => $pdf->widths,
        'Aligns' => array('C', 'C', 'C', 'C', 'C'),
        'borderSize' => 1
    )
);

$pdf->AddPage();
$pdf->AliasNbPages();

//Table with 20 rows and 4 columns
srand(microtime()*1000000);

$pdf->SetFont('Helvetica', '', 9);

$max_y = 180;
if(count($unassigned) > 0){
    foreach($unassigned->result() as $v){
        if($pdf->GetY() > $max_y){
            $pdf->AddPage();
        }

        $pdf->SetFills(array(0, 0, 0, 0, 0));
        $pdf->aligns = array('C', 'C', 'C', 'C', 'C');
        $pdf->widths = $width;

        $row = array(
            $v->date,
            $v->client_ref,
            $v->job_code,
            $v->plan_name,
            $v->bh_area
        );
        $pdf->Row($row);
    }
}
else{
    $pdf->SetFills(array(0));
    $pdf->aligns = array('C');
    $pdf->widths = array(array_sum($pdf->widths));
    $row = array('No Result');
    $pdf->Row($row);
}
date_default_timezone_set('Pacific/Auckland');
$filename = "UnassignedJobs" . date('Ymd-Hi');
$pdf->Output($filename . ".pdf", "I");