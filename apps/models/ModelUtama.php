<?php
class Siswa {
private $conn;
 private $table_name = "tb_siswa";
 public $id;
 public $nis;
 public $nama;
 public $kelas;
 public function __construct($db) {
 $this->conn = $db;
 }
 public function read() {
 $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
 $stmt = $this->conn->prepare($query);
 $stmt->execute();
 return $stmt;
 }
 public function create() {
 $query = "INSERT INTO " . $this->table_name . " (nis, nama, kelas) VALUES (:nis, :nama_siswa, :kelas)";
 $stmt = $this->conn->prepare($query);
 $this->nis = htmlspecialchars(strip_tags($this->nis));
 $this->nama = htmlspecialchars(strip_tags($this->nama));
 $this->kelas = htmlspecialchars(strip_tags($this->kelas));
 $stmt->bindParam(":nis", $this->nis);
 $stmt->bindParam(":nama_siswa", $this->nama);
 $stmt->bindParam(":kelas", $this->kelas);
 if($stmt->execute()) {
 return true;
 }
 return false;
 }
}