<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM tugas WHERE id=$id";
mysqli_query($koneksi, $query);

header("Location: home.php");
exit();
?>