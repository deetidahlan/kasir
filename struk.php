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
        <title>struk</title>
        <style>
            body{
                height:100vh; 
                display:flex; 
                flex-direction:column; 
                justify-content:center; 
                align-items:center;
            }
            hr{
                border: 1px solid black;
                width: 300px;
            }
            
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
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            
            h1 {
                margin-bottom: 20px;
                font-size: 24px;
                font-weight: bold;
                color: #337ab7;
            }
            
            p {
                margin-bottom: 10px;
                font-size: 18px;
            }
            
            hr {
                border: 1px solid black;
                width: 300px;
                margin: 20px auto;
            }
            
            /* Transaction Details Styles */
            
            .transaction-details {
                margin-bottom: 20px;
            }
            
            .transaction-details p {
                margin-bottom: 10px;
            }
            
            .transaction-details hr {
                margin: 10px auto;
            }
            
            /* Item List Styles */
            
            .item-list {
                margin-bottom: 20px;
            }
            
            .item-list li {
                margin-bottom: 10px;
                list-style: none;
            }
            
            .item-list li:before {
                content: "-";
                margin-right: 10px;
            }
            
            /* Total and Payment Styles */
            
            .total-and-payment {
                margin-bottom: 20px;
            }
            
            .total-and-payment p {
                margin-bottom: 10px;
                font-size: 18px;
                font-weight: bold;
            }
            
            /* Button Styles */
            
            button {
                background-color: #337ab7;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            
            button:hover {
                background-color: #23527c;
            }
            
            button a {
                text-decoration: none;
                color: #fff;
            }
            </style>
</head>
<body>
    <h1>BUKTI PEMBAYARAN</h1>
    
    <p>No. Transaksi = #<?php 
    $a=array(1,2,3,4,5,6,7,8,9,0);
    $random_keys=array_rand($a,5);
    echo $a[$random_keys[0]];
    echo $a[$random_keys[1]];
    echo $a[$random_keys[2]];
    echo $a[$random_keys[3]];
    echo $a[$random_keys[4]];
    ?></p>

<p>Tanggal:<?php 
    $mydate=getdate(date("U"));
    echo "$mydate[mday] $mydate[month], $mydate[year]";
    ?></p>

<hr>
<?php 
    foreach($_SESSION['keranjang'] as $key => $barang){ 
        echo $barang['nama']; 
        echo " Rp. " . $barang['harga']; 
        echo " x" . $barang['jmlh']; 
        echo " = " . $barang['total'] . "<br>"; 
    }
    ?>
    <hr>
    <p>Total: <?php echo  $totalBarang ;?></p>
    <p>Tunai: <?php echo $_SESSION['nominal'];?></p>
    <p>Kembalian: <?php $kembali = $_SESSION['nominal'] - $totalBarang; echo $kembali;?></p>
    <hr>
    <h3>Terimakasih atas kunjungan anda!</h3>    
    
    <button><a href="destroy.php">Kembali</a></button>
    
    </body>
    </html>
    