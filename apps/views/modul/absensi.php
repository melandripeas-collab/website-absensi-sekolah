<!-- FORM ABSENSI -->
        <section class="card-custom">

            <div class="section-title">
                <i class="bi bi-clipboard2"></i>
                <span>Form Absensi</span>
            </div>

            <form id="attendanceForm">

                <div class="form-grid">

                    <div>
                        <label class="form-label">
                            Pilih Siswa
                        </label>

                        <select class="form-select" id="siswaSelect" name="id_siswa">
                            <option value="">-- Pilih Siswa --</option>
                        </select>
                    </div>


                    <div>
                        <label class="form-label">
                            Status Kehadiran
                        </label>

                        <select class="form-select" id="statusSelect" name="status_kehadiran">
                            <option value="">-- Pilih Status --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Alpa">Alpa</option>
                        </select>
                    </div>


                    <div>
                        <label class="form-label">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            id="tanggalInput"
                            name="tanggal"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>


                    <div>
                        <label class="form-label">
                            Keterangan
                        </label>

                        <textarea
                            class="form-control"
                            name="keterangan"
                            id="keteranganInput"
                            placeholder="Masukkan keterangan (opsional)"
                        ></textarea>
                    </div>

                </div>


                <button class="btn btn-primary save-btn" type="submit">
                    <i class="bi bi-floppy me-2"></i>
                    Simpan Absensi
                </button>

            </form>

        </section>


        <!-- DATA ABSENSI -->
        <section class="card-custom">

            <div class="table-head">

                <div class="section-title mb-0">
                    <i class="bi bi-building"></i>
                    <span>Data Absensi</span>
                </div>

            </div>


            <!-- TABLE -->
            <div class="table-responsive">

                <table class="attendance-table" id="attendanceTable">

                    <thead>
                        <tr>
                            <th style="width:70px;">No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal</th>
                            <th>Status Kehadiran</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="attendanceTbody">
                        <!-- Rows will be populated dynamically via JS -->
                    </tbody>

                </table>

            </div>

        </section>

        <div class="modal fade" id="attendanceEditModal" tabindex="-1" aria-hidden="true" style="display:none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="attendanceEditForm">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data Absensi</h5>
                            <button type="button" class="btn-close" id="closeAttendanceEditModal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="editAbsensiIdInput" />

                            <div class="mb-3">
                                <label class="form-label">Siswa</label>
                                <select class="form-select" id="editAbsensiSiswaSelect" required>
                                    <option value="">-- Pilih Siswa --</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Kehadiran</label>
                                <select class="form-select" id="editAbsensiStatusSelect" required>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Alpa">Alpa</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="editAbsensiTanggalInput" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" id="editAbsensiKeteranganInput"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelAttendanceEditModal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>