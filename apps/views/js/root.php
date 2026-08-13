// Shared frontend logic for absensi and siswa views
// Relative path from apps/views to project root api folder
const apiBase = '../../api/endpoint.php';

function statusClass(status) {
	if (!status) return 'inline-flex items-center gap-2 rounded-md border border-slate-300 bg-slate-100 px-3 py-1.5 text-sm font-medium text-slate-600';
	const s = status.toLowerCase();
	if (s === 'hadir') return 'inline-flex items-center gap-2 rounded-md border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-sm font-medium text-emerald-700';
	if (s === 'izin') return 'inline-flex items-center gap-2 rounded-md border border-amber-200 bg-amber-50 px-3 py-1.5 text-sm font-medium text-amber-700';
	if (s === 'sakit') return 'inline-flex items-center gap-2 rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-sm font-medium text-red-700';
	return 'inline-flex items-center gap-2 rounded-md border border-slate-300 bg-slate-100 px-3 py-1.5 text-sm font-medium text-slate-600';
}

function closeStudentEditModal() {
	const modal = document.getElementById('studentEditModal');
	if (!modal) return;

	if (window.bootstrap && bootstrap.Modal) {
		const bsModal = bootstrap.Modal.getInstance(modal);
		if (bsModal) bsModal.hide();
		else modal.classList.remove('show');
	} else {
		modal.classList.remove('show');
		modal.style.display = 'none';
		modal.setAttribute('aria-hidden', 'true');
	}
}

function openStudentEditModal(student) {
	const modal = document.getElementById('studentEditModal');
	if (!modal) return;

	document.getElementById('editIdInput').value = student.id_siswa ?? '';
	document.getElementById('editNisInput').value = student.nis ?? '';
	document.getElementById('editNamaInput').value = student.nama_siswa ?? '';
	document.getElementById('editKelasInput').value = student.kelas ?? '';

	if (window.bootstrap && bootstrap.Modal) {
		const bsModal = bootstrap.Modal.getOrCreateInstance(modal);
		bsModal.show();
	} else {
		modal.classList.add('show');
		modal.style.display = 'block';
		modal.setAttribute('aria-hidden', 'false');
	}
}

function fillStudentSelect(selectId, selectedValue = '') {
	const select = document.getElementById(selectId);
	if (!select) return;

	fetch(apiBase + '?action=siswa')
		.then(res => res.json())
		.then(json => {
			const students = json.data || [];
			select.innerHTML = '<option value="">-- Pilih Siswa --</option>' + students.map(s => `
				<option value="${s.id_siswa}" ${String(selectedValue) === String(s.id_siswa) ? 'selected' : ''}>${s.nis} - ${s.nama_siswa}</option>
			`).join('');
		})
		.catch(err => console.error('Gagal memuat data siswa untuk select', err));
}

async function fetchStudents() {
	try {
		const res = await fetch(apiBase + '?action=siswa');
		const json = await res.json();
		const students = json.data || [];

		const select = document.getElementById('siswaSelect');
		if (select) {
			select.innerHTML = '<option value="">-- Pilih Siswa --</option>' + students.map(s => `
				<option value="${s.id_siswa}">${s.nis} - ${s.nama_siswa}</option>
			`).join('');
		}

		const editSelect = document.getElementById('editAbsensiSiswaSelect');
		if (editSelect) {
			editSelect.innerHTML = '<option value="">-- Pilih Siswa --</option>' + students.map(s => `
				<option value="${s.id_siswa}">${s.nis} - ${s.nama_siswa}</option>
			`).join('');
		}

		const tbody = document.getElementById('studentsTbody');
		if (tbody) {
			tbody.innerHTML = students.map((s, i) => `
				<tr>
					<td>${i + 1}</td>
			        <td>${s.nis}</td>
					<td>${s.nama_siswa}</td>
					<td>${s.kelas}</td>
					<td>
						<div class="d-flex justify-content-center gap-2">
							<button class="btn btn-primary btn-sm edit" data-id="${s.id_siswa}">
								<i class="bi bi-pencil-fill"></i>
							</button>
							<button class="btn btn-danger btn-sm delete" data-id="${s.id_siswa}">
								<i class="bi bi-trash-fill"></i>
							</button>
						</div>
					</td>
				</tr>
			`).join('');
		}

	} catch (err) {
		console.error('Gagal memuat data siswa', err);
	}
}

async function fetchAttendances() {
	try {
		const res = await fetch(apiBase + '?action=absensi');
		const json = await res.json();
		const items = json.data || [];

		const tbody = document.getElementById('attendanceTbody');
		if (!tbody) return;

		tbody.innerHTML = items.map((a, i) => `
			<tr>
				<td>${i + 1}</td>
				<td>${a.nis || '-'}</td>
				<td>${a.nama_siswa || '-'}</td>
				<td>${a.tanggal}</td>
				<td><span class="${statusClass(a.status_kehadiran)}">${a.status_kehadiran || '-'}</span></td>
				<td>${a.keterangan || '-'}</td>
				<td>
					<div class="d-flex justify-content-center gap-2">
						<button class="btn btn-primary btn-sm edit" data-id="${a.id_absensi}"><i class="bi bi-pencil-fill"></i></button>
						<button class="btn btn-danger btn-sm delete" data-id="${a.id_absensi}"><i class="bi bi-trash-fill"></i></button>
					</div>
				</td>
			</tr>
		`).join('');

	} catch (err) {
		console.error('Gagal memuat data absensi', err);
	}
}

function closeAttendanceEditModal() {
	const modal = document.getElementById('attendanceEditModal');
	if (!modal) return;

	if (window.bootstrap && bootstrap.Modal) {
		const bsModal = bootstrap.Modal.getInstance(modal);
		if (bsModal) bsModal.hide();
		else modal.classList.remove('show');
	} else {
		modal.classList.remove('show');
		modal.style.display = 'none';
		modal.setAttribute('aria-hidden', 'true');
	}
}

function openAttendanceEditModal(absensi) {
	const modal = document.getElementById('attendanceEditModal');
	if (!modal) return;

	fillStudentSelect('editAbsensiSiswaSelect', absensi.id_siswa ?? '');
	document.getElementById('editAbsensiIdInput').value = absensi.id_absensi ?? '';
	document.getElementById('editAbsensiStatusSelect').value = absensi.status_kehadiran ?? '';
	document.getElementById('editAbsensiTanggalInput').value = absensi.tanggal ?? '';
	document.getElementById('editAbsensiKeteranganInput').value = absensi.keterangan ?? '';

	if (window.bootstrap && bootstrap.Modal) {
		const bsModal = bootstrap.Modal.getOrCreateInstance(modal);
		bsModal.show();
	} else {
		modal.classList.add('show');
		modal.style.display = 'block';
		modal.setAttribute('aria-hidden', 'false');
	}
}

document.addEventListener('DOMContentLoaded', function () {
	fetchStudents();
	fetchAttendances();

	const attendanceForm = document.getElementById('attendanceForm');
	if (attendanceForm) {
		attendanceForm.addEventListener('submit', async function (e) {
			e.preventDefault();
			const data = {
				id_siswa: document.getElementById('siswaSelect').value,
				status_kehadiran: document.getElementById('statusSelect').value,
				tanggal: document.getElementById('tanggalInput').value,
				keterangan: document.getElementById('keteranganInput').value
			};

			try {
				const res = await fetch(apiBase + '?action=absensi', {
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify(data)
				});
				await res.json();
				attendanceForm.reset();
				fetchAttendances();
				fetchStudents();
			} catch (err) {
				console.error('Gagal menyimpan absensi', err);
			}
		});
	}

	const attendanceEditForm = document.getElementById('attendanceEditForm');
	if (attendanceEditForm) {
		attendanceEditForm.addEventListener('submit', async function (e) {
			e.preventDefault();
			const data = {
				id_absensi: document.getElementById('editAbsensiIdInput').value,
				id_siswa: document.getElementById('editAbsensiSiswaSelect').value,
				status_kehadiran: document.getElementById('editAbsensiStatusSelect').value,
				tanggal: document.getElementById('editAbsensiTanggalInput').value,
				keterangan: document.getElementById('editAbsensiKeteranganInput').value
			};

			try {
				const res = await fetch(apiBase + '?action=absensi', {
					method: 'PUT',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify(data)
				});
				await res.json();
				closeAttendanceEditModal();
				fetchAttendances();
				fetchStudents();
			} catch (err) {
				console.error('Gagal mengupdate absensi', err);
			}
		});
	}

	const studentForm = document.getElementById('studentForm');
	if (studentForm) {
		studentForm.addEventListener('submit', async function (e) {
			e.preventDefault();
			const data = {
				nis: document.getElementById('nisInput').value,
				nama_siswa: document.getElementById('namaInput').value,
				kelas: document.getElementById('kelasInput').value
			};

			try {
				const res = await fetch(apiBase + '?action=siswa', {
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify(data)
				});
				await res.json();
				studentForm.reset();
				fetchStudents();
			} catch (err) {
				console.error('Gagal menambah siswa', err);
			}
		});
	}

	const studentEditForm = document.getElementById('studentEditForm');
	if (studentEditForm) {
		studentEditForm.addEventListener('submit', async function (e) {
			e.preventDefault();
			const data = {
				id_siswa: document.getElementById('editIdInput').value,
				nis: document.getElementById('editNisInput').value,
				nama_siswa: document.getElementById('editNamaInput').value,
				kelas: document.getElementById('editKelasInput').value
			};

			try {
				const res = await fetch(apiBase + '?action=siswa', {
					method: 'PUT',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify(data)
				});
				await res.json();
				closeStudentEditModal();
				fetchStudents();
			} catch (err) {
				console.error('Gagal mengupdate siswa', err);
			}
		});
	}

	const closeStudentBtn = document.getElementById('closeStudentEditModal');
	if (closeStudentBtn) closeStudentBtn.addEventListener('click', closeStudentEditModal);
	const closeAttendanceBtn = document.getElementById('closeAttendanceEditModal');
	if (closeAttendanceBtn) closeAttendanceBtn.addEventListener('click', closeAttendanceEditModal);
	const cancelStudentBtn = document.getElementById('cancelStudentEditModal');
	if (cancelStudentBtn) cancelStudentBtn.addEventListener('click', closeStudentEditModal);
	const cancelAttendanceBtn = document.getElementById('cancelAttendanceEditModal');
	if (cancelAttendanceBtn) cancelAttendanceBtn.addEventListener('click', closeAttendanceEditModal);

	document.body.addEventListener('click', async function (e) {
		const btn = e.target.closest('button');
		if (!btn) return;

		if (btn.classList.contains('delete')) {
			const id = btn.getAttribute('data-id');
			if (!id) return;

			if (!confirm('Apakah kamu yakin ingin menghapus data ini?')) return;

			const isStudent = !!btn.closest('#studentsTable');
			const action = isStudent ? 'siswa' : 'absensi';

			try {
				await fetch(apiBase + '?action=' + action, {
					method: 'DELETE',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify({ id: id })
				});

				if (isStudent) fetchStudents(); else fetchAttendances();
			} catch (err) {
				console.error('Gagal menghapus', err);
			}
		}

		if (btn.classList.contains('edit')) {
			const id = btn.getAttribute('data-id');
			if (!id) return;
			const isStudent = !!btn.closest('#studentsTable');

			try {
				const endpoint = isStudent ? (apiBase + '?action=siswa&id=' + encodeURIComponent(id)) : (apiBase + '?action=absensi&id=' + encodeURIComponent(id));
				const res = await fetch(endpoint);
				const json = await res.json();
				if (json && json.data) {
					if (isStudent) openStudentEditModal(json.data);
					else openAttendanceEditModal(json.data);
				}
			} catch (err) {
				console.error('Gagal mengambil data untuk edit', err);
			}
		}
	});

	const searchInput = document.getElementById('searchInput');
	if (searchInput) {
		searchInput.addEventListener('keyup', function () {
			const keyword = this.value.toLowerCase();
			const table = document.getElementById('attendanceTable');
			if (!table) return;
			const rows = table.querySelectorAll('tbody tr');
			rows.forEach(row => {
				const text = row.innerText.toLowerCase();
				row.style.display = text.includes(keyword) ? '' : 'none';
			});
		});
	}
});
