<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_tugas = $_POST['nama_tugas'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];
    $tanggal_deadline = $_POST['tanggal_deadline'];

    $query = "UPDATE tugas SET nama_tugas='$nama_tugas', deskripsi='$deskripsi', status='$status', tanggal_deadline='$tanggal_deadline' WHERE id=$id";
    mysqli_query($koneksi, $query);

    header("Location: home.php");
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM tugas WHERE id=$id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Tugas</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="nama_tugas" class="form-label">Nama Tugas</label>
                <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" value="<?php echo $row['nama_tugas']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Belum Dimulai" <?php echo ($row['status'] == 'Belum Dimulai') ? 'selected' : ''; ?>>Belum Dimulai</option>
                    <option value="Dalam Proses" <?php echo ($row['status'] == 'Dalam Proses') ? 'selected' : ''; ?>>Dalam Proses</option>
                    <option value="Selesai" <?php echo ($row['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_deadline" class="form-label">Deadline</label>
                <input type="date" class="form-control" id="tanggal_deadline" name="tanggal_deadline" value="<?php echo $row['tanggal_deadline']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="home.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>