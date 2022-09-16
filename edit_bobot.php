<section id="main" class="d-flex ">
    <div class="container">
        <div class="section-title">

            <h2 class="fw-bolder mb-4">Kriteria</h2>
            <p>
                Berikut lima kriteria dalam menentukan kelayakan suatu keluarga untuk menerima bantuan COVID-19.
                Berdasarkan kriteria ini akan ditentukan keluarga mana yang paling layak untuk menerima bantuan
                COVID-19.
            </p>
        </div>
        <div class="">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th width="130px">ID Kriteria</th>
                        <th width="190px">Nama Kriteria</th>
                        <th width="200px">Atribut</th>
                        <th width="140px">Bobot</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- awal menampilkan data -->
                    <?php
           $sql = "SELECT*FROM kriteria";
           $result = $conn->query($sql); while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_kriteria']; ?></td>
                        <td><?php echo $row['nama_kriteria']; ?></td>
                        <td><?php echo $row['atribut']; ?></td>
                        <td><?php echo $row['bobot_kriteria']; ?></td>
                        <td align="center" width="250px">
                            <a class="editb"
                                href="?page=edit_bobot&action=update&id_kriteria=<?php echo $row['id_kriteria']; ?>"><i
                                    class='bx bxs-edit'></i></a>
                        </td>
                    </tr>
                    <?php
           }
           $conn->close(); ?>
                    <!-- akhir menampilkan data -->
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--End About-->