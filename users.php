<?php
// File untuk menyimpan data pengguna
$usersFile = 'user_data.json';

// Inisialisasi array pengguna default jika file belum ada
$users = [
    'admin' => [
        'password' => password_hash('admin', PASSWORD_DEFAULT),
    ],
    'ardi' => [
        'password' => password_hash('ardi', PASSWORD_DEFAULT),
    ],
    'user' => [
        'password' => password_hash('user', PASSWORD_DEFAULT),
    ],
    'semeru' => [
        'password' => password_hash('semeru', PASSWORD_DEFAULT),
    ]
];

// Baca data pengguna dari file jika ada
if (file_exists($usersFile)) {
    $fileContent = file_get_contents($usersFile);
    $fileData = json_decode($fileContent, true);
    if ($fileData && is_array($fileData)) {
        $users = $fileData;
    }
}

// Fungsi untuk memeriksa keberadaan username
function isUsernameExists($username) {
    global $users;
    return isset($users[$username]);
}

// Fungsi untuk menambah pengguna baru
function addNewUser($username, $password) {
    global $users, $usersFile;
    
    if (isUsernameExists($username)) {
        return false;
    }
    
    // Tambahkan user baru
    $users[$username] = [
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ];
    
    // Simpan ke file
    $success = file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
    
    return $success !== false;
}

// Fungsi untuk verifikasi user
function verifyUser($username, $password) {
    global $users;
    
    if (isset($users[$username])) {
        return password_verify($password, $users[$username]['password']);
    }
    return false;
}

// Fungsi untuk mendapatkan data user
function getUserData($username) {
    global $users;
    
    if (isset($users[$username])) {
        $userData = $users[$username];
        unset($userData['password']); 
        return $userData;
    }
    return null;
}
?>