<?php
session_start();
require_once 'users.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validasi input
    if (empty($username) || empty($password) || empty($confirm_password)) {
        echo json_encode([
            'success' => false,
            'message' => 'Semua field harus diisi'
        ]);
        exit;
    }
    
    // Pastikan password dan konfirmasi password sama
    if ($password !== $confirm_password) {
        echo json_encode([
            'success' => false,
            'message' => 'Password dan konfirmasi password tidak sama'
        ]);
        exit;
    }
    
    // Cek apakah username sudah digunakan
    if (isUsernameExists($username)) {
        echo json_encode([
            'success' => false,
            'message' => 'Username sudah digunakan, silakan pilih username lain'
        ]);
        exit;
    }
    
    // Tambahkan user baru
    if (addNewUser($username, $password)) {
        echo json_encode([
            'success' => true,
            'message' => 'Pendaftaran berhasil! Silakan login dengan akun Anda'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Gagal mendaftarkan akun, silakan coba lagi'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
?>