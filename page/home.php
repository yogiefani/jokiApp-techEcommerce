<!-- 
 Lokasi dan Nama File	: page/home.php
-->
<div class="thumbnail">
    <div class="linear"></div>
</div>
<div class="body_konten">
    <div class="container">
        <form class="produk_search" method="post" class="form">
            <input class="form_search" type="text" name="cari" placeholder="cari..">
            <button class="form_button2" for="cari">cari</button>
        </form>
        <div class="row">
            <div class="col-12 heading_hp">
                <h1>Rekomendasi</h1>
            </div>
        </div>
        <?php
        $hp = mysqli_query($conn, "SELECT * FROM hp ORDER BY id_hp");
        if (isset($_POST['cari'])) {
            $hp = mysqli_query($conn, "SELECT * FROM hp WHERE nama_hp LIKE '%" . $_POST['cari'] . "%'");
        }
        while ($hp1 = mysqli_fetch_array($hp)) {
        ?>
            <div class="hp col-2">
                <img src="<?php echo $hp1['images']; ?>" width="100%" height="150px"><br>
                <div class="namahp">
                    <a href="?page=detail_hp&&id_hp=<?php echo $hp1['id_hp']; ?>">
                        <?php echo $hp1['nama_hp']; ?>
                    </a><br>
                    <i class="namahpi">Rp.<?php echo number_format($hp1['harga']); ?></i>
                </div>
                <center>
                    <a href="?page=detail_hp&&id_hp=<?php echo $hp1['id_hp']; ?>" class="detail_hp">Detail Hp</a>
                </center>
            </div>
        <?php } ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 heading_hp">
                <h1>Handphone terbaru</h1>
            </div>
        </div>
        <?php
        $hp = mysqli_query($conn, "SELECT * FROM hp ORDER BY id_hp DESC");
        if (isset($_POST['cari'])) {
            $hp = mysqli_query($conn, "SELECT * FROM hp WHERE nama_hp LIKE '%" . $_POST['cari'] . "%'");
        }
        while ($hp1 = mysqli_fetch_array($hp)) {
        ?>
            <div class="hp col-2">
                <img src="<?php echo $hp1['images']; ?>" width="100%" height="150px"><br>
                <div class="namahp">
                    <a href="?page=detail_hp&&id_hp=<?php echo $hp1['id_hp']; ?>">
                        <?php echo $hp1['nama_hp']; ?>
                    </a><br>
                    <i class="namahpi">Rp.<?php echo number_format($hp1['harga']); ?></i>
                </div>
                <center>
                    <a href="?page=detail_hp&&id_hp=<?php echo $hp1['id_hp']; ?>" class="detail_hp">Detail Hp</a>
                </center>
            </div>
        <?php } ?>
    </div>
    <div class="row">

    </div>
</div>