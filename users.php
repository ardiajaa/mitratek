<?php
// File: users.php

// Menyimpan data pengguna dalam array asosiatif
// Password di-hash menggunakan password_hash() untuk keamanan
$users = [
    'admin' => [
        'password' => password_hash('admin', PASSWORD_DEFAULT),
    ],
    'ardi' => [
        'password' => password_hash('ardi', PASSWORD_DEFAULT),
    ],
    'semeru' => [
        'password' => password_hash('semeru', PASSWORD_DEFAULT),
    ]
];

// Fungsi untuk memverifikasi pengguna
function verifyUser($username, $password) {
    global $users;
    
    if (isset($users[$username])) {
        return password_verify($password, $users[$username]['password']);
    }
    return false;
}

// Fungsi untuk mendapatkan data pengguna
function getUserData($username) {
    global $users;
    
    if (isset($users[$username])) {
        $userData = $users[$username];
        unset($userData['password']); // Jangan kembalikan hash password
        return $userData;
    }
    return null;
}
?>