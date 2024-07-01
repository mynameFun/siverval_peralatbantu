<?php
session_start();

// Simulasi data pengguna dan notifikasi (dalam praktiknya, ini akan diambil dari database)
$users = [
    'user' => [
        'id' => 1,
        'username' => 'johndoe',
        'name' => 'John Doe',
        'role' => 'user',
        'notifications' => [
            ['id' => 1, 'message' => 'Status permohonan Anda telah diubah menjadi "Disetujui"', 'read' => false, 'timestamp' => '2024-06-28 10:30:00'],
            ['id' => 2, 'message' => 'Permohonan baru Anda telah diterima dan sedang diproses', 'read' => true, 'timestamp' => '2024-06-27 14:15:00'],
        ]
    ],
    'admin' => [
        'id' => 2,
        'username' => 'adminuser',
        'name' => 'Admin User',
        'role' => 'admin',
        'notifications' => [
            ['id' => 3, 'message' => 'Permohonan baru dari John Doe memerlukan persetujuan', 'read' => false, 'timestamp' => '2024-06-29 09:45:00'],
            ['id' => 4, 'message' => 'Laporan bulanan telah siap untuk ditinjau', 'read' => false, 'timestamp' => '2024-06-28 16:20:00'],
        ]
    ]
];

// Simulasi login (ganti dengan 'admin' untuk melihat notifikasi admin)
$_SESSION['user'] = $users['user'];

$user = $_SESSION['user'];

// Fungsi untuk menandai notifikasi sebagai telah dibaca
function markAsRead($notificationId) {
    global $user;
    foreach ($user['notifications'] as &$notification) {
        if ($notification['id'] == $notificationId) {
            $notification['read'] = true;
            break;
        }
    }
}

// Proses penandaan notifikasi sebagai telah dibaca
if (isset($_POST['mark_read'])) {
    markAsRead($_POST['notification_id']);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        .notification {
            background-color: #fff;
            border-left: 4px solid #3498db;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
            transition: all 0.3s ease;
        }
        .notification:hover {
            box-shadow: 0 3px 6px rgba(0,0,0,0.16);
        }
        .notification.unread {
            background-color: #e8f4fd;
        }
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .notification-time {
            font-size: 0.8em;
            color: #7f8c8d;
        }
        .notification-message {
            margin-bottom: 10px;
        }
        .mark-read {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
        }
        .mark-read:hover {
            background-color: #2980b9;
        }
        .no-notifications {
            text-align: center;
            color: #7f8c8d;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Notifikasi <?php echo ucfirst($user['role']); ?></h1>
        
        <?php if (empty($user['notifications'])): ?>
            <p class="no-notifications">Tidak ada notifikasi saat ini.</p>
        <?php else: ?>
            <?php foreach ($user['notifications'] as $notification): ?>
                <div class="notification <?php echo $notification['read'] ? '' : 'unread'; ?>">
                    <div class="notification-header">
                        <span class="notification-time"><?php echo $notification['timestamp']; ?></span>
                        <?php if (!$notification['read']): ?>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="notification_id" value="<?php echo $notification['id']; ?>">
                                <button type="submit" name="mark_read" class="mark-read">Tandai Dibaca</button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="notification-message">
                        <?php echo htmlspecialchars($notification['message']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>