<?php
header('Content-Type: application/json');
include "konek.php";

$stmt = $db->prepare("SELECT id, nama_hewan, jenis, harga FROM pet");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>