<?php
include 'data/function.php';
session_start();
if (!isset($_SESSION['ADMIN'])) {
    header("location: javascript://history.go(-1)");
    exit;
}
$id = $_GET['ID'];

$sql = "DELETE FROM admin WHERE ID = '$id'";

if ($conn->query($sql) === TRUE ){
    echo "<script>
        alert('Admin berhasil dihapus')
        location.replace (\"dashboard.php \")
    </script>";
} else {
    echo "Error updating record" . $conn->error;
}
$conn->close();