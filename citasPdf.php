<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}

require 'logica/Persona.php';
require 'logica/Administrador.php';
require 'logica/Paciente.php';
require_once 'modelos/fpdf/fpdf.php';

// C:\xampp\htdocs\p\Hospital\modelos\fpdf\font
//php C:\xampp\htdocs\p\Hospital\modelos\fpdf\makefont\makefont.php Montserrat-Regular.ttf

class MyPdf extends FPDF {
    function Header() {
        $this->AddFont('Lexend', "", 'LexendDeca-Regular.php');
        $this->SetFont('Lexend', "", 16);
        $this->Image("img/heartbeat.png");
        $this->Cell(276, 5, "Hospital", 0, 0, "C");
        $this->Ln();
        $this->Cell(276, 10, "Listado de citas de pacientes", 0, 0, "C");
        $this->Ln(20);
    }

    function Footer() {
        $this->SetY(-15);
        $this->Cell(0, 10, $this->PageNo() . '/{nb}', 0, 0, "R");
        $this->AliasNbPages();
    }

    function viewTable() {
        $paciente = new Paciente();
        $citas = $paciente->obtenerCitas();
        $pac = null;
        foreach ($citas as $p) {
            if ($pac == null || $pac != $p[0]) {
                if ($pac != null) {
                    $this->AddPage();
                }

                $this->SetFont('Lexend', "", 12);
                $this->Cell(112.5, 20, "Paciente: " . $p[1], 1, 0);
                $this->Cell(112.5, 20, "Correo: " . $p[2], 1, 0);
                $this->Cell(50, 20, $this->Image(($p[3] != "" && file_exists("img/" . $p[3] . "") && $p[2]) ? "img/" . $p[3] : "img/user.jpg", $this->GetX() + 1, $this->GetY() + 1, 45, 16), 1);
                $this->Ln();
                $this->Cell(40, 10, "Fecha", 1, 0, "C");
                $this->Cell(40, 10, "Hora", 1, 0, "C");
                $this->Cell(100, 10, "Medico", 1, 0, "C");
                $this->Cell(35, 10, "Consultorio", 1, 0, "C");
                $this->Cell(60, 10, "Especialidad", 1, 0, "C");
                $this->Ln();
            }

            $this->Cell(40, 10, $p[4], 1, 0, "C");
            $this->Cell(40, 10, $p[5], 1, 0, "C");
            $this->Cell(100, 10, $p[6], 1, 0, "C");
            $this->Cell(35, 10, $p[7], 1, 0, "C");
            $this->Cell(60, 10, $p[8], 1, 0, "C");
            $this->Ln();
            $pac = $p[0];
        }

    }
}

$pdf = new MyPdf("L");

$pdf->AddFont('Roboto', "", 'Roboto-Regular.php');
$pdf->SetFont('Roboto', "", 16);
$pdf->AddPage();
$pdf->viewTable();
$pdf->Output();
?>