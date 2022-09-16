<section id="main" class="d-flex ">
    <div class="container">
        <div class="section-title">
            <h2 class="fw-bolder mb-4">UPDATE DATA KK</h2>
        </div>

        <!-- letakkan proses update data disini -->
        <?php 

if(isset($_POST['update'])){
    $id_kk=$_POST['id_kk'];
    $kepala_keluarga=$_POST['kepala_keluarga'];
    $alamat=$_POST['alamat'];
    $tanggungan=$_POST['tanggungan'];
    $penghasilan_gab=$_POST['penghasilan_gab'];
    $jumlah_phk=$_POST['jumlah_phk'];
    $kasus_aktif=$_POST['kasus_aktif'];
    $pengeluaran=$_POST['pengeluaran'];
    $no_telp=$_POST['no_telp'];

    // proses update
    $sql1 = "UPDATE alternatif SET kepala_keluarga='$kepala_keluarga',
        alamat='$alamat',
        tanggungan='$tanggungan',
        penghasilan_gab='$penghasilan_gab',
        jumlah_phk='$jumlah_phk',
        kasus_aktif='$kasus_aktif',
        pengeluaran='$pengeluaran',
        no_telp='$no_telp' WHERE id_kk='$id_kk'";
    $sql2 = "UPDATE analisa SET nilai = ( CASE
        WHEN id_kk = '$id_kk' AND id_kriteria = 1 then '$penghasilan_gab'
        WHEN id_kk = '$id_kk' AND id_kriteria = 2 then '$tanggungan'
        WHEN id_kk = '$id_kk' AND id_kriteria = 3 then '$pengeluaran'
        WHEN id_kk = '$id_kk' AND id_kriteria = 4 then '$jumlah_phk'
        WHEN id_kk = '$id_kk' AND id_kriteria = 5 then '$kasus_aktif'
        END )";
    $conn->query($sql1);
    if ($conn->query($sql2) === TRUE) {
        header("Location:?page=data_KK");
    }
}

$id_kk=$_GET['id_kk'];

$sql = "SELECT a.id_kk, a.kepala_keluarga, a.alamat, a.no_telp, a.tanggungan, a.penghasilan_gab, a.jumlah_phk, a.kasus_aktif, a.pengeluaran, b.detail_in, c.detail_out FROM alternatif a, detail_in b, detail_out c WHERE a.penghasilan_gab = b.nilai AND a.pengeluaran = c.nilai AND a.id_kk = '$id_kk';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>


        <form action="" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="id_kk">ID KK</label>
                        <input type="int" class="form-control" value="<?php echo $row['id_kk']?>" name="id_kk"
                            maxlength="11" readonly>
                    </div>

                    <div class="form-group">
                        <label for="kepala_keluarga">Kepala Keluarga</label>
                        <input type="text" class="form-control" value="<?php echo $row['kepala_keluarga']?>"
                            name="kepala_keluarga" maxlength="35" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggungan">Jumlah Tanggungan</label>
                        <input type="int" class="form-control" value="<?php echo $row['tanggungan']?>" name="tanggungan"
                            maxlength="11" required>
                    </div>


                    <div class="form-group">
                        <label for="penghasilan_gab">Jumlah Penghasilan Gabungan</label>
                        <input type="int" class="form-control" value="<?php echo $row['detail_in'];?>"
                            name="penghasilan_gab" maxlength="11" readonly>
                        <select class="select chosen-select" data-placeholder="Pilih Penghasilan Gabungan"
                            name="penghasilan_gab">
                            <option value="">Pilih Jumlah Penghasilan Gabungan</option>;
                            <option value="1"><?php echo "< Rp3.000.000";?> </option>;
                            <option value="2"><?php echo "Rp3.000.000 - Rp4.999.999";?> </option>;
                            <option value="3"><?php echo "Rp5.000.000 - Rp6.999.999";?> </option>;
                            <option value="4"><?php echo "Rp7.000.000 - Rp8.999.999";?> </option>;
                            <option value="5"><?php echo "Rp9.000.000 - Rp10.999.999";?> </option>;
                            <option value="6"><?php echo "Rp11.000.000 - Rp12.999.999";?> </option>;
                            <option value="7"><?php echo "> Rp13.000.000";?> </option>;
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="kasus_aktif">Jumlah Kasus Aktif</label>
                        <input type="int" class="form-control" value="<?php echo $row['kasus_aktif']?>"
                            name="kasus_aktif" maxlength="11" required>
                    </div>





                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" value="<?php echo $row['alamat']?>" name="alamat"
                            maxlength="59" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telp</label>
                        <input type="int" class="form-control" value="<?php echo $row['no_telp']?>" name="no_telp"
                            maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_phk">Jumlah PHK</label>
                        <input type="int" class="form-control" value="<?php echo $row['jumlah_phk']?>" name="jumlah_phk"
                            maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="pengeluaran">Total Pengeluaran</label>
                        <input type="int" class="form-control" value="<?php echo $row['detail_out'];?>"
                            name="pengeluaran" maxlength="11" readonly>
                        <select class="select chosen-select" data-placeholder="Pilih Pengeluaran" name="pengeluaran">
                            <option value="">Pilih Pengeluaran</option>;
                            <option value="1"><?php echo "< Rp3.000.000";?> </option>;
                            <option value="2"><?php echo "Rp3.000.000 - Rp4.999.999";?> </option>;
                            <option value="3"><?php echo "Rp5.000.000 - Rp6.999.999";?> </option>;
                            <option value="4"><?php echo "Rp7.000.000 - Rp8.999.999";?> </option>;
                            <option value="5"><?php echo "Rp9.000.000 - Rp10.999.999";?> </option>;
                            <option value="6"><?php echo "Rp11.000.000 - Rp12.999.999";?> </option>;
                            <option value="7"><?php echo "> Rp13.000.000";?> </option>;
                        </select>
                    </div>

                </div>
            </div>
            <div class="tombol row d-flex">
                <div class="col-sm-6">
                    <input class="but" type="submit" name="update" value="Update">
                </div>
                <div class="col-sm-6">
                    <a class="but" href="?page=data_KK">Batal</a>

                </div>
            </div>
        </form>

        <?php
$conn->close();
?>
    </div>
</section>