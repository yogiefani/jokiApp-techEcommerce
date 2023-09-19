<?php
$cekuserlogin = $_SESSION['username'];
?>
<?php
if (empty($cekuserlogin)) {
	header("Location: login.php");
} else { ?>
	<!DOCTYPE html>
	<html>

	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href=".../style.css">
	</head>

	<body>
		<div class="container">
			<h2 class="">HP(HANDPHONE)</h2>
			<hr>
			<b>Tambah/Edit Data</b>
			<?php
			//proses simpan data
			$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
			if ($proses == "simpan") {
				$idkategori = @$_POST['id_kategori'];
				$namahp = @$_POST['nama_hp'];
				$harga = @$_POST['harga'];
				$stok = @$_POST['stok'];
				$pilihanwarna = @$_POST['pilihan_warna'];
				$deskripsi = @$_POST['deskripsi'];
				$nama_gambar = @$_FILES['images']['name'];
				$tmp_gambar = @$_FILES['images']['tmp_name'];
				if (!empty($nama_gambar)) {
					copy($tmp_gambar, "../images/$nama_gambar");
				}
				$simpan = mysqli_query($conn, "
    		INSERT INTO hp(id_kategori,nama_hp,
    		harga,stok,pilihan_warna,deskripsi,images) 
    		VALUES('$idkategori','$namahp',
    		'$harga','$stok','$pilihanwarna','$deskripsi','images/$nama_gambar')");
				if ($simpan) {
					echo "<h3>Input Data Berhasil</h3>";
				} else {
					echo "<h3>Input Data Gagal</h3>";
				}
			}
			if ($proses == "hapus") {
				$idhp = mysqli_real_escape_string($conn, @$_GET['id_hp']);
				$cekdata = mysqli_fetch_array(mysqli_query(
					$conn,
					"SELECT * FROM hp WHERE 
    		id_hp='$idhp'"
				));
				unlink("../$cekdata[images]");
				$hapus = mysqli_query($conn, "DELETE FROM hp WHERE 
    		id_hp='$idhp'");
				if ($hapus) {
					echo "<h3>Hapus Data Berhasil</h3>";
				} else {
					echo "<h3>Hapus Data Gagal</h3>";
				}
			}
			?>
			<form method="post" action="?page=tambah_hp&&proses=simpan" enctype="multipart/form-data">
				<label class="col-4">Kategori Hp</label>
				<div class="col-8">
					<select class="form_input" name="id_kategori">
						<?php
						$kategorihp = mysqli_query(
							$conn,
							"SELECT * FROM kategori_hp"
						);
						while ($kategorihp1 = mysqli_fetch_array($kategorihp)) {
						?>
							<option value="
					<?php echo $kategorihp1['id_kategori']; ?>"><?php echo $kategorihp1['kategori']; ?></option>
						<?php } ?>
					</select>
				</div>
				<label class="col-4">Nama Hp</label>
				<div class="col-8">
					<input class="form_input" type="text" name="nama_hp" maxlength="100" placeholder="Masukan nama hp" minlength="1">
				</div>
				<label class="col-4">Harga </label>
				<div class="col-8">
					<input class="form_input" type="number" name="harga" maxlength="20" placeholder="Masukan harga hp(tidak boleh ada tanda ./," minlength="1">
				</div>
				<label class="col-4">Stok </label>
				<div class="col-8">
					<input class="form_input" type="number" name="stok" maxlength="20" placeholder="Masukan stok hp(tidak boleh ada tanda ./," minlength="1">
				</div>
				<label class="col-4">Pilihan warna </label>
				<div class="col-8">
					<input class="form_input" type="text" name="pilihan_warna" maxlength="20" placeholder="example(Hitam,putih..)" minlength="1">
				</div>
				<label class="col-4">Deskripsi</label>
				<div class="col-8">
					<textarea class="form_input" name="deskripsi" rows="20" style="width:100%;" minlength="1"></textarea>
				</div>
				<label class="col-4">Upload Gambar Hp</label>
				<input class="col-8" type="file" accept="image/*" name="images">

				<label class="col-4">&nbsp;</label>
				<div class="col-8">
					<button class="form_button2" type="submit">Simpan Data</button>
				</div>
			</form>
			<h3>Tampil Data</h3>
			<form method="post" class="form">
				<input type="text" name="cari" placeholder="cari..">
				<button for="cari">cari</button>
			</form>
			<table class="table_admin" border="1" cellpadding="5" cellspacing="0">
				<tr>
					<td>NO</td>
					<td>Nama Hp</td>
					<td>Harga Rupiah</td>
					<td>Stok Hp</td>
					<td>Gambar</td>
					<td>aksi</td>
				</tr>
				<?php
				$tampildata = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kategori_hp"));
				$i = 1;
				$query = mysqli_query($conn, "SELECT * FROM hp");
				if (isset($_POST['cari'])) {
					$query = mysqli_query($conn, "SELECT * FROM hp WHERE nama_hp LIKE '%" . $_POST['cari'] . "%'");
				}
				while ($cetak = mysqli_fetch_array($query)) {
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $cetak['nama_hp']; ?></td>
						<td>Rp. <?php echo number_format($cetak['harga']); ?></td>
						<td><?php echo $cetak['stok']; ?></td>
						<td><img src="../<?php echo $cetak['images']; ?>" alt="" width="50px"></td>
						<td>
							<a class="text_kecil" href="?page=edit_hp&&id_hp=
				<?php echo $cetak['id_hp']; ?>">
								Edit</a>
							<a class="text_kecil2" href="?page=tambah_hp&&id_hp=
				<?php echo $cetak['id_hp']; ?>&&proses=hapus">
								Hapus</a>
						</td>
					</tr>
				<?php $i = $i + 1;
				} ?>
			</table>
			<br>
		</div>
	</body>

	</html>
<?php } ?>