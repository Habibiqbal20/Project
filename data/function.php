<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "tesya_lobster";

$conn = new mysqli($servername, $username, $password, $dbName);


function signUp($data) {
    global $conn;

    $userType = htmlspecialchars($data['userType']);
    $email = htmlspecialchars($data['email']);
    $username = htmlspecialchars($data['username']);
    $password = mysqli_real_escape_string($conn, htmlspecialchars($data['password']));
    $confirmPassword = mysqli_real_escape_string($conn, htmlspecialchars($data['confirm-password']));

    $sql = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    if (mysqli_fetch_assoc($sql)) {
        echo "<script>
                    alert('Email telah digunakan');
            </script>";
        return false;
    }

    if ($password === $confirmPassword) {
        $query = "INSERT INTO user VALUES (
                'ID',
                '$userType',
                '$username',
                '$password',
                '$email'
            )";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    } else {
        return false;
        exit;
    }
}

function addProduct($data) {
    global $conn;

    $productName = htmlspecialchars($data["namaBarang"]);
    $price = str_replace(".", "", $data['harga']);
    $stok = htmlspecialchars($data["stok"]);
    $productDescriprion = htmlspecialchars($data["deskripsi"]);
    $uniqCode = htmlspecialchars($data["uniq-code"]);

    $images = uploadAddProduct();
    if ($images === false) {
        return false;
    }

    $jumlah = count($images);
    for ($i = 0; $i < $jumlah; $i++) {
        $queryFoto = "INSERT INTO foto_produk VALUES (
                'ID',
                '$productName',
                '$uniqCode',
                '$images[$i]'
            )";

        mysqli_query($conn, $queryFoto);
    };

    $query = "INSERT INTO product VALUES (
            'ID',
            '$productName',
            '$productDescriprion',
            '$stok',
            '$price',
            '$uniqCode'
        )";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function addAdmin($data) {
    global $conn;

    $namaAdmin = htmlspecialchars($data['namaAdmin']);
    $email = htmlspecialchars($data['email']);
    $noHp = htmlspecialchars($data['no-hp']);
    $pass = htmlspecialchars($data['pass']);

    $sql = "INSERT INTO admin VALUES (
        'ID',
        '$namaAdmin',
        '$noHp',
        '$email',
        '$pass'
    )";

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
}

function update($data) {
    global $conn;

    $productName = htmlspecialchars($data["namaBarang"]);
    $price = str_replace(".", "", $data['harga']);
    $stok = htmlspecialchars($data["stok"]);
    $productDescriprion = htmlspecialchars($data["deskripsi"]);
    $uniqCode = htmlspecialchars($data["uniq_code"]);

    $images = uploadAddProduct();
    if ($images === false) {
        return false;
    }
    $jumlah = count($images);
    for ($i = 0; $i < $jumlah; $i++) {
        $queryFoto = "INSERT INTO foto_produk VALUES (
                    'ID',
                    '$productName',
                    '$uniqCode',
                    '$images[$i]'
                )";

        mysqli_query($conn, $queryFoto);
    };

    $query = "UPDATE product SET
        product_name = '$productName',
        description = '$productDescriprion',
        stok = '$stok ',
        price= '$price',
        uniq_code = '$uniqCode'
        WHERE uniq_code = '$uniqCode'
        ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function updateAdmin($data) {
    global $conn;

    $ID = htmlspecialchars($data['id']);
    $namaAdmin = htmlspecialchars($data['namaAdmin']);
    $email = htmlspecialchars($data['email']);
    $noHp = htmlspecialchars($data['no-hp']);
    $pass = htmlspecialchars($data['pass']);
    
    $sql = "UPDATE admin SET
    nama_admin = '$namaAdmin',
    no_telp = '$noHp',
    email = '$email',
    password = '$pass'
    WHERE ID = '$ID'
    ";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function komentarUser($data) {

    global $conn;

    $namaUser = htmlspecialchars($data["nama"]);
    $komentarUser = htmlspecialchars($data["komentar"]);
    $idBarang = htmlspecialchars($data["id_barang"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $rating = htmlspecialchars($data["rating"]);
    $uniqCode = htmlspecialchars($data["kodeUnik"]);

    $images = uploadBaru();
    if ($images === false) {
        return false;
    }

    $jumlah = count($images);
    for ($i = 0; $i < $jumlah; $i++) {
        $queryFoto = "INSERT INTO foto_komentar VALUES (
                'ID',
                '$uniqCode',
                '$idBarang',
                '$images[$i]'
            )";

        mysqli_query($conn, $queryFoto);
    };

    $query = "INSERT INTO komentar VALUES (
            'ID',
            '$uniqCode',
            '$idBarang',
            '$namaUser',
            '$tanggal',
            '$komentarUser',
            '$rating'
        )";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function reply($data) {
    global $conn;

    $balasan = htmlspecialchars($data['balasan']);
    $idBarang = htmlspecialchars($data['id_barang']);
    $uniqCode = htmlspecialchars($data['uniq_code']);
    $tanggal = htmlspecialchars($data['tanggal']);

    $sql = "INSERT INTO reply VALUES (
        'ID',
        '$idBarang',
        '$uniqCode',
        '$balasan',
        '$tanggal'
    )";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function contactUs($data) {
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $whatsApp = htmlspecialchars($data['WhatsApp']);
    $saran = htmlspecialchars($data['saran']);

    $sql = "INSERT INTO kotak_saran VALUES (
        'ID',
        '$nama',
        '$whatsApp',
        '$saran'
    )";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function uploadBaru() {
    $uploadedFiles = [];
    $imageExtensionTrue = ['jpg', 'jpeg', 'png'];

    $fileCount = count($_FILES['images']['name']);

    if ($fileCount > 5) {
        return false;
        exit;
    }

    for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $_FILES['images']['name'][$i];
        $fileSize = $_FILES['images']['size'][$i];
        $error = $_FILES['images']['error'][$i];
        $tmpName = $_FILES['images']['tmp_name'][$i];

        if ($error === 4) {
            //echo "<script>alert('Pilih foto terlebih dahulu');</script>";
            continue;
        }

        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $imageExtensionTrue)) {
            echo "<script>alert('Format file yang anda masukkan salah: $fileName');</script>";
            continue;
        }

        if ($fileSize > 5000000) {
            echo "<script>alert('Ukuran file terlalu besar: $fileName');</script>";
            continue;
        }

        $newFileName = uniqid() . '.' . $imageExtension;
        $destination = 'asset/upload/' . $newFileName;

        if (move_uploaded_file($tmpName, $destination)) {
            $uploadedFiles[] = $newFileName;
        } else {
            echo "<script>alert('Gagal mengupload file: $fileName');</script>";
        }
    }
    //var_dump($uploadedFiles);die;
    return $uploadedFiles; // array berisi nama file yang berhasil diupload
}


function uploadAddProduct() {
    $uploadedFiles = [];
    $imageExtensionTrue = ['jpg', 'jpeg', 'png'];

    $fileCount = count($_FILES['images']['name']);

    if ($fileCount > 5) {
        return false;
        exit;
    }

    for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $_FILES['images']['name'][$i];
        $fileSize = $_FILES['images']['size'][$i];
        $error = $_FILES['images']['error'][$i];
        $tmpName = $_FILES['images']['tmp_name'][$i];

        if ($error === 4) {
            //echo "<script>alert('Pilih foto terlebih dahulu');</script>";
            continue;
        }

        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $imageExtensionTrue)) {
            echo "<script>alert('Format file yang anda masukkan salah: $fileName');</script>";
            continue;
        }

        if ($fileSize > 5000000) {
            echo "<script>alert('Ukuran file terlalu besar: $fileName');</script>";
            continue;
        }

        $newFileName = uniqid() . '.' . $imageExtension;
        $destination = 'asset/upload/' . $newFileName;

        if (move_uploaded_file($tmpName, $destination)) {
            $uploadedFiles[] = $newFileName;
        } else {
            echo "<script>alert('Gagal mengupload file: $fileName');</script>";
        }
    }
    //var_dump($uploadedFiles);die;
    return $uploadedFiles; // array berisi nama file yang berhasil diupload
}

function upload() {
    $fileName = $_FILES['images']['name'];
    $fileSize = $_FILES['images']['size'];
    $error = $_FILES['images']['error'];
    $tmpName = $_FILES['images']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                    alert('Pilih foto terlebih dahulu')
                    header(\"location: javascript://history.go(-1)\");
                </script>";
        return false;
    }

    $imageExtensionTrue = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));

    if (!in_array($imageExtension, $imageExtensionTrue)) {
        echo "<script>
                    alert('Format file yang anda masukkan salah')
                    header(\"location: javascript://history.go(-1)\");
                </script>";
        return false;
    }

    if ($fileSize > 5000000) {
        echo "<script>
                    alert('Ukuran file terlalu besar')
                    header(\"location: javascript://history.go(-1)\");
                </script>";
        return false;
    }


    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $imageExtension;

    move_uploaded_file($tmpName, 'asset/upload/' . $newFileName);

    return $newFileName;
}
