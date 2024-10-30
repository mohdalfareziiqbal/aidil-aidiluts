<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabel Harga dan Struk Transaksi</title>
</head>
<body>

<h2>Tabel Harga Barang</h2>
<table border="1">
    <tr><th>ID</th><th>Produk</th><th>Stok</th><th>Harga</th></tr>
    <?php
    // Data Barang
    $dataBarang = [
        ['ID' => 1, 'Produk' => 'Buavital', 'Stok' => 30, 'Harga' => 10890],
        ['ID' => 2, 'Produk' => 'Bango', 'Stok' => 21, 'Harga' => 21890],
        ['ID' => 3, 'Produk' => 'Sariwangi', 'Stok' => 10, 'Harga' => 9990],
        ['ID' => 4, 'Produk' => 'Shampo Baby', 'Stok' => 20, 'Harga' => 21990],
        ['ID' => 5, 'Produk' => 'Bedak', 'Stok' => 15, 'Harga' => 14990],
        ['ID' => 6, 'Produk' => 'Baju Bayi', 'Stok' => 20, 'Harga' => 35500],
        ['ID' => 7, 'Produk' => 'Jumper', 'Stok' => 25, 'Harga' => 49999]
    ];
    
    // Tampilkan data barang
    foreach ($dataBarang as $barang) {
        echo "<tr>
                <td>{$barang['ID']}</td>
                <td>{$barang['Produk']}</td>
                <td>{$barang['Stok']}</td>
                <td>Rp " . number_format($barang['Harga'], 0, ',', '.') . "</td>
              </tr>";
    }
    ?>
</table>

<h2>Form Transaksi</h2>
<form method="post" action="">
    <?php
    // Form input jumlah barang
    foreach ($dataBarang as $barang) {
        echo "<label>{$barang['Produk']} (Harga: Rp " . number_format($barang['Harga'], 0, ',', '.') . ") :</label> 
              <input type='number' name='jumlah[{$barang['ID']}]' min='0' max='{$barang['Stok']}' value='0'> <br>";
    }
    ?>
    <input type="submit" name="submit" value="Hitung Total">
</form>

<?php
if (isset($_POST['submit'])) {
    $totalTransaksi = 0;
    $transaksi = [];

    // Proses transaksi berdasarkan input
    foreach ($dataBarang as $barang) {
        $id = $barang['ID'];
        $jumlah = isset($_POST['jumlah'][$id]) ? (int)$_POST['jumlah'][$id] : 0;

        if ($jumlah > 0 && $jumlah <= $barang['Stok']) {
            $subtotal = $jumlah * $barang['Harga'];
            $totalTransaksi += $subtotal;

            // Simpan data transaksi
            $transaksi[] = [
                'Produk' => $barang['Produk'],
                'Jumlah' => $jumlah,
                'Harga' => $barang['Harga'],
                'Subtotal' => $subtotal
            ];
        }
    }

    // Hitung diskon
    $diskon = 0;
    if ($totalTransaksi >= 400000) {
        $diskon = $totalTransaksi * 0.35;
    } elseif ($totalTransaksi >= 250000) {
        $diskon = $totalTransaksi * 0.20;
    }
    $totalPembayaran = $totalTransaksi - $diskon;

    // Tampilkan Struk Transaksi
    echo "<h2>Struk Transaksi</h2>";
    echo "<pre>";
    echo "-----------------------------------\n";
    echo "          TOKO SERBA ADA\n";
    echo "   Jl. Mawar No. 123, Jakarta\n";
    echo "-----------------------------------\n";
    echo "Tanggal Transaksi: 30 Oktober 2024\n";
    echo "-----------------------------------\n";
    foreach ($transaksi as $item) {
        echo "{$item['Produk']} ({$item['Jumlah']}x)   Rp " . number_format($item['Subtotal'], 0, ',', '.') . "\n";
    }
    echo "-----------------------------------\n";
    echo "Total                 : Rp " . number_format($totalTransaksi, 0, ',', '.') . "\n";
    echo "Diskon                : Rp " . number_format($diskon, 0, ',', '.') . "\n";
    echo "-----------------------------------\n";
    echo "Total Pembayaran      : Rp " . number_format($totalPembayaran, 0, ',', '.') . "\n";
    echo "-----------------------------------\n";
    echo "     Terima Kasih atas\n";
    echo "     Kunjungan Anda!\n";
    echo "-----------------------------------\n";
    echo "</pre>";
}
echo "</br>";
echo "kelompok 9". "</br>";
echo "muhamad adil". "</br>";
echo "aidil nober defitra". "</br>";
?>

</body>
</html>