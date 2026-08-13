<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../models/ModelUtama.php';

class ControllerUtama {
    private $db;
    private $siswa;
    private $absensi;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->siswa = new Siswa($this->db);
        $this->absensi = new Absensi($this->db);
    }

    public function getAllSiswa() {
        $stmt = $this->siswa->read();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            $siswa_arr = array("status" => "success", "data" => array());
            foreach ($rows as $row) {
                $siswa_item = array(
                    "id_siswa" => $row["id_siswa"],
                    "nis" => $row["nis"],
                    "nama_siswa" => $row["nama_siswa"],
                    "kelas" => $row["kelas"]
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

    public function getSiswaById($id) {
        $this->siswa->id_siswa = $id;
        $stmt = $this->siswa->readSingle();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            http_response_code(200);
            return json_encode(array("status" => "success", "data" => $row));
        }

        http_response_code(404);
        return json_encode(array("status" => "empty", "message" => "Data siswa tidak ditemukan."));
    }

    public function storeSiswa($data) {
        if (is_object($data) && !empty($data->nis) && !empty($data->nama_siswa) && !empty($data->kelas)) {
            $this->siswa->nis = $data->nis;
            $this->siswa->nama_siswa = $data->nama_siswa;
            $this->siswa->kelas = $data->kelas;

            if ($this->siswa->create()) {
                http_response_code(201);
                return json_encode(array("status" => "success", "message" => "Siswa berhasil ditambahkan."));
            }

            http_response_code(503);
            return json_encode(array("status" => "error", "message" => "Gagal menambahkan siswa."));
        }

        http_response_code(400);
        return json_encode(array("status" => "warning", "message" => "Data tidak lengkap."));
    }

    public function updateSiswa($data) {
        if (is_object($data) && !empty($data->id_siswa) && !empty($data->nis) && !empty($data->nama_siswa) && !empty($data->kelas)) {
            $this->siswa->id_siswa = $data->id_siswa;
            $this->siswa->nis = $data->nis;
            $this->siswa->nama_siswa = $data->nama_siswa;
            $this->siswa->kelas = $data->kelas;

            if ($this->siswa->update()) {
                http_response_code(200);
                return json_encode(array("status" => "success", "message" => "Siswa berhasil diperbarui."));
            }

            http_response_code(503);
            return json_encode(array("status" => "error", "message" => "Gagal memperbarui siswa."));
        }

        http_response_code(400);
        return json_encode(array("status" => "warning", "message" => "Data tidak lengkap."));
    }

    public function deleteSiswa($data) {
        $id = is_object($data) ? ($data->id_siswa ?? $data->id ?? null) : null;

        if (!empty($id)) {
            $this->siswa->id_siswa = $id;
            if ($this->siswa->delete()) {
                http_response_code(200);
                return json_encode(array("status" => "success", "message" => "Siswa berhasil dihapus."));
            }

            http_response_code(503);
            return json_encode(array("status" => "error", "message" => "Gagal menghapus siswa."));
        }

        http_response_code(400);
        return json_encode(array("status" => "warning", "message" => "ID siswa tidak valid."));
    }

    public function getAllAbsensi() {
        $stmt = $this->absensi->read();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            $absensi_arr = array("status" => "success", "data" => array());
            foreach ($rows as $row) {
                $absensi_item = array(
                    "id_absensi" => $row["id_absensi"],
                    "id_siswa" => $row["id_siswa"],
                    "status_kehadiran" => $row["status_kehadiran"],
                    "tanggal" => $row["tanggal"],
                    "keterangan" => $row["keterangan"],
                    "nis" => $row["nis"],
                    "nama_siswa" => $row["nama_siswa"],
                    "kelas" => $row["kelas"]
                );
                array_push($absensi_arr["data"], $absensi_item);
            }
            http_response_code(200);
            return json_encode($absensi_arr);
        } else {
            http_response_code(404);
            return json_encode(array("status" => "empty", "message" => "Data absensi tidak ditemukan."));
        }
    }

    public function getAbsensiById($id) {
        $this->absensi->id_absensi = $id;
        $stmt = $this->absensi->readSingle();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            http_response_code(200);
            return json_encode(array("status" => "success", "data" => $row));
        }

        http_response_code(404);
        return json_encode(array("status" => "empty", "message" => "Data absensi tidak ditemukan."));
    }

    public function storeAbsensi($data) {
        if (is_object($data) && !empty($data->id_siswa) && !empty($data->status_kehadiran) && !empty($data->tanggal)) {
            $this->absensi->id_siswa = $data->id_siswa;
            $this->absensi->status_kehadiran = $data->status_kehadiran;
            $this->absensi->tanggal = $data->tanggal;
            $this->absensi->keterangan = $data->keterangan ?? '';

            if ($this->absensi->create()) {
                http_response_code(201);
                return json_encode(array("status" => "success", "message" => "Absensi berhasil ditambahkan."));
            }

            http_response_code(503);
            return json_encode(array("status" => "error", "message" => "Gagal menambahkan absensi."));
        }

        http_response_code(400);
        return json_encode(array("status" => "warning", "message" => "Data absensi tidak lengkap."));
    }

    public function updateAbsensi($data) {
        if (is_object($data) && !empty($data->id_absensi) && !empty($data->id_siswa) && !empty($data->status_kehadiran) && !empty($data->tanggal)) {
            $this->absensi->id_absensi = $data->id_absensi;
            $this->absensi->id_siswa = $data->id_siswa;
            $this->absensi->status_kehadiran = $data->status_kehadiran;
            $this->absensi->tanggal = $data->tanggal;
            $this->absensi->keterangan = $data->keterangan ?? '';

            if ($this->absensi->update()) {
                http_response_code(200);
                return json_encode(array("status" => "success", "message" => "Absensi berhasil diperbarui."));
            }

            http_response_code(503);
            return json_encode(array("status" => "error", "message" => "Gagal memperbarui absensi."));
        }

        http_response_code(400);
        return json_encode(array("status" => "warning", "message" => "Data absensi tidak lengkap."));
    }

    public function deleteAbsensi($data) {
        $id = is_object($data) ? ($data->id_absensi ?? $data->id ?? null) : null;

        if (!empty($id)) {
            $this->absensi->id_absensi = $id;
            if ($this->absensi->delete()) {
                http_response_code(200);
                return json_encode(array("status" => "success", "message" => "Absensi berhasil dihapus."));
            }

            http_response_code(503);
            return json_encode(array("status" => "error", "message" => "Gagal menghapus absensi."));
        }

        http_response_code(400);
        return json_encode(array("status" => "warning", "message" => "ID absensi tidak valid."));
    }
}