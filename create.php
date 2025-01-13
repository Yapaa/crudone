<?php
header('Content-Type: application/json');
include "konek.php";

$jsonInput = file_get_contents('php://input');
$data = json_decode($jsonInput, true);

if ($data === null) {
    echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    exit;
}

$nama_hewan = $data['nama_hewan'] ?? '';
$jenis = $data['jenis'] ?? '';
$harga = $data['harga'] ?? '';

if (empty($nama_hewan) || empty($jenis) || empty($harga)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

$stmt = $db->prepare("INSERT INTO pet (nama_hewan, jenis, harga) VALUES (?, ?, ?)");
$result = $stmt->execute([$nama_hewan, $jenis, $harga]);

if ($result) {
    echo json_encode(['success' => true, 'message' => 'Data successfully saved']);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>