<?php
include 'assets/php/db.php'; // Koneksi ke database


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input dari form
    $required_fields = ['id_transaksi', 'nama_pemesan', 'nama_barang', 'lama_sewa', 'tgl_pesan', 'tgl_kembali', 'harga_sewa', 'total_bayar', 'kartu_jaminan', 'status'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(['status' => 'error', 'message' => "Field $field wajib diisi."]);
            exit;
        }
    }

    // Ambil data dari form
    $id_transaksi = $_POST['id_transaksi'];
    $nama_pemesan = $_POST['nama_pemesan'];
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $lama_sewa = $_POST['lama_sewa'];
    $tgl_pesan = $_POST['tgl_pesan'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $harga_sewa = $_POST['harga_sewa'];
    $total_bayar = $_POST['total_bayar'];
    $kartu_jaminan = $_POST['kartu_jaminan'];
    $status = $_POST['status'];

    // Query untuk menyimpan data
    $query = "INSERT INTO tb_transaksi (id_transaksi, nama_pemesan, id_barang, nama_barang, lama_sewa, tgl_pesan, tgl_kembali, harga_sewa, total_bayar, kartu_jaminan, status) 
              VALUES ('$id_transaksi', '$nama_pemesan', '$id_barang', '$nama_barang', '$lama_sewa', '$tgl_pesan', '$tgl_kembali', '$harga_sewa', '$total_bayar', '$kartu_jaminan', '$status')";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
}
?>
