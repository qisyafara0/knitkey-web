<?php
// Konfigurasi koneksi database
$host = "localhost";
$username = "root";
$password = "";
$database = "knitkey-web";

// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi pesan
$success = "";
$error = "";

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan bersihkan input
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    // Validasi sederhana
    if ($name && $email && $message) {
        // Siapkan query
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $success = "Pesan Anda telah berhasil dikirim!";
        } else {
            $error = "Terjadi kesalahan saat menyimpan pesan.";
        }

        $stmt->close();
    } else {
        $error = "Mohon lengkapi semua kolom.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KnitKey - Gantungan Kunci Rajut Handmade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.html">
                <img src="img/KnitKey.png" alt="KnitKey Logo"> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.html">Produk</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="bmc.html">BMC</a></li>
                    <li class="nav-item ms-lg-3"><a class="nav-link whatsapp-link" href="https://wa.me/6283812834929?text=Halo%20KnitKey,%20saya%20tertarik%20dengan%20produk%20Anda." target="_blank"><i class="fab fa-whatsapp me-2"></i> Pesan Via WhatsApp</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="py-5 text-center section-bg" style="background: url('img/product-header.jpg') no-repeat center center/cover;">
        <div class="container">
            <h1 class="display-5 fw-bold knitkey-text-darkk">Hubungi Kami</h1>
            <p class="lead text-muted knitkey-text-dark">Menerima semua Kritik, Saran dan Komplain</p>
        </div>
    </header>

    <!-- Featured Products Short -->
    <main>
        <section class="container py-5">
            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php elseif ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="contact.php" class="mx-auto" style="max-width: 600px;">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Nama Anda">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Aktif</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="email@contoh.com">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>
                <button type="submit" class="btn btn-warning">Kirim Pesan</button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer py-5 mt-5">
        <div class="container">
            <div class="row">
                <!-- Kolom Logo dan Informasi Brand -->
                <div class="col-md-4 mb-4 mb-md-0 text-center text-md-start">
                    <a class="footer-brand" href="#">
                        <img src="img/knitkey-footer.png" alt="KnitKey Logo" height="50"> <!-- Pastikan path logo benar -->
                    </a>
                    <p class="text-knitkey-light mt-3 mb-0">Rajutan Lucu untuk Kunci Anda!</p>
                    <p class="text-knitkey-light small">Dibuat dengan cinta di Semarang, Indonesia.</p>
                </div>

                <!-- Kolom Navigasi -->
                <div class="col-md-4 mb-4 mb-md-0 text-center">
                    <h5 class="text-knitkey-light mb-3">Navigasi</h5>
                    <ul class="list-unstyled footer-nav d-flex justify-content-center">
                        <li class="nav-item mx-2"><a class="nav-link" href="index.html">Beranda</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="products.html">Produk</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="contact.php">Kontak</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="bmc.html">BMC</a></li>
                    </ul>
                </div>

                <!-- Kolom Sosial Media / Kontak Cepat (Opsional) -->
                <div class="col-md-4 text-center text-md-end">
                    <h5 class="text-knitkey-light mb-3">Ikuti Kami</h5>
                    <div class="social-icons mb-3">
                        <!-- Gunakan ikon Font Awesome jika sudah terintegrasi -->
                        <a href="https://www.instagram.com/knit.key_" target="_blank" class="text-knitkey-light me-3"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="https://wa.me/6283812834929" target="_blank" class="text-knitkey-light"><i class="fab fa-whatsapp fa-2x"></i></a>
                    </div>
                    <p class="text-knitkey-light small mb-0">&copy; 2025 KnitKey. Semua hak dilindungi.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>