<?php
class Siswa {
    private $conn;
    private $table_name = "tb_siswa";

    public $id_siswa;
    public $nis;
    public $nama_siswa;
    public $kelas;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT id_siswa, nis, nama_siswa, kelas FROM " . $this->table_name . " ORDER BY id_siswa DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readSingle() {
        $query = "SELECT id_siswa, nis, nama_siswa, kelas FROM " . $this->table_name . " WHERE id_siswa = :id_siswa LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_siswa", $this->id_siswa);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nis, nama_siswa, kelas) VALUES (:nis, :nama_siswa, :kelas)";
        $stmt = $this->conn->prepare($query);

        $this->nis = htmlspecialchars(strip_tags($this->nis));
        $this->nama_siswa = htmlspecialchars(strip_tags($this->nama_siswa));
        $this->kelas = htmlspecialchars(strip_tags($this->kelas));

        $stmt->bindParam(":nis", $this->nis);
        $stmt->bindParam(":nama_siswa", $this->nama_siswa);
        $stmt->bindParam(":kelas", $this->kelas);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nis = :nis, nama_siswa = :nama_siswa, kelas = :kelas WHERE id_siswa = :id_siswa";
        $stmt = $this->conn->prepare($query);

        $this->nis = htmlspecialchars(strip_tags($this->nis));
        $this->nama_siswa = htmlspecialchars(strip_tags($this->nama_siswa));
        $this->kelas = htmlspecialchars(strip_tags($this->kelas));
        $this->id_siswa = htmlspecialchars(strip_tags($this->id_siswa));

        $stmt->bindParam(":nis", $this->nis);
        $stmt->bindParam(":nama_siswa", $this->nama_siswa);
        $stmt->bindParam(":kelas", $this->kelas);
        $stmt->bindParam(":id_siswa", $this->id_siswa);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_siswa = :id_siswa";
        $stmt = $this->conn->prepare($query);
        $this->id_siswa = htmlspecialchars(strip_tags($this->id_siswa));
        $stmt->bindParam(":id_siswa", $this->id_siswa);

        return $stmt->execute();
    }
}

class Absensi {
    private $conn;
    private $table_name = "tb_absensi";

    public $id_absensi;
    public $id_siswa;
    public $status_kehadiran;
    public $tanggal;
    public $keterangan;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT a.id_absensi, a.id_siswa, a.status_kehadiran, a.tanggal, a.keterangan, s.nis, s.nama_siswa, s.kelas
                  FROM " . $this->table_name . " a
                  LEFT JOIN tb_siswa s ON a.id_siswa = s.id_siswa
                  ORDER BY a.id_absensi DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readSingle() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_absensi = :id_absensi LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_absensi", $this->id_absensi);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (id_siswa, status_kehadiran, tanggal, keterangan) VALUES (:id_siswa, :status_kehadiran, :tanggal, :keterangan)";
        $stmt = $this->conn->prepare($query);

        $this->id_siswa = htmlspecialchars(strip_tags($this->id_siswa));
        $this->status_kehadiran = htmlspecialchars(strip_tags($this->status_kehadiran));
        $this->tanggal = htmlspecialchars(strip_tags($this->tanggal));
        $this->keterangan = htmlspecialchars(strip_tags($this->keterangan));

        $stmt->bindParam(":id_siswa", $this->id_siswa);
        $stmt->bindParam(":status_kehadiran", $this->status_kehadiran);
        $stmt->bindParam(":tanggal", $this->tanggal);
        $stmt->bindParam(":keterangan", $this->keterangan);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET id_siswa = :id_siswa, status_kehadiran = :status_kehadiran, tanggal = :tanggal, keterangan = :keterangan WHERE id_absensi = :id_absensi";
        $stmt = $this->conn->prepare($query);

        $this->id_siswa = htmlspecialchars(strip_tags($this->id_siswa));
        $this->status_kehadiran = htmlspecialchars(strip_tags($this->status_kehadiran));
        $this->tanggal = htmlspecialchars(strip_tags($this->tanggal));
        $this->keterangan = htmlspecialchars(strip_tags($this->keterangan));
        $this->id_absensi = htmlspecialchars(strip_tags($this->id_absensi));

        $stmt->bindParam(":id_siswa", $this->id_siswa);
        $stmt->bindParam(":status_kehadiran", $this->status_kehadiran);
        $stmt->bindParam(":tanggal", $this->tanggal);
        $stmt->bindParam(":keterangan", $this->keterangan);
        $stmt->bindParam(":id_absensi", $this->id_absensi);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_absensi = :id_absensi";
        $stmt = $this->conn->prepare($query);
        $this->id_absensi = htmlspecialchars(strip_tags($this->id_absensi));
        $stmt->bindParam(":id_absensi", $this->id_absensi);

        return $stmt->execute();
    }
}