<?php
session_start();
if (isset($_SESSION['keranjang'])) {
    $totalBarang = 0;
    foreach($_SESSION['keranjang'] as $barang) {
        if(isset($barang['total'])) {
            $totalBarang += $barang['total'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar</title>
    <style>
        /* Global Styles */

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

h2 {
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

input[type="number"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
}

button[type="balik"], button[type="cetak"] {
  background-color: #337ab7;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button[type="balik"]:hover, button[type="cetak"]:hover {
  background-color: #23527c;
}

/* Total Bayar Styles */

p {
  margin-bottom: 20px;
  font-size: 18px;
  font-weight: bold;
  color: #337ab7;
}

/* Button Styles */

button[type="balik"] {
  margin-right: 20px;
}

button[type="cetak"] {
  background-color: #8bc34a;
  color: #fff;
}

button[type="cetak"]:hover {
  background-color: #689f38;
}
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="nominal"><h2>Masukkan Nominal Uang</h2></label>
        <input type="number" id="nominal" name="nominal" value="Jumlah Uang">
        <p>Total yang harus di bayar adalah: Rp. <?php echo $totalBarang;?></p>
        <button type="balik" name="balik" value="balik"><a href="index.php">Kembali</a></button>
        <button type="cetak" name="cetak" value="cetak">Bayar</button>
    </form>
    <?php
    if(isset($_POST['cetak'])){
        if(empty($_POST['nominal'])){
            echo "Nominal tidak boleh kosong";
            exit();
        } else {
            $nominal = $_POST['nominal'];
            if($nominal < $totalBarang) {
                echo "Uang yang dimasukkan kurang!";
                exit();
            } else {
                $_SESSION['nominal'] = $nominal;
                header('Location: struk.php');
                exit();
            }
        }
    }

   ?>
</body>
</html>