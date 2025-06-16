<?php

include "data/function.php";
session_start();
if (!isset($_SESSION['ADMIN'])) {
    header("location: javascript://history.go(-1)");
    exit;
}
$uniqCode = $_GET['UC'];

$sql = $conn->query("SELECT * FROM foto_produk WHERE uniq_code = '$uniqCode'");
$gambarTerhapus = [];
while ($data = $sql->fetch_assoc()) {
    $gambar = $data['gambar'];
    $filePath = "asset/upload/$gambar";

    if (!in_array($gambar, $gambarTerhapus)) {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $gambarTerhapus[] = $gambar;
    }
}

$sql = "DELETE FROM foto_produk WHERE uniq_code = '$uniqCode'";
if ($conn->query($sql) === TRUE ){
    echo "<script>
        alert('Produk berhasil dihapus')
        location.replace (\"dashboard.php \")
    </script>";
} else {
    echo "Error updating record" . $conn->error;
}
$sql = "DELETE FROM product WHERE uniq_code = '$uniqCode'";

if ($conn->query($sql) === TRUE ){
    $_SESSION['notif'] = [
        'type' => 'success', 
        'text' => 'Data produk berhasil dihapus'
    ];
    header('Location: dashboard.php');
} else {
    echo "Error updating record" . $conn->error;
}
$conn->close();