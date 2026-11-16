<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Data_diri.html');
    exit;
}

$nama_lengkap = htmlspecialchars(trim($_POST['nama_lengkap'] ?? ''));

$tanggal_raw = $_POST['tanggal_lahir'] ?? '';
$tanggal_indo = '';

if (!empty($tanggal_raw)) {
    $bulan_indonesia = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    $bagian_tanggal = explode('-', $tanggal_raw);
    if (count($bagian_tanggal) === 3) {
        $tahun = $bagian_tanggal[0];
        $bulan = $bulan_indonesia[$bagian_tanggal[1]] ?? $bagian_tanggal[1];
        $hari  = (int) $bagian_tanggal[2]; 
        $tanggal_indo = $hari . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!empty($_POST['hobi']) && is_array($_POST['hobi'])) {
    $hobi_bersih = array_map('htmlspecialchars', $_POST['hobi']);
    $daftar_hobi = implode(', ', $hobi_bersih);
} else {
    $daftar_hobi = 'Tidak ada hobi yang dipilih';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Data Anda</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            background-color: #f9f9f9;
            margin: 0;
            padding: 30px 15px;
            display: flex;
            justify-content: center;
        }
        .container {
            background-color: #ffffff;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            padding: 25px 30px;
            width: 100%;
            max-width: 560px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }
        h1 {
            font-size: 26px;
            margin-top: 0;
            margin-bottom: 15px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eeeeee;
            color: #000000;
        }
        .data-row {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            font-size: 16px;
            line-height: 1.4;
        }
        .data-label {
            width: 135px;
            font-weight: bold;
            color: #000000;
            flex-shrink: 0;
        }
        .data-value {
            color: #111111;
        }
        .back-link {
            display: inline-block;
            margin-top: 14px;
            color: #007bff;
            text-decoration: none;
            font-size: 15px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Tampilan Data Anda</h1>

    <div class="data-row">
        <div class="data-label">Nama<br>Lengkap:</div>
        <div class="data-value"><?= $nama_lengkap ?></div>
    </div>

    <div class="data-row">
        <div class="data-label">Tanggal Lahir:</div>
        <div class="data-value"><?= htmlspecialchars($tanggal_indo) ?></div>
    </div>

    <div class="data-row">
        <div class="data-label">Hobi:</div>
        <div class="data-value"><?= $daftar_hobi ?></div>
    </div>

    <a href="Data_diri.html" class="back-link">&laquo; Kembali ke Form</a>
</div>

</body>
</html>