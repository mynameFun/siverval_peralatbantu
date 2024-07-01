<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>𝐅𝐨𝐫𝐦𝐮𝐥𝐢𝐫 𝐏𝐞𝐫𝐦𝐨𝐡𝐨𝐧𝐚𝐧 𝐀𝐥𝐚𝐭 𝐁𝐚𝐧𝐭𝐮</title>
    <link rel="icon" href="image/dinsos.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .open-form-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .open-form-btn:hover {
            background-color: #2980b9;
        }
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        .popup-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .popup-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            transform: scale(0.7);
            opacity: 0;
            transition: transform 0.3s, opacity 0.3s;
        }
        .popup-overlay.active .popup-content {
            transform: scale(1);
            opacity: 1;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 150px;
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            color: #34495e;
        }
        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        .file-input {
            margin-top: 10px;
        }
        .submit-btn {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: #27ae60;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            color: #95a5a6;
            cursor: pointer;
            transition: color 0.3s;
        }
        .close-btn:hover {
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <button class="open-form-btn">𝘉𝘶𝘬𝘢 𝘍𝘰𝘳𝘮𝘶𝘭𝘪𝘳 𝘗𝘦𝘳𝘮𝘰𝘩𝘰𝘯𝘢𝘯</button>

    <div class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <div class="logo">
            <img src="image\dinsos.png" alt="Logo" class="logo">
            </div>
            <h2>𝐹𝑜𝑟𝑚𝑢𝑙𝑖𝑟 𝑃𝑒𝑟𝑚𝑜ℎ𝑜𝑛𝑎𝑛 𝐴𝑙𝑎𝑡 𝐵𝑎𝑛𝑡𝑢</h2>
            <form id="permohonanForm">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="alat_bantu">Jenis Alat Bantu:</label>
                <select id="alat_bantu" name="alat_bantu" required>
                    <option value="">Pilih Alat Bantu</option>
                    <option value="kursi_roda">Kursi Roda</option>
                    <option value="tongkat">Tongkat</option>
                    <option value="alat_bantu_dengar">Alat Bantu Dengar</option>
                    <option value="kacamata">Kacamata</option>
                    <option value="lainnya">Lainnya</option>
                </select>

                <label for="alasan">Alasan Permohonan:</label>
                <textarea id="alasan" name="alasan" required></textarea>

                <label for="dokumen">Dokumen Pendukung:</label>
                <input type="file" id="dokumen" name="dokumen" class="file-input" accept=".pdf,.doc,.docx" required>

                <button type="submit" class="submit-btn">Kirim Permohonan</button>
            </form>
        </div>
    </div>

    <script>
        const openFormBtn = document.querySelector('.open-form-btn');
        const popupOverlay = document.querySelector('.popup-overlay');
        const closeBtn = document.querySelector('.close-btn');
        const form = document.getElementById('permohonanForm');

        openFormBtn.addEventListener('click', () => {
            popupOverlay.classList.add('active');
        });

        closeBtn.addEventListener('click', () => {
            popupOverlay.classList.remove('active');
        });

        popupOverlay.addEventListener('click', (e) => {
            if (e.target === popupOverlay) {
                popupOverlay.classList.remove('active');
            }
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            // Di sini Anda dapat menambahkan logika untuk mengirim data formulir ke server
            alert('Permohonan berhasil dikirim!');
            popupOverlay.classList.remove('active');
            form.reset();
        });
    </script>
</body>
</html>