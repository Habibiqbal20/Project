<?php

include 'data/function.php';
session_start();
if (!isset($_SESSION['ADMIN'])) {
    header("location: javascript://history.go(-1)");
    exit;
}
$uniqCode = $_GET['UC'];
$idProduk = $_GET['ID'];

$sql = $conn->query("SELECT * FROM foto_komentar WHERE kode_unik = '$uniqCode'");
$gambarTerhapus = [];
while ($data = $sql->fetch_assoc()) {
    $gambar = $data['foto'];
    $filePath = "asset/upload/$gambar";

    if (!in_array($gambar, $gambarTerhapus)) {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $gambarTerhapus[] = $gambar;
    }
}
$sql = "DELETE FROM komentar WHERE kode_unik = '$uniqCode'";

if ($conn->query($sql) === TRUE ){
    $_SESSION['notif'] = [
        'type' => 'success',
        'title' => 'Berhasil!',
        'text' => 'Komentar berhasil dihapus'
    ];
    echo "<script>
        location.replace (\"product.php?U=$idProduk \")
    </script>";
} else {
    echo "Error updating record" . $conn->error;
}
$conn->close();