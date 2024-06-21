<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  color: #333;
  background-color: #f9f9f9;
}

h1 {
  margin-bottom: 10px;
  color: #337ab7;
}

/* Form Styles */

form {
  max-width: 400px;
  margin: 40px auto;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"], input[type="number"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
}

button[type="tambah"], button[type="bayar"], button[type="hapus"] {
  background-color: #337ab7;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button[type="tambah"]:hover, button[type="bayar"]:hover, button[type="hapus"]:hover {
  background-color: #23527c;
}

/* Table Styles */

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

th, td {
  padding: 10px;
  text-align: left;
  border: 1px solid #ddd;
}

th {
  background-color: #337ab7;
  color: #fff;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

/* Total Row Styles */

tr:last-child {
  background-color: #337ab7;
  color: #fff;
  font-weight: bold;
}

/* Hapus Button Styles */

a[href] {
  text-decoration: none;
  color: #337ab7;
}

a[href]:hover {
  color: #23527c;
}
    </style>
</head>
<body>
    <form action="" method="post">
        <h1>Masukan Data Barang</h1>
        <label for="nama">Nama barang:</label><br>
        <input type="text" id="nama" name="nama"><br>
        <label for="jmlh">Jumlah:</label><br>
        <input type="number" id="jmlh" name="jmlh"><br>
        <label for="harga">Harga: Rp.</label><br>
        <input type="number" id="harga" name="harga"><br></br>
        <button type="tambah" name="tambah" value="tambah">Tambah</button>
        <button type="bayar" name="bayar" value="bayar">Bayar</button>
        <button type="hapus" name="hapus" value="hapus"><a href="destroy.php">Kosongkan Keranjang</a></button>
    </form>

    <?php
    session_start();

    if(!isset($_SESSION['keranjang'])){
        $_SESSION['keranjang'] = array();
    }

    if(isset($_POST['tambah'])){
        if(empty($_POST['nama'])  && empty($_POST['jmlh']) && empty($_POST['harga'])){
            echo "Mohon isi semua kolom";
        }else{
            $nama = $_POST['nama'];
            $jmlh = $_POST['jmlh'];
            $harga = $_POST['harga'];
            $total = $jmlh * $harga;
            $barang = array(
                'nama' => $nama,
                'jmlh' => $jmlh,
                'harga' => $harga,
                'total' => $total
            );
            array_push($_SESSION['keranjang'], $barang);
        }
    }

    if(isset($_GET['hapus'])){
        $key = $_GET['hapus'];
        unset($_SESSION['keranjang'][$key]);
        header("location: index.php");
        exit;
    }

    if(count($_SESSION['keranjang']) > 0){
        echo "<table border = '1'>";
        echo "<tr><th>Nama Barang</th><th>Jumlah</th><th>Harga</th><th>Total</th> <th>Aksi</th> </tr>";
        $totals = 0;
        foreach($_SESSION['keranjang'] as $key => $barang){
            echo "<tr>";
            echo "<td>". $barang['nama']. "</td>";
            echo "<td>". $barang['jmlh']. "</td>";
            echo "<td>Rp. ". $barang['harga']. "</td>";
            echo "<td>Rp. ". $barang['total']. "</td>";
            echo "<td><a href='?hapus=". $key . "'>Hapus</a></td>";
            echo "</tr>";
            $totals+= $barang['total'];
        }
        echo "<tr>";
        echo "<td colspan='4'>Total keseluruhan</td>";
        echo "<td>". $totals."</td>";
        echo "</table>";
    }

    if(isset($_POST['bayar'])){
        if(count($_SESSION['keranjang']) == 0){
            echo "Keranjang kosong";
            exit();
        }else{
            header('location: bayar.php');
            exit();
        }
    }
?>
</body>
</html>