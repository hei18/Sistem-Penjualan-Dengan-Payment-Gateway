<p>Dear, <?= $full_name; ?></p>
<p>Setelah anda melakukan check out, harap selesaikan pembayaran anda, anda bisa mendownload panduan pembayaran <a href="<?= $url; ?>">disini</a><br>
	Note : Pembayaran akan kadaluarsa 24jam dari sekarang
	<br>
	Instruksi untuk mendapatkan instrumental yang anda beli
	<br>
	1. Setelah anda menyelesaikan pembayaran, kembalilah ke dashboard transaksi anda
	<br>
	2. Silahkan refresh halaman dashboard transaksi anda, apabila status belum terupdate anda dapat klik tombol check status untuk konfirmasi pembayaran(sesuaikan dengan order id anda yang
	terdapat pada email ini, -order id anda: "<?= $order_id; ?> ")
	<br>
	3. Setelah status terupdate menjadi "sukses"
	<br>
	4. Maka anda bisa menekan tombol "Kirim" untuk mendapatkan instrumental
	<br>
	5. Dan anda bisa check email anda kembali untuk melihat invoice dan link download untuk full versinya
	<br>
</p>