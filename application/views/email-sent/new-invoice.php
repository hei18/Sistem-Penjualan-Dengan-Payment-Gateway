<?php

$pdf = new Pdf('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);

ob_end_clean();
$pdf->SetTitle($bm['nickname'] . '-' . 'Data - ' . time());
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('times', '', 12);
$pdf->AddPage('P');

$html = '
<h3>Detail</h3>
<table border="1" cellpadding="3">
		<tr>

			<th>Customer Name </th>
			<th>Bill To </th>
			<th>Phone Number </th>
		</tr>
		<tr>
			<td>' . $bm['first_name'] . ' ' . $bm['last_name'] . '</td>
			<td>' . $bm['email'] . '</td>
			<td>' . $bm['phone_number'] . '</td>
		</tr>
		</table>';

$html .= '<h3>Detail Item</h3>
<table border="1" cellpadding="3">
	<tr>
		<th>Oerder Id</th>
		<th>Title</th>
		<th>Genre</th>
		<th>Product Type</th>
		<th>Bill Price</th>


	</tr>';

foreach ($tr as $key) {
	$html .= '
	<tr>
	<td>' . $key['order_id'] . ' </td>
	<td>' . $key['title'] . ' </td>
	<td>' . $key['genre'] . ' </td>

	<th>Audio</th>
	<td>' . idr($key['bill_price']) . ' </td>
	</tr>';
}

$html .= '<tr>
<td colspan="4"> TOTAL </td>
<td>' . idr($total) . ' </td>

</tr>';
$html .= '</table>';



$pdf->writeHTML($html, TRUE, FALSE, TRUE, FALSE, '');
#$pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/mixfinal/files/pdf/' . $bm['nickname'] . '-personal-data' . '.pdf', 'F');
$pdf->Output($bm['nickname'] . time() . '.pdf');
