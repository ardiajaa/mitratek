<?php
session_start();
include 'koneksi.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM tugas WHERE nama_tugas LIKE '%$search%' OR deskripsi LIKE '%$search%'";
} else {
    $query = "SELECT * FROM tugas";
}
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tugas Projek Mitratek</title>
    <link rel="icon" type="image/png" href="https://i.imgur.com/g5CmzQS.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .header {
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo img {
            height: 40px;
        }
        h1 {
            color: #343a40;
            margin-top: -25px;
        }
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }
        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
            border: 2px solid #dee2e6;
        }
        .profile-icon:hover {
            background-color: #dee2e6;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border-radius: 8px;
            z-index: 1;
            margin-top: 8px;
            animation: fadeIn 0.2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-content a {
            color: #343a40;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.2s;
        }
        .dropdown-content a:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .dropdown-content i {
            margin-right: 8px;
            color: #6c757d;
        }
        .show {
            display: block;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            color: #6c757d;
        }
        .btn-sm {
            margin: 2px;
        }
        .footer-content {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="header">
            <div class="logo">
                <img src="https://mitratek.com/wp-content/uploads/2023/10/logo-20_08_2020.png" alt="Logo Mitratek">
            </div>
            <div class="profile-dropdown">
                <div class="profile-icon" onclick="toggleDropdown()">
                    <i class="fas fa-user"></i>
                </div>
                <div class="dropdown-content" id="profileDropdown">
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </div>
            </div>
        </div>

        <h1 class="text-center mb-4">Manajemen Projek Mitratek</h1>
        
        <div class="search-container">
            <a href="tambah.php" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Tambah Tugas
            </a>
            <form class="d-flex" method="GET" action="">
                <input class="form-control me-2" type="search" name="search" 
                       placeholder="Cari Tugas" aria-label="Cari" 
                       value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-outline-success" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Tugas</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_tugas']); ?></td>
                        <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                        <td>
                            <span class="badge <?php 
                                if ($row['status'] == 'Selesai') {
                                    echo 'bg-success';
                                } else if ($row['status'] == 'Belum Dimulai') {
                                    echo 'bg-danger';
                                } else {
                                    echo 'bg-warning';
                                }
                            ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($row['tanggal_deadline']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" 
                               onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <footer>
            <div class="footer-content">
                <p>&copy; 2025 Mitratek. Powered by Ardi.</p>
            </div>
        </footer>
    </div>

    <script>
        function toggleDropdown() {
            document.getElementById("profileDropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile-icon') && !event.target.matches('.profile-icon *')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>