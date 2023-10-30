<?php
require 'koneksi.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST)>0) {
        header("Location: dashboard.php");
        echo "<script>
                alert('user baru berhasil ditambahkan!');
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <img src="itenas2.png" alt="Header Image" class="img-fluid" style="width: 100%; height: 20%;">
    </header>
    <div class="container mt-3"> <!-- Mengurangi margin atas untuk konten -->
        <h1 class="text-center">HALAMAN REGISTRASI</h1>
        <div id="clock" class="text-center mb-4"></div>
        <form action="" method="post">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="register">REGISTER</button>
                            <a href="login.php" class="btn btn-secondary">LOGIN (jika punya akun)</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Fungsi untuk menampilkan jam waktu
        function showTime() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            const seconds = now.getSeconds();
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('clock').innerText = timeString;
        }
        
        // Memanggil fungsi showTime setiap 1 detik
        setInterval(showTime, 1000);
        
        // Memanggil showTime untuk menampilkan jam saat halaman pertama kali dimuat
        showTime();
    </script>
</body>
</html>
