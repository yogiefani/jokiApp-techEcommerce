<!-- 
 Lokasi dan Nama File	: page/kategorihp.php
-->

<br>
<div class="container">
	<form class="produk_search" method="post" class="form">
		<input class="form_search" type="text" name="cari" placeholder="cari..">
		<button class="form_button2" for="cari">cari</button>
	</form>
	<div class="col-12">
		<h1>KATEGORI HP</h1>
	</div>
</div>
<div class="container">
	<div class="row">
		<?php
		$idhp = @$_GET['id_hp'];
		$tampil = mysqli_query($conn, "SELECT * FROM kategori_hp");
		if (isset($_POST['cari'])) {
			$tampil = mysqli_query($conn, "SELECT * FROM kategori_hp WHERE kategori LIKE '%" . $_POST['cari'] . "%'");
		}
		while ($tampil1 = mysqli_fetch_array($tampil)) {
		?>
			<div class="col-3 produk">
				<img src="images/fullset.jpg" width="100%"><br>
				<div class="produk_nama">
					<a href="?page=kategori_hp1&&id_kategori=<?php echo @$tampil1['id_kategori']; ?>">
						<?php echo $tampil1['kategori']; ?>
					</a>
				</div><br>
				<a href="?page=kategori_hp1&&id_kategori=<?php echo @$tampil1['id_kategori']; ?>" class="produk_tombol_kecil">LIHAT DAFTAR HP</a>
			</div>
		<?php } ?>
	</div>
</div>