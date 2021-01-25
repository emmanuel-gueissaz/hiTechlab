<?php

include '../BDD/connexionBdd.php';

$requete = "select * from client where email = 'cli@cli'";
$requete = $conn->prepare($requete);
$requete->execute();
$ligne = $requete->fetch();
$email = $ligne['email'];
$nom = $ligne['nom'];

$requete = "select * from boutique";
$requete = $conn->prepare($requete);
$requete->execute();
$ligne = $requete->fetch();
$nomBoutique = $ligne['nom'];
$telBoutique = $ligne['tel'];
$emailBoutique = $ligne['email'];
$rueBoutique = $ligne['rue'];
$cpostBoutique = $ligne['cpost'];
$villeBoutique = $ligne['ville'];



require '../../pdfTest/fpdf.php';



$pdf = new FPDF();
$pdf->AddPage();


$pdf->Image('../image/logo.png', 130, -10, 70, 70);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(80, 30, 'Devis N 1', 0, 1, 'C');

$pdf->Cell(190, 0, '', 1, 1, 'C');
$pdf->Cell(50, 10, 'Entreprise :', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);


$pdf->Cell(50, 6, $nomBoutique, 0, 1, 'L');

$pdf->Cell(50, 6, $telBoutique, 0, 1, 'L');
$pdf->Cell(50, 6, $emailBoutique, 0, 1, 'L');
$pdf->Cell(50, 6, $rueBoutique, 0, 1, 'L');
$pdf->Cell(50, 6, $cpostBoutique, 0, 1, 'L');
$pdf->Cell(0, 6, $villeBoutique, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(170, -82, 'Client :', 0, 1, 'R');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(170, 96, $email, 0, 1, 'R');
$pdf->Cell(170, 6, $nom, 0, 1, 'R');


$pdf->Output();
?>

