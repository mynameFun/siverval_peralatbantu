<?php
// Simulasi data user dan permohonan (dalam praktik nyata, ini akan diambil dari database)
$userId = 1; // Anggap ini adalah ID user yang sedang login
$userName = "John Doe";

$applications = [
    ['id' => 1, 'user_id' => 1, 'type' => 'Kursi Roda', 'date' => '2024-05-20', 'status' => 'Dalam Proses'],
    ['id' => 2, 'user_id' => 1, 'type' => 'Tongkat', 'date' => '2024-04-15', 'status' => 'Disetujui'],
    ['id' => 3, 'user_id' => 1, 'type' => 'Alat Bantu Dengar', 'date' => '2024-03-10', 'status' => 'Ditolak'],
    ['id' => 4, 'user_id' => 1, 'type' => 'Kursi Roda', 'date' => '2024-02-05', 'status' => 'Disetujui'],
    ['id' => 5, 'user_id' => 1, 'type' => 'Tongkat', 'date' => '2024-01-01', 'status' => 'Disetujui'],
];

// Fungsi untuk mendapatkan permohonan terkini
function getCurrentApplication($applications) {
    foreach ($applications as $app) {
        if ($app['status'] == 'Dalam Proses') {
            return $app;
        }
    }
    return null;
}

$currentApplication = getCurrentApplication($applications);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/dinsos.ico" type="image/x-icon">
    <title>𝐃𝐚𝐬𝐡𝐛𝐨𝐚𝐫𝐝 𝐔𝐬𝐞𝐫</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 1859px;
            margin:  auto;
            padding: 5px;
        }
        header {
            background-color: #FF5F1F;
            color: #fff;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h1, h2 {
            color: #000000;
            margin-bottom: 20px;
        }
        .card {
            background-color: #ADD8E6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .current-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ebf5fb;
            border-left: 5px solid #3498db;
            padding: 15px;
            border-radius: 5px;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 550;
        }
        .status-pending { background-color: #ffeaa7; color: #d35400; }
        .status-approved { background-color: #55efc4; color: #00b894; }
        .status-rejected { background-color: #fab1a0; color: #d63031; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .icon {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
            <img src="image/dinsos.ico" alt="icon" class="icon">
                <div>Selamat datang, <?php echo $userName; ?></div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <h2><i class="fas fa-clipboard-check icon"></i>Status Permohonan Terkini</h2>
            <?php if ($currentApplication): ?>
                <div class="current-status">
                    <div>
                        <strong>Jenis Alat Bantu:</strong> <?php echo $currentApplication['type']; ?><br>
                        <strong>Tanggal Pengajuan:</strong> <?php echo $currentApplication['date']; ?>
                    </div>
                    <span class="status-badge status-pending"><?php echo $currentApplication['status']; ?></span>
                </div>
            <?php else: ?>
                <p>Tidak ada permohonan yang sedang diproses.</p>
            <?php endif; ?>
        </div>

        <div class="card">
            <h2><i class="fas fa-history icon"></i>Riwayat Permohonan</h2>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis Alat Bantu</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applications as $index => $app): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $app['type']; ?></td>
                            <td><?php echo $app['date']; ?></td>
                            <td>
                                <span class="status-badge 
                                    <?php 
                                    echo $app['status'] == 'Disetujui' ? 'status-approved' : 
                                        ($app['status'] == 'Ditolak' ? 'status-rejected' : 'status-pending'); 
                                    ?>">
                                    <?php echo $app['status']; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a href="#" class="btn"><i class="fas fa-plus icon"></i>Ajukan Permohonan Baru</a>
    </div>
</body>
</html>