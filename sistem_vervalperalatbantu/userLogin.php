<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>𝐔𝐬𝐞𝐫</title>
    <link rel="icon" href="image/dinsos.ico" type="image/x-icon">
    <style>
        body, html {
            height: 105%;
            margin: 0;
            font-family: Trebuchet MS;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background: linear-gradient(135deg, #2ecc71, #3498db, #f1c40f);
        }
        .login-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 45px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 520px;
            width: 100%;
        }
        .logo {
            width: 150px;
            margin-bottom: 10px;
        }
        h2 {
            color: #fffff;
            margin-bottom: 25px;
        }
        input[type="text"], input[type="password"] {
            color: black;
            text-align: center;
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background: linear-gradient(to right, #000000, #000000);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
            width: 100%;
        }
        input[type="submit"]:hover {
            background: linear-gradient(to right, #89CFF0, #89CFF0);
        }
        .switch-form {
            margin-top: 20px;
            color: #666;
        }
        .switch-form a {
            color: #3498db;
            text-decoration: none;
        }
        .switch-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <img src="image\dinsos.png" alt="Logo" class="logo">
            <h2>𝚂𝙴𝙻𝙰𝙼𝙰𝚃 𝙳𝙰𝚃𝙰𝙽𝙶!!</h2>
            <h2>𝐝𝐢 𝐃𝐢𝐧𝐚𝐬 𝐒𝐨𝐬𝐢𝐚𝐥 𝐊𝐚𝐛𝐮𝐩𝐚𝐭𝐞𝐧 𝐊𝐚𝐫𝐚𝐰𝐚𝐧𝐠</h2>
            <form action="homelogin_user.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
                
            </form>
            <div class="switch-form">
                <span id="userType" >Admin Login</span> | <a href="userlogin.php" onclick="toggleForm()">Switch to User</a>
            </div>
        </div>
    </div>

    <script>
        function toggleForm() {
            var userType = document.getElementById('userType');
            var switchLink = document.querySelector('.switch-form a');
            if (userType.textContent === 'User Login') {
                userType.textContent = 'Admin Login';
                switchLink.textContent = 'Switch to User';
            } else {
                userType.textContent = 'User Login';
                switchLink.textContent = 'Switch to Admin';
            }
        }
    </script>
</body>
</html>