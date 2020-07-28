<?php
date_default_timezone_set('America/Bogota');
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
} else if ($_SESSION["id"] == "") {
    header("Location: index.php");
}

require 'logica/Persona.php';
require 'logica/Paciente.php';

require_once 'modelos/fpdf/fpdf.php';

// cd D:\xampp\htdocs\IPSUD3\modelos\fpdf\font
//php D:\xampp\htdocs\IPSUD3\modelos\fpdf\makefont\makefont.php Montserrat-Regular.ttf

class MyPdf extends FPDF {
    function Header() {
        $this->AddFont('Lexend', "", 'LexendDeca-Regular.php');
        $this->SetFont('Lexend', "", 16);
        $this->Image("img/heartbeat.png");

        $this->Cell(276, 5, "IPSUD", 0, 0, "C");

        $this->Ln();
        $this->Cell(276, 10, (isset($_POST["filtro"])) ? "Resultado de pacientes filtrados" : "Informe de pacientes registrados", 0, 0, "C");
        $this->Ln();
        $this->Cell(276, 5, date("d/m/yy") . "  " . date("g:i A"), 0, 0, "C");
        $this->Ln(20);
    }

    function Footer() {
        $this->SetY(-15);
        $this->Cell(0, 10, $this->PageNo() . '/{nb}', 0, 0, "R");
        $this->AliasNbPages();
    }

    function headerTable() {
        $this->SetFillColor(255, 228, 148);
        $this->SetDrawColor(0, 174, 173);
        $this->Cell(20, 10, "ID", 1, 0, "C", true);
        $this->Cell(47, 10, "Nombre", 1, 0, "C", true);
        $this->Cell(47, 10, "Apellido", 1, 0, "C", true);
        $this->Cell(47, 10, "Cedula", 1, 0, "C", true);
        $this->Cell(47, 10, "Correo", 1, 0, "C", true);
        $this->Cell(20, 10, "Estado", 1, 0, "C", true);
        $this->Cell(47, 10, "Foto", 1, 0, "C", true);
        $this->Ln();

    }

    function viewTable() {
        $paciente = new Paciente();

        $pacientes = (isset($_POST["filtro"])) ? $paciente->filtroPaciente($_POST["filtro"]) : $paciente->consultarTodos();
        $i = 1;
        foreach ($pacientes as $p) {
            if ($i % 2 == 0) {
                $this->SetFillColor(218, 218, 218);
            } else {
                $this->SetFillColor(255, 255, 255);
            }

            $this->SetDrawColor(0, 174, 173);
            $this->Cell(20, 35, $p->getId(), 1, 0, "C", true);
            $this->Cell(47, 35, $p->getNombre(), 1, 0, "C", true);
            $this->Cell(47, 35, $p->getApellido(), 1, 0, "C", true);
            $this->Cell(47, 35, $p->getCedula(), 1, 0, "C", true);
            $this->Cell(47, 35, $p->getCorreo(), 1, 0, "C", true);
            $this->Cell(20, 35, $this->Image(($p->getEstado() == 1) ? "img/check.jpg" : "img/times.jpg", $this->GetX() + 2, $this->GetY() + 7, 15, 20), 1, 0, true);
            $this->Cell(47, 35, $this->Image(($p->getFoto() != "" && file_exists("img/" . $p->getFoto() . "") && $p->getFoto()) ? "img/" . $p->getFoto() : "img/user.jpg", $this->GetX() + 1, $this->GetY() + 1, 45, 33), 1, "", true);
            $this->Ln();
            $i++;
        }
    }
}

$pdf = new MyPdf("L");

$pdf->AddFont('Roboto', "", 'Roboto-Regular.php');
$pdf->SetFont('Roboto', "", 16);
$pdf->AddPage();

$pdf->headerTable();
$pdf->viewTable();
$pdf->Output();
?>