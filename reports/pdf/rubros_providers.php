<?php

require_once '../main.php';

$levels = [
	'Sudo',
	'Administrator'
];

if (in_array($_SESSION['session_providers']['level'], $levels))
{
	require_once 'fpdf/fpdf.php';

	define("FILE_SIDE", $_SESSION['data_report']['side']);
	define("INIT_DATE", $_SESSION['data_report']['initdate']);
	define("FINISH_DATE", $_SESSION['data_report']['finishdate']);
	define("REGION", $_SESSION['data_report']['region']);
	define("ALL", $_SESSION['data_report']['all']);

	unset($_SESSION['data_report']);

	class PDF extends FPDF {

		// Cabecera de página

		function Header() {
			$this->SetFont('Arial', 'B', 20);
			$this->Image('../../dist/img/logo.png', 8, 10, 40); //imagen(archivo, png/jpg || x,y,tamaño)
			$this->setXY(60, 15);
			$this->Cell(100, 8, utf8_decode('Reporte de proveedores'), 0, 1, 'C', 0);
			$this->Ln(5);
		}

		// Pie de página

		function Footer() {
			// Posición: a 1,5 cm del final
			$this->SetY(-15);

			$this->SetFont('Arial', 'B', 10);
			// Número de página
			$this->Cell(170, 10, 'Educo | Todos los derechos reservados', 0, 0, 'C', 0);
			$this->Cell(25, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
		}

		// --------------------METODO PARA ADAPTAR LAS CELDAS------------------------------
		var $widths;
		var $aligns;

		function SetWidths($w) {
			//Set the array of column widths
			$this->widths = $w;
		}

		function SetAligns($a) {
			//Set the array of column alignments
			$this->aligns = $a;
		}

		function Row($data, $setX) //yo modifique el script a  mi conveniencia :D
		{
			//Calculate the height of the row
			$nb = 0;
			for ($i = 0; $i < count($data); $i++) {
				$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
			}

			$h = 8 * $nb;
			//Issue a page break first if needed
			$this->CheckPageBreak($h, $setX);
			//Draw the cells of the row
			for ($i = 0; $i < count($data); $i++) {
				$w = $this->widths[$i];
				$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
				//Save the current position
				$x = $this->GetX();
				$y = $this->GetY();
				//Draw the border
				$this->Rect($x, $y, $w, $h, 'DF');
				//Print the text
				$this->MultiCell($w, 8, $data[$i], 0, $a);
				//Put the position to the right of the cell
				$this->SetXY($x + $w, $y);
			}
			//Go to the next line
			$this->Ln($h);
		}

		function CheckPageBreak($h, $setX) {
			//If the height h would cause an overflow, add a new page immediately
			if ($this->GetY() + $h > $this->PageBreakTrigger) {
				$this->AddPage($this->CurOrientation);
				$this->SetX($setX);

				//volvemos a definir el  encabezado cuando se crea una nueva pagina
				$this->SetFont('Helvetica', 'B', 10);
				$this->Cell(10, 8, utf8_decode('No'), 1, 0, 'C', 0);
				$this->Cell(50, 8, utf8_decode('Proveedor'), 1, 0, 'C', 0);
				$this->Cell(50, 8, utf8_decode('Razónsocial'), 1, 0, 'C', 0);
				$this->Cell(40, 8, utf8_decode('Rubro'), 1, 0, 'C', 0);
				$this->Cell(20, 8, utf8_decode('Teléfono'), 1, 0, 'C', 0);
				$this->Cell(50, 8, utf8_decode('Email'), 1, 0, 'C', 0);
				$this->Cell(30, 8, utf8_decode('Homologación'), 1, 0, 'C', 0);
				$this->Cell(30, 8, utf8_decode('Estado'), 1, 1, 'C', 0);
				$this->SetFont('Arial', '', 8);
			}

			if ($setX == 100) {
				$this->SetX(100);
			} else {
				$this->SetX($setX);
			}
		}

		function NbLines($w, $txt) {
			//Computes the number of lines a MultiCell of width w will take
			$cw = &$this->CurrentFont['cw'];
			if ($w == 0) {
				$w = $this->w - $this->rMargin - $this->x;
			}

			$wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
			$s = str_replace("\r", '', $txt);
			$nb = strlen($s);
			if ($nb > 0 and $s[$nb - 1] == "\n") {
				$nb--;
			}

			$sep = -1;
			$i = 0;
			$j = 0;
			$l = 0;
			$nl = 1;
			while ($i < $nb) {
				$c = $s[$i];
				if ($c == "\n") {
					$i++;
					$sep = -1;
					$j = $i;
					$l = 0;
					$nl++;
					continue;
				}
				if ($c == ' ') {
					$sep = $i;
				}

				$l += $cw[$c];
				if ($l > $wmax) {
					if ($sep == -1) {
						if ($i == $j) {
							$i++;
						}

					} else {
						$i = $sep + 1;
					}

					$sep = -1;
					$j = $i;
					$l = 0;
					$nl++;
				} else {
					$i++;
				}
			}
			return $nl;
		}
		// -----------------------------------TERMINA---------------------------------
	}

	//------------------OBTENES LOS DATOS DE LA BASE DE DATOS-------------------------
	$data = $model->providers_list();

	/* IMPORTANTE: si estan usando MVC o algún CORE de php les recomiendo hacer uso del metodo
	que se llama *select_all* ya que es el que haria uso del *fetchall* tal y como ven en la linea 161
	ya que es el que devuelve un array de todos los registros de la base de datos
	si hacen uso de el metodo *select* hara uso de fetch y este solo selecciona una linea*/

	//--------------TERMINA BASE DE DATOS-----------------------------------------------

	// Creación del objeto de la clase heredada
	$pdf = new PDF('L','mm','A4'); //hacemos una instancia de la clase
	$pdf->AliasNbPages();
	$pdf->AddPage(); //añade l apagina / en blanco
	$pdf->SetMargins(10, 10, 10); //MARGENES
	$pdf->SetAutoPageBreak(true, 20); //salto de pagina automatico

	// -----------ENCABEZADO------------------
	$pdf->SetX(8);
	$pdf->SetFont('Helvetica', 'B', 10);
	$pdf->Cell(10, 8, utf8_decode('No'), 1, 0, 'C', 0);
	$pdf->Cell(50, 8, utf8_decode('Proveedor'), 1, 0, 'C', 0);
	$pdf->Cell(50, 8, utf8_decode('Razónsocial'), 1, 0, 'C', 0);
	$pdf->Cell(40, 8, utf8_decode('Rubro'), 1, 0, 'C', 0);
	$pdf->Cell(20, 8, utf8_decode('Teléfono'), 1, 0, 'C', 0);
	$pdf->Cell(50, 8, utf8_decode('Email'), 1, 0, 'C', 0);
	$pdf->Cell(30, 8, utf8_decode('Homologación'), 1, 0, 'C', 0);
	$pdf->Cell(30, 8, utf8_decode('Estado'), 1, 1, 'C', 0);
	// -------TERMINA----ENCABEZADO------------------

	$pdf->SetFillColor(255,255,255); //color de fondo rgb
	$pdf->SetDrawColor(61, 61, 61); //color de linea  rgb

	$pdf->SetFont('Arial', '', 8);

	//El ancho de las celdas
	$pdf->SetWidths(array(10, 50, 50, 40, 20, 50, 30, 30)); //???

	// esto no lo mencione en el video pero también pueden poner la alineación de cada COLUMNA!!!
	$pdf->SetAligns(array('C','C','C','C','C','C','C','C'));

	if ($data)
	{
		foreach ($data['type'] as $i => $id)
		{
			$hstatus = ($data['hstatus'][$i] == 4) ? 'pendiente' : 'finalizado';
			$approved = ($data['approved'][$i] == 0) ? 'pendiente' : 'aprobado';
			$pdf->Row(array($i + 1, utf8_decode($data['name'][$i]), utf8_decode($data['reason'][$i]), utf8_decode($data['branch'][$i]), utf8_decode($data['tel'][$i]), utf8_decode($data['email'][$i]), utf8_decode($hstatus), utf8_decode($approved)), 8);
		}
	}
	else
	{
		$pdf->Row(array('-', '-', '-', '-', '-', '-', '-', '-', '-'), 8);
	}

	// cell(ancho, largo, contenido,borde?, salto de linea?)

	$fecha = date('d-m-Y');

	$name = "Reporte de proveedores al {$fecha}.pdf";

	$pdf->Output('D', utf8_decode($name));
}
else
{
	header('Location: 404');
}
