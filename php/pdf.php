<?php
session_start();
if ($_SESSION['type'] !== "admin") {
  header("Location: ../index.php");
} else {
include_once("../php/connection.php");
include_once("../lib/fpdf.php");
if ($_GET["toprint"] == 'users' ) {
  class PDF extends FPDF
  {
    function Footer ()
    {
      $this->SetY(-10);
      $this->SetFont('Arial','I',10);
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
  }
  //$pdf=new PDF();
  $pdf=new FPDF('L','mm','A4');
  $pdf->AddPage();
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(46,5,"Nick");
  $pdf->Cell(46,5,"Email");
  $pdf->Cell(46,5,"Address");
  $pdf->Cell(46,5,"Type");
  $pdf->Cell(46,5,"Name");
  $pdf->Cell(46,5,"Surname");
  $pdf->ln();
  if($result= $connection->query("SELECT * FROM users")) {
    while ($obj = $result -> fetch_object()) {
      $pdf->Cell(46,5,$obj->nick,1,0,'C');
      $pdf->Cell(46,5,$obj->email,1,0,'C');
      $pdf->Cell(46,5,$obj->address,1,0,'C');
      $pdf->Cell(46,5,$obj->type,1,0,'C');
      $pdf->Cell(46,5,$obj->name,1,0,'C');
      $pdf->Cell(46,5,$obj->surname,1,0,'C');
      $pdf->ln();
    }
  }
  $pdf->output();
  }
  if ($_GET["toprint"] == 'products' ) {
    class PDF extends FPDF
    {
      function Footer ()
      {
        $this->SetY(-10);
        $this->SetFont('Arial','I',10);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }
    }
    //$pdf=new PDF();
    $pdf=new FPDF('L','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(46,5,"Name");
    $pdf->Cell(46,5,"Value");
    $pdf->Cell(46,5,"Chassis");
    $pdf->Cell(46,5,"Traction");
    $pdf->Cell(46,5,"Transmission");
    $pdf->Cell(46,5,"Engine");
    $pdf->ln();
    if($result= $connection->query("SELECT * FROM item")) {
      while ($obj = $result -> fetch_object()) {
        $pdf->Cell(46,5,$obj->name,1,0,'C');
        $pdf->Cell(46,5,$obj->value,1,0,'C');
        $pdf->Cell(46,5,$obj->chassis,1,0,'C');
        $pdf->Cell(46,5,$obj->traction,1,0,'C');
        $pdf->Cell(46,5,utf8_decode($obj->transmission),1,0,'C');
        $pdf->Cell(46,5,utf8_decode($obj->type),1,0,'C');
        $pdf->ln();
      }
    }
    $pdf->output();
  }
}

 ?>
