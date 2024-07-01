<?php
// Simulasi data pengguna (dalam praktik nyata, ini akan diambil dari database)
$users = [
    ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'Admin', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'User', 'status' => 'Active'],
    ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'role' => 'User', 'status' => 'Inactive'],
    ['id' => 4, 'name' => 'Alice Brown', 'email' => 'alice@example.com', 'role' => 'User', 'status' => 'Active'],
    ['id' => 5, 'name' => 'Charlie Davis', 'email' => 'charlie@example.com', 'role' => 'User', 'status' => 'Active'],
];

// Fungsi untuk mendapatkan pengguna berdasarkan ID
function getUserById($id) {
    global $users;
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';
    $status = $_POST['status'] ?? '';

    if ($action == 'add') {
        // Simulasi penambahan pengguna baru
        $newId = max(array_column($users, 'id')) + 1;
        $users[] = ['id' => $newId, 'name' => $name, 'email' => $email, 'role' => $role, 'status' => $status];
        $message = "Pengguna baru berhasil ditambahkan.";
    } elseif ($action == 'edit' && $id) {
        // Simulasi edit pengguna
        foreach ($users as &$user) {
            if ($user['id'] == $id) {
                $user['name'] = $name;
                $user['email'] = $email;
                $user['role'] = $role;
                $user['status'] = $status;
                break;
            }
        }
        $message = "Data pengguna berhasil diperbarui.";
    } elseif ($action == 'toggle_status' && $id) {
        // Simulasi toggle status pengguna
        foreach ($users as &$user) {
            if ($user['id'] == $id) {
                $user['status'] = ($user['status'] == 'Active') ? 'Inactive' : 'Active';
                break;
            }
        }
        $message = "Status pengguna berhasil diubah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>𝐌𝐚𝐧𝐚𝐣𝐞𝐦𝐞𝐧 𝐏𝐞𝐧𝐠𝐠𝐮𝐧𝐚 𝐀𝐝𝐦𝐢𝐧</title>
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
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color: #3498db;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-top: 20px;
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
        .active { background-color: #55efc4; color: #00b894; }
        .inactive { background-color: #fab1a0; color: #d63031; }
        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 5px;
        }
        .edit-btn { background-color: #fdcb6e; color: #000; }
        .toggle-btn { background-color: #81ecec; color: #000; }
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
            max-width: 500px;
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
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>𝑀𝑎𝑛𝑎𝑗𝑒𝑚𝑒𝑛 𝑃𝑒𝑛𝑔𝑔𝑢𝑛𝑎 𝐴𝑑𝑚𝑖𝑛</h1>
        <?php if (isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <button class="btn btn-primary" onclick="openModal()">Tambah Pengguna</button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Peran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td><span class="status <?php echo strtolower($user['status']); ?>"><?php echo $user['status']; ?></span></td>
                        <td>
                            <button class="action-btn edit-btn" onclick="openModal(<?php echo $user['id']; ?>)">Edit</button>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="action" value="toggle_status">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <button type="submit" class="action-btn toggle-btn">
                                    <?php echo $user['status'] == 'Active' ? 'Nonaktifkan' : 'Aktifkan'; ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Tambah Pengguna</h2>
            <form id="userForm" method="post">
                <input type="hidden" id="userId" name="id">
                <input type="hidden" id="action" name="action" value="add">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="role">Peran:</label>
                    <select id="role" name="role">
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id = null) {
            var modal = document.getElementById('userModal');
            var form = document.getElementById('userForm');
            var title = document.getElementById('modalTitle');
            var action = document.getElementById('action');
            var userId = document.getElementById('userId');

            if (id) {
                // Edit mode
                title.textContent = 'Edit Pengguna';
                action.value = 'edit';
                userId.value = id;
                
                // Fetch user data and populate form
                var user = <?php echo json_encode($users); ?>.find(u => u.id == id);
                if (user) {
                    document.getElementById('name').value = user.name;
                    document.getElementById('email').value = user.email;
                    document.getElementById('role').value = user.role;
                    document.getElementById('status').value = user.status;
                }
            } else {
                // Add mode
                title.textContent = 'Tambah Pengguna';
                action.value = 'add';
                userId.value = '';
                form.reset();
            }

            modal.style.display = 'block';
        }

        function closeModal() {
            var modal = document.getElementById('userModal');
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('userModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>