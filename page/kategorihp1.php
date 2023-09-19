<!-- 
 Lokasi dan Nama File	: page/kategorihp1.php
-->
<br>
<div class="container">
    <div class="col-12">
        <h1>DETAIL KATEGORI HP</h1>
    </div>
</div>
<div class="container">
    <?php
    $id_kategori = mysqli_real_escape_string($conn, @$_GET['id_kategori']);
    $hp = mysqli_query($conn, "SELECT * FROM hp WHERE id_kategori='$id_kategori' ORDER BY id_hp DESC");
    $hp2 = mysqli_num_rows($hp);
    if ($hp2 == 0) {
        echo "<font size='+2' color='#FF0004'>Maaf!! Data Hp pada Kategori ini masih Kosong</font>";
    }
    while ($hp1 = mysqli_fetch_array($hp)) {
    ?>
        <div class="col-2 hp">
            <img src="<?php echo $hp1['images']; ?>" width="100%" height="150px"><br>
            <div class="produk_nama">
                <a href="?page=detail_hp&&id_hp=<?php echo $hp1['id_hp']; ?>">
                    <?php echo $hp1['nama_hp']; ?>
                </a>
            </div>
            <?php echo $hp1['harga']; ?><br>
            <a href="?page=detail_hp&&id_hp=<?php echo $hp1['id_hp']; ?>" class="produk_tombol_kecil">Detail hp</a>
            <a href="#" class="produk_tombol_kecil">Add to Cart</a>
        </div>
    <?php } ?>
</div>
<div class="row"></div>