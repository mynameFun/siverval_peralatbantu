<?php
// Simulasi data permohonan (dalam praktik nyata, ini akan diambil dari database)
$applications = [
    ['id' => 1, 'name' => 'John Doe', 'type' => 'Izin Usaha', 'date' => '2024-06-25', 'status' => 'pending'],
    ['id' => 2, 'name' => 'Jane Smith', 'type' => 'Izin Bangunan', 'date' => '2024-06-24', 'status' => 'verified'],
    ['id' => 3, 'name' => 'Bob Johnson', 'type' => 'Izin Kerja', 'date' => '2024-06-23', 'status' => 'rejected'],
    ['id' => 4, 'name' => 'Alice Brown', 'type' => 'Izin Usaha', 'date' => '2024-06-22', 'status' => 'pending'],
    ['id' => 5, 'name' => 'Charlie Davis', 'type' => 'Izin Bangunan', 'date' => '2024-06-21', 'status' => 'verified'],
];

// Fungsi untuk mendapatkan detail permohonan
function getApplicationDetails($id) {
    global $applications;
    foreach ($applications as $app) {
        if ($app['id'] == $id) {
            return $app;
        }
    }
    return null;
}

// Proses filter dan pencarian
$filter = $_GET['filter'] ?? '';
$search = $_GET['search'] ?? '';

if ($filter || $search) {
    $applications = array_filter($applications, function($app) use ($filter, $search) {
        return (empty($filter) || $app['status'] == $filter) && 
               (empty($search) || stripos($app['name'], $search) !== false || stripos($app['type'], $search) !== false);
    });
}

// Proses verifikasi atau penolakan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $action = $_POST['action'] ?? '';
    $notes = $_POST['notes'] ?? '';

    if ($id && $action) {
        // Di sini Anda akan memperbarui status di database
        echo "<script>alert('Permohonan #$id telah $action. Catatan: $notes');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>𝐌𝐚𝐧𝐚𝐣𝐞𝐦𝐞𝐧 𝐏𝐞𝐫𝐦𝐨𝐡𝐨𝐧𝐚𝐧</title>
    <link rel="icon" href="image/dinsos.ico" type="image/x-icon">
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
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .filters {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .filters select, .filters input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .pending { background-color: #ffeaa7; color: #d35400; }
        .verified { background-color: #55efc4; color: #00b894; }
        .rejected { background-color: #fab1a0; color: #d63031; }
        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .view-btn { background-color: #3498db; color: #fff; }
        .view-btn:hover { background-color: #2980b9; }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 5px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover { color: #000; }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn-group {
            display: flex;
            justify-content: flex-end;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        .btn-approve { background-color: #2ecc71; color: #fff; margin-right: 10px; }
        .btn-reject { background-color: #e74c3c; color: #fff; }
        .btn-approve:hover { background-color: #27ae60; }
        .btn-reject:hover { background-color: #c0392b; }
    </style>
</head>
<body>
    <div class="container">
        <h1>𝘔𝘢𝘯𝘢𝘫𝘦𝘮𝘦𝘯 𝘗𝘦𝘳𝘮𝘰𝘩𝘰𝘯𝘢𝘯</h1>
        <div class="filters">
            <select id="statusFilter" onchange="applyFilters()">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="verified">Diverifikasi</option>
                <option value="rejected">Ditolak</option>
            </select>
            <input type="text" id="searchInput" placeholder="Cari nama atau jenis..." onkeyup="applyFilters()">
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): ?>
                    <tr>
                        <td><?php echo $app['id']; ?></td>
                        <td><?php echo $app['name']; ?></td>
                        <td><?php echo $app['type']; ?></td>
                        <td><?php echo $app['date']; ?></td>
                        <td><span class="status <?php echo $app['status']; ?>"><?php echo ucfirst($app['status']); ?></span></td>
                        <td><button class="action-btn view-btn" onclick="openModal(<?php echo $app['id']; ?>)">Lihat</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="applicationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Detail Permohonan</h2>
            <div id="applicationDetails"></div>
            <form id="verificationForm" method="post">
                <input type="hidden" id="applicationId" name="id">
                <div class="form-group">
                    <label for="notes">Catatan:</label>
                    <textarea id="notes" name="notes" rows="3"></textarea>
                </div>
                <div class="btn-group">
                    <button type="submit" name="action" value="verified" class="btn btn-approve">Setujui</button>
                    <button type="submit" name="action" value="rejected" class="btn btn-reject">Tolak</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function applyFilters() {
            var filter = document.getElementById('statusFilter').value;
            var search = document.getElementById('searchInput').value;
            window.location.href = '?filter=' + filter + '&search=' + search;
        }

        function openModal(id) {
            var modal = document.getElementById('applicationModal');
            var details = document.getElementById('applicationDetails');
            var applicationId = document.getElementById('applicationId');

            // Di sini Anda akan mengambil detail permohonan dari server
            // Untuk contoh ini, kita akan menggunakan data statis
            var app = <?php echo json_encode($applications); ?>.find(a => a.id === id);
            
            if (app) {
                details.innerHTML = `
                    <p><strong>ID:</strong> ${app.id}</p>
                    <p><strong>Nama:</strong> ${app.name}</p>
                    <p><strong>Jenis:</strong> ${app.type}</p>
                    <p><strong>Tanggal:</strong> ${app.date}</p>
                    <p><strong>Status:</strong> ${app.status}</p>
                `;
                applicationId.value = app.id;
            }

            modal.style.display = 'block';
        }

        function closeModal() {
            var modal = document.getElementById('applicationModal');
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('applicationModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>