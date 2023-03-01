<?php

$pdf = new Pdf('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);

ob_end_clean();
if ($bm != NULL) {
	$pdf->SetTitle($bm['email'] . '-' . 'Data - ' . time());
} else {
	$pdf->SetTitle($empty['email'] . '-' . 'Data - ' . time());
}
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('times', '', 12);
$pdf->AddPage('P');

$html = '
<h3>Profil</h3>
<table border="1" cellpadding="3">
		<tr>
			<th>Nama Depan</th>
			<th>Nama Belakang</th>
			<th>Email </th>
			<th>Nama Beatmaker</th>
		</tr>';
if ($bm != NULL) {
	$html .= '
			<tr>
			<td>' . $bm['first_name'] . '</td>
			<td>' . $bm['last_name'] . '</td>
			<td>' . $bm['email'] . '</td>
			<td>' . $bm['nickname'] . '</td>
		</tr>
			';
} else {
	$html .= '<tr>
    <td align="center" colspan="7">Data tidak ditemukan</td>
  </tr>';
}

$html .= '</table>';

$html .= '<h3>Akun Bank</h3>
	<table border="1" cellpadding="3">
		<tr>
			<th>Bank</th>
			<th>Bank Number</th>

		</tr>';
if ($bank != NULL) {

	foreach ($bank as $key) {

		$html .= '
						  <tr>

							<td> ' . $key['bank_name'] . '</td>
							<td> ' . $key['bank_number'] . '</td>

						  </tr>
						';
	}
} else {
	$html .= '<tr>
    <td align="center" colspan="7">Data tidak ditemukan</td>
  </tr>';
}
$html .= '</table>';
$html .= '<h3>Riwayat Penarikan</h3>
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
if ($bm != NULL) {

	$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'files/pdf/' . $bm['email'] . '-personal-data' . '.pdf', 'F');
} else {
	$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'files/pdf/' . $empty['email'] . '-personal-data' . '.pdf', 'F');
}
#exit();
