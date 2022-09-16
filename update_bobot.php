<link rel="stylesheet" href="style.css" />

<section id="main" class="d-flex ">
    <div class="container">
        <div class="section-title">
            <h2 class="fw-bolder mb-4">UPDATE DATA BOBOT</h2>

        </div>
        <?php 

if(isset($_POST['update'])){
    $id_kriteria=$_POST['id_kriteria'];
    $nama_kriteria=$_POST['nama_kriteria'];
    $atribut=$_POST['atribut'];
    $bobot_kriteria=$_POST['bobot_kriteria'];

    // proses update
    $sql = "UPDATE kriteria SET nama_kriteria='$nama_kriteria',
        atribut='$atribut',
        bobot_kriteria='$bobot_kriteria' WHERE id_kriteria='$id_kriteria'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=edit_bobot");
    }
}

$id_kriteria=$_GET['id_kriteria'];

$sql = "SELECT * FROM kriteria WHERE id_kriteria = '$id_kriteria';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

        <form action="" method="POST" class="form">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="id_kk">ID Kriteria</label>
                        <input type="int" class="form-control" value="<?php echo $row['id_kriteria']?>"
                            name="id_kriteria" maxlength="11" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama_kriteria">Nama Kriteria</label>
                        <input type="text" class="form-control" value="<?php echo $row['nama_kriteria']?>"
                            name="nama_kriteria" maxlength="35" readonly>
                    </div>

                    <div class="form-group">
                        <label for="atribut">Atribut</label>
                        <input type="text" class="form-control" value="<?php echo $row['atribut']?>" name="atribut"
                            maxlength="59" readonly>
                    </div>

                    <div class="form-group">
                        <label for="bobot_kriteria">Bobot Kriteria</label>
                        <input type="int" class="form-control" value="<?php echo $row['bobot_kriteria']?>"
                            name="bobot_kriteria" maxlength="11" required>
                    </div>
                    <div class="d-flex">
                        <input class="button" type="submit" name="update" value="Update">
                        <a class="button" href="?page=edit_bobot">Batal</a>
                    </div>
                </div>
            </div>
        </form>

        <?php
$conn->close();
?>
    </div>
</section>