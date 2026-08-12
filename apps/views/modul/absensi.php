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

                <div class="search-box">
                    <input id="searchInput" class="form-control" placeholder="Cari..." />
                    <i class="bi bi-search"></i>
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