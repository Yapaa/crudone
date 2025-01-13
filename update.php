<?php
header('Content-Type: application/json');
include "konek.php";

$id = $_POST['id'] ?? '';
$nama_hewan = $_POST['nama_hewan'] ?? '';
$jenis = $_POST['jenis'] ?? '';
$harga = $_POST['harga'] ?? '';

if (empty($id) || empty($nama_hewan) || empty($jenis) || empty($harga)) {
    echo json_encode([
        'success' => false,
        'message' => 'Semua field harus diisi.'
    ]);
    exit;
}

try {
    $stmt = $db->prepare("UPDATE pet SET nama_hewan = ?, jenis = ?, harga = ? WHERE id = ?");
    $result = $stmt->execute([$nama_hewan, $jenis, $harga, $id]);

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Data berhasil diperbarui.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Gagal memperbarui data.'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    ]);
}
?>