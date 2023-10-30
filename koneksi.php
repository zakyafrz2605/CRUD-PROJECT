<?php

$conn = mysqli_connect("localhost", "root", "", "siperlu");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["confirm_password"]);

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username sudah ada!');
        </script>";
        return false; // tambahkan titik koma di sini
    }

    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi Password Tidak Sesuai!');
            </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        return true;
    } else {
        echo "Registrasi gagal: " . mysqli_error($conn);
        return false;
    }

    // Selanjutnya, Anda bisa menambahkan logika untuk menyimpan data pengguna ke dalam database sesuai kebutuhan.
}
?>
