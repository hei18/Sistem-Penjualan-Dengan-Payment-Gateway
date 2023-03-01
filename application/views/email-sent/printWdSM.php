<?php

$pdf = new Pdf('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);

ob_end_clean();

$pdf->SetTitle('Report WD' . '-' . 'Data - ' . time());
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('times', '', 12);
$pdf->AddPage('L');

$html = '<h3>Penrikan</h3>
	<table border="1" cellpadding="3">
		<tr>
			<th>Id Penarikan</th>
			<th>Pendapatan</th>
			<th>Tanggal Penarikan</th>
			<th>Tanggal Di Transfer</th>
			<th>Status Penarikan</th>

		</tr>';
if ($income != NULL) {
	foreach ($income as $key) {
		$html .= '
		<tr>

		  <td> ' . $key['wd_id'] . '</td>
		  <td> ' . idr($key['net_income']) . '</td>
		  <td> ' . $key['date_wd'] . '</td>
		  <td> ' . $key['date_approve'] . '</td>';
		if ($key['status_income'] == 0) {
			$html .= '<td>Pending</td>';
		} else {
			$html .= '<td>Sudah Di Transfer</td>';
		}


		$html .= '</tr>
	  ';
	}
} else {
	$html .= '<tr>
    <td align="center" colspan="7">Data tidak ditemukan</td>
  </tr>';
}
$html .= '</table>';

$pdf->writeHTML($html, TRUE, FALSE, TRUE, FALSE, '');

$pdf->Output('Report WD' . '-' . 'Data - ' . time() . '.pdf', 'D');
// $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'files/pdf/' . 'Laporan-Pendapatan-' . time() . '.pdf', 'F');

#exit();
