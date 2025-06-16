<?php

include "data/function.php";
session_start();
if (!isset($_SESSION['ADMIN'])) {
    header("location: javascript://history.go(-1)");
    exit;
}
$G = $_GET['UC'];
$U =$_GET['produk'];

$sql = $conn->query("SELECT * FROM foto_produk WHERE gambar = '$G'");
$data = $sql->fetch_assoc();
$gambar = $data['gambar'];

if( file_exists("asset/upload/$gambar") ) {
    unlink("asset/upload/$gambar");
}

$sql = "DELETE FROM foto_produk WHERE gambar = '$G'";

if ($conn->query($sql) === TRUE ){
    $_SESSION['notif'] = [
        'type' => 'success', 
        'text' => 'Foto produk berhasil dihapus'
    ];
    header('Location: update.php?code='.$U);
} else {
    echo "Error updating record" . $conn->error;
}
$conn->close();