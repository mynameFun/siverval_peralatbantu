<?php
// Simulasi data (dalam praktik nyata, ini akan diambil dari database)
$applications = [
    ['id' => 1, 'name' => 'John Doe', 'type' => 'Izin Usaha', 'date' => '2024-06-25', 'status' => 'pending'],
    ['id' => 2, 'name' => 'Jane Smith', 'type' => 'Izin Bangunan', 'date' => '2024-06-24', 'status' => 'verified'],
    ['id' => 3, 'name' => 'Bob Johnson', 'type' => 'Izin Kerja', 'date' => '2024-06-23', 'status' => 'rejected'],
    ['id' => 4, 'name' => 'Alice Brown', 'type' => 'Izin Usaha', 'date' => '2024-06-22', 'status' => 'pending'],
    ['id' => 5, 'name' => 'Charlie Davis', 'type' => 'Izin Bangunan', 'date' => '2024-06-21', 'status' => 'verified'],
];

// Hitung jumlah permohonan berdasarkan status
$pending = count(array_filter($applications, function($app) { return $app['status'] == 'pending'; }));
$verified = count(array_filter($applications, function($app) { return $app['status'] == 'verified'; }));
$rejected = count(array_filter($applications, function($app) { return $app['status'] == 'rejected'; }));

// Fungsi untuk menghasilkan warna acak
function randomColor() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/dinsos.ico" type="image/x-icon">
    <title>𝐃𝐚𝐬𝐡𝐛𝐨𝐚𝐫𝐝 𝐀𝐝𝐦𝐢𝐧</title>
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
            background-color: ##FF5733;
            color: #333;
        }
        .container {
            display: flex;
            min-height: 10vh;
        }
        .sidebar {
            width: 300px;
            background-color: #EC5800;
            color: #ffff;
            padding: 15px;
            height: 1390px
        }
        .logo {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }
        .nav-menu {
            list-style-type: none;
        }
        .nav-item {
            margin-bottom: 15px;
        }
        .nav-link {
            color: #ecf0f1;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .nav-link:hover {
            background-color: #1F51FF;
        }
        .main-content {
            flex: 1;
            padding: 30px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 28px;
            font-weight: 600;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .summary-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 25px;
            width: 31%;
            box-shadow: 0 4px 6px rgba(0, 0, 0.1);
        }
        .summary-card h3 {
            font-size: 25px;
            margin-bottom: 10px;
        }
        .summary-card .count {
            font-size: 25px;
            font-weight: 600;
        }
        .recent-applications {
            background-color: #fff;
            border-radius: 30px;
            padding: 35px;
            box-shadow: 0 4px 6px rgba(0, 0, 0.1);
        }
        .recent-applications h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
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
            background-color: #f4f7fa;
            font-weight: 500;
        }
        .status {
            padding: 5px 9px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
        }
        .pending { background-color: #ffeaa7; color: #d35400; }
        .verified { background-color: #55efc4; color: #00b894; }
        .rejected { background-color: #fab1a0; color: #d63031; }
        .chart-container {
            width: 100%;
            max-width: 550px;
            margin: 30px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
        <img src="image/dinsos.ico" alt="icon" class="icon">
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="#" class="nav-link">Dashboard</a></li>
                    <li class="nav-item"><a href="applicationmanagement_admin.php" class="nav-link">Permohonan</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Pengguna</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Laporan</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Pengaturan</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="header">
                <h2>𝐃𝐚𝐬𝐡𝐛𝐨𝐚𝐫𝐝 𝐀𝐝𝐦𝐢𝐧</h2>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </header>
            <section class="summary">
                <div class="summary-card">
                    <h3>Tertunda</h3>
                    <div class="count"><?php echo $pending; ?></div>
                </div>
                <div class="summary-card">
                    <h3>Diverifikasi</h3>
                    <div class="count"><?php echo $verified; ?></div>
                </div>
                <div class="summary-card">
                    <h3>Ditolak</h3>
                    <div class="count"><?php echo $rejected; ?></div>
                </div>
            </section>
            <section class="recent-applications">
                <h2>Permohonan Terbaru</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($applications, 0, 5) as $app): ?>
                            <tr>
                                <td><?php echo $app['id']; ?></td>
                                <td><?php echo $app['name']; ?></td>
                                <td><?php echo $app['type']; ?></td>
                                <td><?php echo $app['date']; ?></td>
                                <td><span class="status <?php echo $app['status']; ?>"><?php echo ucfirst($app['status']); ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
            <div class="chart-container">
                <canvas id="applicationChart"></canvas>
            </div>
        </main>
    </div>
    <script>
        var ctx = document.getElementById('applicationChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Diverifikasi', 'Ditolak'],
                datasets: [{
                    data: [<?php echo $pending; ?>, <?php echo $verified; ?>, <?php echo $rejected; ?>],
                    backgroundColor: [
                        '<?php echo randomColor(); ?>',
                        '<?php echo randomColor(); ?>',
                        '<?php echo randomColor(); ?>'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Distribusi Status Permohonan'
                    }
                }
            }
        });
    </script>
</body>
</html>