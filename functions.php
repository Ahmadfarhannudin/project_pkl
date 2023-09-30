<?php
$conn = mysqli_connect("Localhost", "root", "", "data_barang");

// function query($query){
//     global $conn;
//     $result = mysqli_query($conn, $query);
//     $rows = [];
//     while($row = mysqli_fetch_array($result)){
//         $rows [] = $row;
//     }
//     return $rows;
// }
function tambah($data){
    global $conn;
    $namabarang = $data["namabarang"];
    $deksripsi = $data["deksripsi"];
    $stock = $data["stock"];

    $query = "INSERT INTO stock
                VALUES
             ('', '$namabarang', '$deksripsi', '$stock')   
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

if(isset($_POST['masuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstokbarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang = '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstokbarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, keterangan, qty) VALUES('$barangnya', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock = '$tambahstocksekarangdenganquantity' WHERE idbarang = '$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'gagal';
        header('location:masuk.php');
    }
}
if(isset($_POST['keluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstokbarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang = '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstokbarang);

    $stocksekarang = $ambildatanya['stock'];
    if($stocksekarang >= $qty){
        //kalau stocknya cukup
        $tambahstocksekarangdenganquantity = $stocksekarang-$qty;

        $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, penerima, qty) VALUES('$barangnya', '$penerima', '$qty')");
        $updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock = '$tambahstocksekarangdenganquantity' WHERE idbarang = '$barangnya'");
        if($addtokeluar&&$updatestockmasuk){
        echo
        "<script>
        alert('barang berhasil dikeluarkan');
        document.location.href = 'keluar.php';
        </script>";
        } else {
            echo
            "<script>
            alert('barang gagal dikeluarkan');
            document.location.href = 'keluar.php';
            </script>";
        }
    } else {
        echo
        "<script>
        alert('stock saat ini tidak mencukupi');
        window.location.href = 'keluar.php';
        </script>";
    }
}
// function registrasi($data){
//     global $conn;
//     $username = strtolower(stripslashes($data["username"]));
//     $password = mysqli_real_escape_string($conn, $data["password"]);
//     $password2 = mysqli_real_escape_string($conn, $data["password2"]);

//     $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
//     if(mysqli_fetch_assoc($result)){
//         echo
//         "<script>
//         alert('gunakan username yang lain')
//         </script>";
//         return false;
//     }
//     if($password != $password2){
//         echo 
//         "<script>
//         alert('Konfirmasi password tidak sesuai')
//         </script>";
//         return false;
//     }

//     $password = password_hash($password, PASSWORD_DEFAULT);
//     mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')");
//     return mysqli_affected_rows($conn);
// }

// if(isset($_POST['edit'])){
//     $idbarang = $_POST['idb'];
//     $namabarang = $_POST['namabarang'];
//     $deksripsi = $_POST['deksripsi'];

//     $update = mysqli_query($conn, "UPDATE stock SET namabarang = '$namabarang', deksripsi = '$deksripsi' WHERE idbarang = '$idb'");
//     if($update){
//         header('location:masuk.php');
//     } else {
//         echo 'gagal';
//         header('location:masuk.php');
//     }
// }

//ubah data barang
function ubah($data){
    global $conn;
    $idbarang = $data["idbarang"];
    $namabarang = $data["namabarang"];
    $deksripsi = $data["deksripsi"];

    $query = "UPDATE stock SET
             namabarang = '$namabarang',
             deksripsi = '$deksripsi'
                WHERE idbarang = '$idbarang'         
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
//hapus barang
if(isset($_POST['hapus'])){
    $idbarang = $_POST['idbarang'];
    $hapus = mysqli_query($conn, "DELETE FROM stock WHERE idbarang = '$idbarang'");
    if($hapus){
        echo 
        "<script>
        alert('data berhasil dihapus');
        document.location.href = 'barang.php';
        </script>";
    } else {
        echo 
        "<script>
        alert('data gagal dihapus');
        document.location.href = 'barang.php';
        </script>";
    }
}
//hapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idbarang'];
    $qty = $_POST['kty'];
    $idm = $_POST['idmasuk'];

    $getstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $data = mysqli_fetch_array($getstock);
    $stok = $data['stock'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM masuk WHERE idmasuk='$idm'");

    if($update&&$hapusdata){
        echo
        "<script>
        alert('data berhasil dihapus');
        document.location.href = 'masuk.php';
        </script>";
    } else {
        echo
        "<script>
        alert('data gagal dihapus');
        document.location.href = 'keluar.php';
        </script>";
    }
}
//hapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idbarang'];
    $qty = $_POST['kty'];
    $idk = $_POST['idkeluar'];

    $getstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $data = mysqli_fetch_array($getstock);
    $stok = $data['stock'];

    $selisih = $stok+$qty;

    $update = mysqli_query($conn, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM keluar WHERE idkeluar='$idk'");

    if($update&&$hapusdata){
        echo
        "<script>
        alert('data berhasil dihapus');
        document.location.href = 'keluar.php';
        </script>";
    } else {
        echo
        "<script>
        alert('data gagal dihapus');
        document.location.href = 'keluar.php';
        </script>";
    }
}

//admin baru
if(isset($_POST['tambahadmin'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);
    $tambah = mysqli_query($conn, "INSERT INTO user(username, password) VALUES ('$username', '$password')");
    if($tambah){
        echo
        "<script>
        alert('data berhasil ditambahkan');
        document.location.href = 'admin.php';
        </script>";
    } else {
        echo
        "<script>
        alert('data gagal ditambahkan');
        document.location.href = 'admin.php';
        </script>";
    }
}

//edit admin
if(isset($_POST['editadmin'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $idnya = $_POST['id'];
    
    $password = password_hash($password, PASSWORD_DEFAULT);
    $update = mysqli_query($conn, "UPDATE user SET username='$username', password='$password' WHERE id=$idnya");
    if($update){
        echo
        "<script>
        alert('data berhasil diubah');
        document.location.href = 'admin.php';
        </script>";
    } else {
        echo
        "<script>
        alert('data gagal diubah');
        document.location.href = 'admin.php';
        </script>";
    }
}

//hapus admin
if(isset($_POST['hapusadmin'])){
    $idnya = $_POST['id'];
    $hapus = mysqli_query($conn, "DELETE FROM user WHERE id = '$idnya'");
    if($hapus){
        echo 
        "<script>
        alert('data berhasil dihapus');
        document.location.href = 'barang.php';
        </script>";
    } else {
        echo 
        "<script>
        alert('data gagal dihapus');
        document.location.href = 'barang.php';
        </script>";
    }
}
?>