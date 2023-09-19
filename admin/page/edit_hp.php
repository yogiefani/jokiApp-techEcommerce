	<div class="container">
		<?php
		$idhp = mysqli_real_escape_string($conn, @$_GET['id_hp']);
		$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
		if ($proses == "update") {
			$idkategori = mysqli_real_escape_string($conn, @$_POST['id_kategori']);
			$namahp = mysqli_real_escape_string($conn, @$_POST['nama_hp']);
			$harga = mysqli_real_escape_string($conn, @$_POST['harga']);
			$stok = mysqli_real_escape_string($conn, @$_POST['stok']);
			$pilihanwarna = mysqli_real_escape_string($conn, @$_POST['pilihan_warna']);
			$deskripsi = mysqli_real_escape_string($conn, @$_POST['deskripsi']);
			$nama_gambar = mysqli_real_escape_string($conn, @$_FILES['images']['name']);
			$tmp_gambar = mysqli_real_escape_string($conn, @$_FILES['images']['tmp_name']);
			if (!empty($nama_gambar)) {
				$cekgambar = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hp WHERE id_hp='$idhp'"));
				if (!empty($cekgambar['images'])) { //gambar akan dihapus jika didatabase sebelumnya sudah ada gambar
					unlink("../$cekgambar[images]");
				} else {
					echo "Maaf!! Gambar tidak ada";
				}
				//baris ini adalah baris untuk upload gambar baru
				copy($tmp_gambar, "../images/$nama_gambar");
				$update_gambar = mysqli_query($conn, "UPDATE hp SET images='images/$nama_gambar' WHERE id_hp='$idhp'");
			}
			$update = mysqli_query($conn, "UPDATE hp SET id_kategori='$idkategori',nama_hp='$namahp',harga='$harga',stok='$stok',pilihan_warna='$pilihanwarna',deskripsi='$deskripsi' WHERE id_hp='$idhp'");
			if ($update) {
				echo "Sukses!! Update Data Berhasil";
				header("Location: ?page=tambah_hp");
			} else {
				echo "Maaf!! Proses Update Data Gagal";
			}
		}

		$tampildata = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hp WHERE id_hp='$idhp'"));
		?>
		<h2 class="">Edit Data Hp <?php echo $tampildata['nama_hp'] ?></h2>
		<form method="post" action="?page=edit_hp&&proses=update
	&&id_hp=<?php echo $idhp ?>" enctype="multipart/form-data">
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
					<?php echo $kategorihp1['id_kategori']; ?>" <?php if ($tampildata['id_kategori'] == $kategorihp1['id_kategori']) { ?>selected <?php } ?>>
							<?php echo $kategorihp1['kategori']; ?></option>
					<?php } ?>
				</select>
			</div>
			<label class="col-4">Nama hp</label>
			<div class="col-8">
				<input class="form_input" type="text" name="nama_hp" value="<?php echo $tampildata['nama_hp']; ?>">
			</div>
			<label class="col-4">Harga</label>
			<div class="col-8">
				<input class="form_input" type="number" name="harga" value="<?php echo $tampildata['harga']; ?>" placeholder="Masukan harga hp(tidak boleh ada tanda ./,">
			</div>
			<label class="col-4">Stok</label>
			<div class="col-8">
				<input class="form_input" type="number" name="stok" value="<?php echo $tampildata['stok']; ?>" placeholder="Masukan stok hp(tidak boleh ada tanda ./,">
			</div>
			<label class="col-4">Pilihan Warna</label>
			<div class="col-8">
				<input class="form_input" type="text" name="pilihan_warna" value="<?php echo $tampildata['pilihan_warna']; ?>">
			</div>
			<label class="col-4">Deskripsi</label>
			<div class="col-8">
				<textarea class="form_input" name="deskripsi" rows="10" style="width:100%;"><?php echo $tampildata['deskripsi']; ?></textarea>
			</div>
			<label class="col-4">Ganti Gambar</label>
			<div class="col-8">
				<input class="form_input" type="file" name="images">
			</div>

			<div class="col-12">
				<img src="../<?php echo $tampildata['images']; ?>" alt="" width="100px">
			</div>
			<div class="row">
				<div class="col-12">
					<button class="form_button2" type="submit">Update Data</button>
				</div>
			</div>
		</form>
		<br>
	</div>