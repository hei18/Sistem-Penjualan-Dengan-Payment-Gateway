<?php

$pdf = new Pdf('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);

ob_end_clean();

$pdf->SetTitle('Report Expanses' . '-' . 'Data - ' . time());
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('times', '', 12);
$pdf->AddPage('L');

$html = '<h3>Pengeluaran</h3>
	<table border="1" cellpadding="3">
		<tr>
			<th>Tanggal Order</th>
			<th>Tanggal Pembayaran</th>
			<th>Judul</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Subtotal</th>


		</tr>';
if ($expenses != NULL) {


	foreach ($expenses as $key) {
		$date_tr = $key['transaction_time'];
		$date_stl = $key['settlement_time'];

		$defineTrFormated = date_create($date_tr);
		$defineStlFormated = date_create($date_stl);

		$trFormated = date_format($defineTrFormated, 'H:i:s');
		$stlFormated = date_format($defineStlFormated, 'H:i:s');
		$html .= '
		<tr>

		  <td> ' . indonesian_date($key['transaction_time']) . '/ ' . $trFormated . '</td>
		  <td> ' . indonesian_date($key['settlement_time']) . ' / ' . $stlFormated . '</td>
		  <td> ' . $key['title'] . '</td>
		  <td> ' . $key['qty'] . '</td>
		  <td> ' . idr($key['bill_price']) . '</td>
		  <td style="text-align: right;"> ' . idr($key['subtotal']) . '</td>


		</tr>
	  ';
	}
	$html .= '<tr>
				<td colspan="5">TOTAL</td>
				<td style="text-align: right;"> ' . idr($sum) . ' </td>
				</tr>';
} else {
	$html .= '<tr>
    <td align="center" colspan="7">Data tidak ditemukan</td>
  </tr>';
}
$html .= '</table>';

$pdf->writeHTML($html, TRUE, FALSE, TRUE, FALSE, '');

$pdf->Output('Report Expanses' . '-' . 'Data - ' . time() . '.pdf', 'D');
#exit();
