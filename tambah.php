<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_tugas = $_POST['nama_tugas'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];
    $tanggal_deadline = $_POST['tanggal_deadline'];

    $query = "INSERT INTO tugas (nama_tugas, deskripsi, status, tanggal_deadline) VALUES ('$nama_tugas', '$deskripsi', '$status', '$tanggal_deadline')";
    mysqli_query($koneksi, $query);

    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Tugas</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_tugas" class="form-label">Nama Tugas</label>
                <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Belum Dimulai">Belum Dimulai</option>
                    <option value="Dalam Proses">Dalam Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_deadline" class="form-label">Deadline</label>
                <input type="date" class="form-control" id="tanggal_deadline" name="tanggal_deadline" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="home.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>