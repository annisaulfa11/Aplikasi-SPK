<section id="main" class="d-flex ">
    <div class="container">
        <div class="section-title">
            <h2 class="fw-bolder mb-4">Alternatif</h2>
            <p>
                Berikut data-data keluarga yang didapatkan dari hasil survei di Kelurahan Sawahan Timur. Keluarga yang
                mengisi survei akan menjadi calon penerima bantuan covid-19.
            </p>
        </div>
        <button class="alter">
            <a class="add" href="?page=data_KK&action=tambah" style=margin-bottom:10px><i class='bx bx-plus'></i>
            </a>
            <a href="?page=data_KK&action=tambah" class="">
                <h4>Tambah</h4>
            </a>
        </button>



        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th width="150px">ID KK</th>
                    <th width="190px">Kepala Keluarga</th>
                    <th width="280px">Alamat</th>

                    <th width="140px">No.Telp</th>
                    <th width="100px">Opsi</th>
                </tr>
            </thead>

            <tbody>
                <!-- awal menampilkan data -->
                <?php
     $sql = "SELECT*FROM alternatif";
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc()) {
    ?>
                <tr>
                    <td><?php echo $row['id_kk']; ?></td>
                    <td><?php echo $row['kepala_keluarga']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>

                    <td><?php echo $row['no_telp']; ?></td>
                    <td align="center" width="250px">
                        <a class="editb" href="?page=data_KK&action=update&id_kk=<?php echo $row['id_kk']; ?>"><i
                                class='bx bxs-edit'></i></a>
                        <a onclick="return confirm('Anda yakin menghapus data ini ?')" class="editb"
                            href="?page=data_KK&action=hapus&id_kk=<?php echo $row['id_kk']; ?>"><i
                                class='bx bxs-trash'></i></a>
                    </td>
                </tr>
                <?php
     }
     $conn->close();
 ?>
                <!-- akhir menampilkan data -->
            </tbody>
        </table>
    </div>
</section>