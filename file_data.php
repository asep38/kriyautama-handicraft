<?php 
require 'koneksi_data.php';

$functionName = htmlspecialchars($_GET['functionName']);

switch ($functionName) {
    case 'getDataProduk':
        getDataProduk();
        break;

    case 'getDataTopi':
        getDataTopi();
        break;
    
    default:
        # code...
        break;
}

function getDataProduk(){
    global $conn;

    $data = [];
    $query = mysqli_query($conn, "SELECT EXTRACT(MONTH FROM tanggal) AS bulan, idbarang, SUM(qty) AS total_qty FROM keluar GROUP BY EXTRACT(MONTH FROM tanggal), idbarang ORDER BY idbarang, bulan");

    while($row = mysqli_fetch_assoc($query)){
        $data[] = $row;
    }

    echo json_encode($data);
}

?>