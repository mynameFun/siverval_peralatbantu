<?php
session_start();

// Simulasi data pengguna (dalam praktiknya, ini akan diambil dari database)
$users = [
    'user' => [
        'id' => 1,
        'username' => 'johndoe',
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'role' => 'user',
        'password' => 'userpass123'
    ],
    'admin' => [
        'id' => 2,
        'username' => 'adminuser',
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'role' => 'admin',
        'password' => 'adminpass123'
    ]
];

// Simulasi login (ganti dengan 'admin' untuk melihat profil admin)
$_SESSION['user'] = $users['user'];

// Proses update profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $_SESSION['user']['name'] = $_POST['name'];
    $_SESSION['user']['email'] = $_POST['email'];
    $success_message = "Profil berhasil diperbarui!";
}

// Proses ganti password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($old_password === $_SESSION['user']['password'] && $new_password === $confirm_password) {
        $_SESSION['user']['password'] = $new_password;
        $success_message = "Password berhasil diubah!";
    } else {
        $error_message = "Gagal mengubah password. Pastikan password lama benar dan password baru cocok.";
    }
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f0f2f5;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #2c3e50;
        }
        .profile-header {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px -20px;
        }
        .profile-header h1 {
            margin: 0;
            color: #fff;
        }
        .role-badge {
            background-color: #2ecc71;
            color: #fff;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8em;
            margin-left: 10px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .message {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-header">
            <h1><?php echo htmlspecialchars($user['name']); ?> 
                <span class="role-badge"><?php echo ucfirst(htmlspecialchars($user['role'])); ?></span>
            </h1>
        </div>

        <?php if (isset($success_message)): ?>
            <div class="message success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="message error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <h2>Informasi Pribadi</h2>
        <form method="post">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <button type="submit" name="update_profile">Perbarui Profil</button>
        </form>

        <h2>Ganti Password</h2>
        <form method="post">
            <label for="old_password">Password Lama:</label>
            <input type="password" id="old_password" name="old_password" required>

            <label for="new_password">Password Baru:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Konfirmasi Password Baru:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit" name="change_password">Ganti Password</button>
        </form>
    </div>
</body>
</html>