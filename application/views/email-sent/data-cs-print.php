<?php

$pdf = new Pdf('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);


$pdf->SetTitle($bm['nickname'] . '-' . 'Data - ' . time());
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('times', '', 12);
$pdf->AddPage('L');

$html = '
<h3>Your Profile</h3>
<table border="1" cellpadding="3">
		<tr>
			<th>Nick Name</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email </th>
			<th>Phone Number </th>
			<th>Address </th>
		</tr>
		<tr>
			<td>' . $bm['nickname'] . '</td>
			<td>' . $bm['first_name'] . '</td>
			<td>' . $bm['last_name'] . '</td>
			<td>' . $bm['email'] . '</td>
			<td>' . $bm['phone_number'] . '</td>
			<td>' . $bm['address'] . '</td>
		</tr>
		</table>';


$html .= '<h3>Transaction History</h3>
<table border="1" cellpadding="3">
	<tr>
		<th>Oerder Id</th>
		<th>Gross Amount</th>
		<th>Transaction Time</th>

	</tr>';
foreach ($tr as $key) {
	$html .= '
		<tr>
			<td>' . $key['order_id'] . ' </td>
			<td>' . $key['gross_amount'] . ' </td>
			<td>' . $key['transaction_time'] . ' </td>

		</tr>';
}


$html .= '</table>';

ob_clean();

$pdf->writeHTML($html, TRUE, FALSE, TRUE, FALSE, '');
$pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/testing/files/pdf/' . $bm['nickname'] . '-personal-data' . '.pdf', 'F');
#$pdf->Output($bm['nickname'] . time() . '.pdf');
