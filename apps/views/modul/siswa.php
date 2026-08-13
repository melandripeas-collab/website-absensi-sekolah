<!-- FORM TAMBAH SISWA -->
<section class="card-custom">

	<div class="section-title">
		<i class="bi bi-person-plus"></i>
		<span>Tambah Siswa</span>
	</div>

	<form id="studentForm">
		<div class="form-grid">
			<div>
				<label class="form-label">NIS</label>
				<input class="form-control" name="nis" id="nisInput" required />
			</div>

			<div>
				<label class="form-label">Nama Siswa</label>
				<input class="form-control" name="nama_siswa" id="namaInput" required />
			</div>

			<div>
				<label class="form-label">Kelas</label>
				<input class="form-control" name="kelas" id="kelasInput" required />
			</div>
		</div>

		<button class="btn btn-primary save-btn" type="submit">
			<i class="bi bi-plus-circle me-2"></i>
			Tambah Siswa
		</button>
	</form>

</section>

<!-- DAFTAR SISWA -->
<section class="card-custom">
	<div class="section-title">
		<i class="bi bi-people"></i>
		<span>Data Siswa</span>
	</div>

	<div class="table-responsive">
		<table class="attendance-table" id="studentsTable">
			<thead>
				<tr>
					<th style="width:70px;">No</th>
					<th>NIS</th>
					<th>Nama Siswa</th>
					<th>Kelas</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="studentsTbody">
				<!-- akan di-populate oleh JS -->
			</tbody>
		</table>
	</div>

</section>

<div class="modal fade" id="studentEditModal" tabindex="-1" aria-hidden="true" style="display:none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="studentEditForm">
				<div class="modal-header">
					<h5 class="modal-title">Edit Data Siswa</h5>
					<button type="button" class="btn-close" id="closeStudentEditModal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="editIdInput" />
					<div class="mb-3">
						<label class="form-label">NIS</label>
						<input class="form-control" id="editNisInput" required />
					</div>
					<div class="mb-3">
						<label class="form-label">Nama Siswa</label>
						<input class="form-control" id="editNamaInput" required />
					</div>
					<div class="mb-3">
						<label class="form-label">Kelas</label>
						<input class="form-control" id="editKelasInput" required />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="cancelStudentEditModal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php // include shared JS for dynamic behavior ?>
<script>
<?php include __DIR__ . '/../js/root.php'; ?>
</script>