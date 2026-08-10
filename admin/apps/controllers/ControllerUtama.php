<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../models/ModelUtama.php';
class ControllerUtama {
 private $db;
 private $siswa;
 public function __construct() {
 $database = new Database();
 $this->db = $database->getConnection();
 $this->siswa = new Siswa($this->db);
 }
 public function getAllSiswa() {
 $stmt = $this->siswa->read();
 $num = $stmt->rowCount();
 if ($num > 0) {
 $siswa_arr = array("status" => "success", "data" => array());
 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
 extract($row);
 $siswa_item = array(
 "id" => $id,
 "nis" => $nis,
 "nama" => $nama,
 "kelas" => $kelas
 );
 array_push($siswa_arr["data"], $siswa_item);
 }
 http_response_code(200);
 return json_encode($siswa_arr);
 } else {
 http_response_code(404);
 return json_encode(array("status" => "empty", "message" => "Data siswa tidak ditemukan."));
 }
 }
 public function storeSiswa($data) {
 if (!empty($data->nis) && !empty($data->nama) && !empty($data->kelas)) {
 $this->siswa->nis = $data->nis;
 $this->siswa->nama = $data->nama;
 $this->siswa->kelas = $data->kelas;
 if ($this->siswa->create()) {
 http_response_code(201);
 return json_encode(array("status" => "success", "message" => "Siswa berhasil ditambahkan."));
 } else {
 http_response_code(503);
 return json_encode(array("status" => "error", "message" => "Gagal menambahkan siswa."));
 }
 } else {
 http_response_code(400);
 return json_encode(array("status" => "warning", "message" => "Data tidak lengkap."));
 }
 }
}