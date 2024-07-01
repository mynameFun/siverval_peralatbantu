<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan dan FAQ</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f7f9;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        h1 {
            margin: 0;
        }
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .tab-button {
            background-color: #e0e0e0;
            border: none;
            padding: 10px 20px;
            margin: 0 5px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        .tab-button:hover, .tab-button.active {
            background-color: #3498db;
            color: #fff;
        }
        .tab-content {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .hidden {
            display: none;
        }
        h2 {
            color: #2c3e50;
            margin-top: 0;
        }
        .guide-step, .faq-item {
            margin-bottom: 1.5rem;
        }
        .guide-step h3, .faq-item h3 {
            color: #3498db;
            margin-bottom: 0.5rem;
        }
        .faq-item {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 1rem;
        }
        .faq-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bantuan dan FAQ</h1>
    </header>
    
    <div class="container">
        <div class="tabs">
            <button class="tab-button active" onclick="openTab('panduan')">Panduan Penggunaan</button>
            <button class="tab-button" onclick="openTab('faq')">FAQ</button>
        </div>

        <div id="panduan" class="tab-content">
            <h2>Panduan Penggunaan Sistem</h2>
            <div class="guide-step">
                <h3>1. Pendaftaran dan Login</h3>
                <p>Untuk menggunakan sistem, Anda perlu mendaftar terlebih dahulu. Klik tombol "Daftar" di halaman utama, isi formulir pendaftaran, lalu login dengan akun yang telah dibuat.</p>
            </div>
            <div class="guide-step">
                <h3>2. Mengajukan Permohonan</h3>
                <p>Setelah login, klik menu "Ajukan Permohonan". Isi formulir permohonan dengan lengkap dan unggah dokumen pendukung yang diperlukan.</p>
            </div>
            <div class="guide-step">
                <h3>3. Memeriksa Status Permohonan</h3>
                <p>Untuk memeriksa status permohonan, kunjungi halaman "Status Permohonan". Di sini Anda dapat melihat semua permohonan yang telah diajukan beserta statusnya.</p>
            </div>
            <div class="guide-step">
                <h3>4. Menerima Notifikasi</h3>
                <p>Sistem akan mengirimkan notifikasi saat ada perubahan status permohonan. Cek halaman "Notifikasi" secara berkala untuk informasi terbaru.</p>
            </div>
        </div>

        <div id="faq" class="tab-content hidden">
            <h2>Pertanyaan yang Sering Diajukan</h2>
            <div class="faq-item">
                <h3>Berapa lama proses persetujuan permohonan?</h3>
                <p>Proses persetujuan biasanya memakan waktu 3-5 hari kerja, tergantung pada kompleksitas permohonan dan kelengkapan dokumen yang diajukan.</p>
            </div>
            <div class="faq-item">
                <h3>Bagaimana jika permohonan saya ditolak?</h3>
                <p>Jika permohonan ditolak, Anda akan menerima notifikasi beserta alasannya. Anda dapat mengajukan permohonan ulang dengan memperhatikan feedback yang diberikan.</p>
            </div>
            <div class="faq-item">
                <h3>Apakah saya bisa mengubah informasi permohonan yang sudah diajukan?</h3>
                <p>Anda tidak dapat mengubah permohonan yang sudah diajukan. Namun, Anda dapat membatalkan permohonan yang belum diproses dan mengajukan permohonan baru.</p>
            </div>
            <div class="faq-item">
                <h3>Bagaimana cara menghubungi admin jika ada pertanyaan lebih lanjut?</h3>
                <p>Anda dapat menghubungi admin melalui menu "Kontak Kami" atau mengirim email ke support@contoh.com untuk pertanyaan lebih lanjut.</p>
            </div>
        </div>
    </div>

    <script>
        function openTab(tabName) {
            var i, tabContent, tabButtons;
            tabContent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = "none";
            }
            tabButtons = document.getElementsByClassName("tab-button");
            for (i = 0; i < tabButtons.length; i++) {
                tabButtons[i].className = tabButtons[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.className += " active";
        }
    </script>
</body>
</html>