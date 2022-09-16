<section id="main" class="d-flex ">
    <div class="container">
        <div class="section-title">
            <h2 class="fw-bolder mb-4">Tambah Data KK Baru</h2>
        </div>

        <!-- letakkan proses tambah data disini -->

        <?php

if(isset($_POST['simpan'])){
    $id_kk=$_POST['id_kk'];
    $kepala_keluarga=$_POST['kepala_keluarga'];
    $alamat=$_POST['alamat'];
    $tanggungan=$_POST['tanggungan'];
    $penghasilan_gab=$_POST['penghasilan_gab'];
    $jumlah_phk=$_POST['jumlah_phk'];
    $kasus_aktif=$_POST['kasus_aktif'];
    $pengeluaran=$_POST['pengeluaran'];
    $no_telp=$_POST['no_telp'];
	
    // validasi
    $sql = "SELECT*FROM alternatif WHERE id_kk='$id_kk'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>pesan jika data sudah ada</strong>
        </div>
        <?php
    }else{
	//proses simpan
        $sql1 = "INSERT INTO alternatif (id_kk, kepala_keluarga, alamat, tanggungan, penghasilan_gab, jumlah_phk, kasus_aktif, pengeluaran, no_telp) VALUES ('$id_kk','$kepala_keluarga','$alamat', '$tanggungan'+1, '$penghasilan_gab', '$jumlah_phk'+1,'$kasus_aktif'+1, '$pengeluaran', '$no_telp')";
        $sql2 = "INSERT INTO analisa (id_kk, id_kriteria, nilai) VALUES ($id_kk, 1, $penghasilan_gab),
            ($id_kk, 2, '$tanggungan'+1),
            ($id_kk, 3, $pengeluaran),
            ($id_kk, 4, '$jumlah_phk'+1),
            ($id_kk, 5, '$kasus_aktif'+1)";
        $conn->query($sql1);
        if ($conn->query($sql2) === TRUE) {
            header("Location:?page=data_KK");
        }
    }
}
?>

        <form action="" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="id_kk">ID KK</label>
                        <input type="int" class="form-control" name="id_kk" maxlength="11" required>
                    </div>

                    <div class="form-group">
                        <label for="kepala_keluarga">Kepala Keluarga</label>
                        <input type="text" class="form-control" name="kepala_keluarga" maxlength="35" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggungan">Jumlah Tanggungan</label>
                        <input type="int" class="form-control" name="tanggungan" maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="penghasilan_gab">Jumlah Penghasilan Gabungan</label>
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
                        <input type="int" class="form-control" name="kasus_aktif" maxlength="11" required>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" maxlength="59" required>
                    </div>

                    <div class="form-group">
                        <label for="no_telp">Nomor Telp</label>
                        <input type="text" class="form-control" name="no_telp" maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_phk">Jumlah PHK</label>
                        <input type="int" class="form-control" name="jumlah_phk" maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="pengeluaran">Total Pengeluaran</label>
                        <select class="select chosen-select" data-placeholder="Pilih Total Pengeluaran"
                            name="pengeluaran">
                            <option value=""> Pilih Total Pengeluaran</option>;
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
                    <input class="but" type="submit" name="simpan" value="Simpan">

                </div>
                <div class="col-sm-6">
                    <a class="but" href="?page=data_KK">Batal</a>

                </div>
            </div>
        </form>
    </div>
</section>