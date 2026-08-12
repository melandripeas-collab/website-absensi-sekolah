<!-- FORM ABSENSI -->
        <section class="card-custom">

            <div class="section-title">
                <i class="bi bi-clipboard2"></i>
                <span>Form Absensi</span>
            </div>

            <form>

                <div class="form-grid">

                    <div>
                        <label class="form-label">
                            Pilih Siswa
                        </label>

                        <select class="form-select" id="siswaSelect">
                            <option value="">-- Pilih Siswa --</option>
                            <?php foreach ($students as $student): ?>
                                <option value="<?= $student['id_siswa'] ?>">
                                    <?= htmlspecialchars($student['nis'] . ' - ' . $student['nama_siswa']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div>
                        <label class="form-label">
                            Status Kehadiran
                        </label>

                        <select class="form-select">
                            <option>-- Pilih Status --</option>
                            <option>Hadir</option>
                            <option>Izin</option>
                            <option>Sakit</option>
                            <option>Alpa</option>
                        </select>
                    </div>


                    <div>
                        <label class="form-label">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            value="2026-08-06">
                    </div>


                    <div>
                        <label class="form-label">
                            Keterangan
                        </label>

                        <textarea
                            class="form-control"
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
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari siswa..."
                        id="searchInput">

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

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>262701012008</td>
                            <td>Andi Pratama</td>
                            <td>2026-08-06</td>  
                            <td>
                                <span class="status status-hadir">
                                    <i class="bibi-check-circle-fill"></i>
                                    hadir
                                </span> 
                            </td>
                            <td> - </td>
                            <td>
                                <button class="action-btn edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button class="action-btn delete">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>


            <!-- TABLE FOOTER -->
            <div class="table-footer">

                <span>
                    Menampilkan 1 - <?= count($attendance) ?> dari <?= count($attendance) ?> data
                </span>

                <div class="pagination-custom">
                    <button>«</button>
                    <button class="active">1</button>
                    <button>»</button>
                </div>

            </div>

        </section>