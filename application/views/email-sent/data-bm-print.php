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
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email </th>
			<th>Beatmaker Name</th>
		</tr>
		<tr>
			<td>' . $bm['first_name'] . '</td>
			<td>' . $bm['last_name'] . '</td>
			<td>' . $bm['email'] . '</td>
			<td>' . $bm['nickname'] . '</td>
		</tr>
	</table>';

$html .= '<h3>Your Bank Data</h3>
	<table border="1" cellpadding="3">
		<tr>
			<th>Bank</th>
			<th>Bank Number</th>

		</tr>';
foreach ($bank as $key) {

	$html .= '
			  <tr>

				<td> ' . $key['bank_name'] . '</td>
				<td> ' . $key['bank_number'] . '</td>

			  </tr>
			';
}
$html .= '</table>';
ob_clean();
$pdf->writeHTML($html, TRUE, FALSE, TRUE, FALSE, '');
$pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/testing/files/pdf/' . $bm['nickname'] . '-personal-data' . '.pdf', 'F');
#exit();
