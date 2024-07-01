<?php
// Simulasi data permohonan (dalam praktik nyata, ini akan diambil dari database)
$applications = [
    ['id' => 1, 'date' => '2024-01-05', 'type' => 'Kursi Roda', 'status' => 'Disetujui'],
    ['id' => 2, 'date' => '2024-01-10', 'type' => 'Tongkat', 'status' => 'Ditolak'],
    ['id' => 3, 'date' => '2024-02-15', 'type' => 'Alat Bantu Dengar', 'status' => 'Disetujui'],
    ['id' => 4, 'date' => '2024-02-20', 'type' => 'Kursi Roda', 'status' => 'Disetujui'],
    ['id' => 5, 'date' => '2024-03-05', 'type' => 'Tongkat', 'status' => 'Disetujui'],
    ['id' => 6, 'date' => '2024-03-15', 'type' => 'Alat Bantu Dengar', 'status' => 'Ditolak'],
    ['id' => 7, 'date' => '2024-04-01', 'type' => 'Kursi Roda', 'status' => 'Disetujui'],
    ['id' => 8, 'date' => '2024-04-10', 'type' => 'Tongkat', 'status' => 'Disetujui'],
    ['id' => 9, 'date' => '2024-05-05', 'type' => 'Alat Bantu Dengar', 'status' => 'Disetujui'],
    ['id' => 10, 'date' => '2024-05-20', 'type' => 'Kursi Roda', 'status' => 'Ditolak'],
];

// Fungsi untuk menghitung permohonan per bulan
function getApplicationsPerMonth($applications) {
    $monthlyData = [];
    foreach ($applications as $app) {
        $month = date('Y-m', strtotime($app['date']));
        if (!isset($monthlyData[$month])) {
            $monthlyData[$month] = 0;
        }
        $monthlyData[$month]++;
    }
    ksort($monthlyData);
    return $monthlyData;
}

// Fungsi untuk menghitung permohonan berdasarkan jenis alat bantu
function getApplicationsByType($applications) {
    $typeData = [];
    foreach ($applications as $app) {
        if (!isset($typeData[$app['type']])) {
            $typeData[$app['type']] = 0;
        }
        $typeData[$app['type']]++;
    }
    arsort($typeData);
    return $typeData;
}

$monthlyData = getApplicationsPerMonth($applications);
$typeData = getApplicationsByType($applications);

// Proses ekspor data jika diminta
if (isset($_POST['export'])) {
    $format = $_POST['format'];
    if ($format === 'excel') {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="laporan_permohonan.xls"');
        // Outputkan data dalam format Excel (contoh sederhana)
        echo "ID\tTanggal\tJenis Alat Bantu\tStatus\n";
        foreach ($applications as $app) {
            echo "{$app['id']}\t{$app['date']}\t{$app['type']}\t{$app['status']}\n";
        }
        exit;
    } elseif ($format === 'pdf') {
        // Untuk PDF, Anda perlu menggunakan library seperti FPDF atau TCPDF
        // Ini hanya contoh placeholder
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="laporan_permohonan.pdf"');
        echo "Ini adalah contoh PDF";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>𝗟𝗮𝗽𝗼𝗿𝗮𝗻 𝗱𝗮𝗻 𝗦𝘁𝗮𝘁𝗶𝘀𝘁𝗶𝗸</title>
    <link rel="icon" href="image/dinsos.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .chart-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
        .export-form {
            margin-top: 20px;
        }
        .export-form select {
            padding: 8px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>𝙻𝚊𝚙𝚘𝚛𝚊𝚗 𝚍𝚊𝚗 𝚂𝚝𝚊𝚝𝚒𝚜𝚝𝚒𝚔</h1>
        
        <div class="chart-container">
            <h2>𝐺𝑟𝑎𝑓𝑖𝑘 𝑃𝑒𝑟𝑚𝑜ℎ𝑜𝑛𝑎𝑛 𝑝𝑒𝑟 𝐵𝑢𝑙𝑎𝑛</h2>
            <canvas id="monthlyChart"></canvas>
        </div>
        
        <h2>𝘓𝘢𝘱𝘰𝘳𝘢𝘯 𝘗𝘦𝘳𝘮𝘰𝘩𝘰𝘯𝘢𝘯 𝘉𝘦𝘳𝘥𝘢𝘴𝘢𝘳𝘬𝘢𝘯 𝘑𝘦𝘯𝘪𝘴 𝘈𝘭𝘢𝘵 𝘉𝘢𝘯𝘵𝘶</h2>
        <table>
            <thead>
                <tr>
                    <th>𝐽𝑒𝑛𝑖𝑠 𝐴𝑙𝑎𝑡 𝐵𝑎𝑛𝑡𝑢</th>
                    <th>𝐽𝑢𝑚𝑙𝑎ℎ 𝑃𝑒𝑟𝑚𝑜ℎ𝑜𝑛𝑎𝑛</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($typeData as $type => $count): ?>
                    <tr>
                        <td><?php echo $type; ?></td>
                        <td><?php echo $count; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <h2>Ekspor Data</h2>
        <form method="post" class="export-form">
            <select name="format">
                <option value="excel">Excel</option>
                <option value="pdf">PDF</option>
            </select>
            <button type="submit" name="export" class="btn">Ekspor Data</button>
        </form>
    </div>

    <script>
        // Grafik permohonan per bulan
        var ctx = document.getElementById('monthlyChart').getContext('2d');
        var monthlyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_keys($monthlyData)); ?>,
                datasets: [{
                    label: 'Jumlah Permohonan',
                    data: <?php echo json_encode(array_values($monthlyData)); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Permohonan'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Permohonan per Bulan'
                    }
                }
            }
        });
    </script>
</body>
</html>