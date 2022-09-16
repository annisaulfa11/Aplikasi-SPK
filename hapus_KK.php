<?php
$id_kk=$_GET['id_kk'];

$sql1 = "DELETE FROM alternatif WHERE id_kk='$id_kk'";
$sql2 = "DELETE FROM analisa WHERE id_kk='$id_kk'";
$conn->query($sql1);
if ($conn->query($sql2) === TRUE) {
    header("Location:?page=data_KK");
}
$conn->close();
?>