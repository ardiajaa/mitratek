<?php
session_start(); // Mulai sesi
session_destroy(); // Hapus semua data sesi
header("Location: index.html"); // Redirect ke halaman login (index.html)
exit();
?>