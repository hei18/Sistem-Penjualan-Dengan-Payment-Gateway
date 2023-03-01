<?php

$pdf = new Pdf('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);

ob_end_clean();
if ($bm == NULL) {
	$pdf->SetTitle($empty['email'] . '-' . 'Data - ' . time());
} else {
	$pdf->SetTitle($bm['email'] . '-' . 'Data - ' . time());
}
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('times', '', 12);
$pdf->AddPage('P');

$html = '
<h3>Data Pribadi Anda</h3>
<table border="1" cellpadding="3">
		<tr>
			<th>Nama Panggilan</th>
			<th>Nama Depan</th>
			<th>Nama Belakang</th>
			<th>Email </th>
			<th>Nomor Ponsel </th>
			<th>Alamat Lengkap </th>
		</tr>';
if ($bm != NULL) {

	$html .= '<tr>
					<td>' . $bm['nickname'] . '</td>
					<td>' . $bm['first_name'] . '</td>
					<td>' . $bm['last_name'] . '</td>
					<td>' . $bm['email'] . '</td>
					<td>' . $bm['phone_number'] . '</td>
					<td>' . $bm['address'] . '</td>
					</tr>';
} else {
	$html .= '<tr>
    <td align="center" colspan="7">Data tidak ditemukan</td>
  </tr>';
}

$html .= '</table>';

$html .= '<h3>Riwayat Transaksi</h3>
<table border="1" cellpadding="3">
	<tr>
		<th>Id Pembayaran</th>
		<th>Judul</th>
		<th>Jenis Instrumental</th>
		<th>Tipe Produk</th>
		<th>Jumlah</th>
		<th>Harga</th>
		<th>Subtotal</th>


	</tr>';
if ($order != NULL) {
	foreach ($order as $key) {
		$html .= '
		<tr>
		<td>' . $key['order_id'] . ' </td>
		<td>' . $key['title'] . ' </td>
		<td>' . $key['genre'] . ' </td>
		<th>Audio</th>
		<td>' . $key['qty'] . ' </td>
		<td>' . idr($key['bill_price']) . ' </td>
		<td>' . idr($key['subtotal']) . ' </td>
		</tr>';
	}
} else {
	$html .= '
  <tr>
    <td align="center" colspan="7">Data tidak ditemukan</td>
  </tr>
  ';
}

if ($total != NULL) {
	$html .= '<tr>
	<td colspan="6"> TOTAL </td>
	<td>' . idr($total) . ' </td>

	</tr>';
} else {
	$html .= '<tr>
	<td colspan="4"> TOTAL </td>
	<td>Rp.0 </td>

	</tr>';
}
$html .= '</table>';



$pdf->writeHTML($html, TRUE, FALSE, TRUE, FALSE, '');
#$pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/mixfinal/files/pdf/' . $bm['nickname'] . '-personal-data' . '.pdf', 'F');
if ($bm != NULL) {
	$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'files/pdf/' . $bm['email'] . '-personal-data' . '.pdf', 'F');
	#$pdf->Output($bm['nickname'] . time() . '.pdf');
} else {
	#$pdf->Output(time() . 'personal-data' . '.pdf', 'I');
	$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'files/pdf/' . $empty['email'] . '-personal-data' . '.pdf', 'F');
}
