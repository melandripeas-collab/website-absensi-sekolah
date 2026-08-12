// Shared frontend logic for absensi and siswa views
// Relative path from `apps/views/index.php` to project `api/endpoint.php`
const apiBase = '../../api/endpoint.php';

function statusClass(status) {
	if (!status) return 'status-alpa';
	const s = status.toLowerCase();
	if (s === 'hadir') return 'status-hadir';
	if (s === 'izin') return 'status-izin';
	if (s === 'sakit') return 'status-sakit';
	return 'status-alpa';
}

async function fetchStudents() {
	try {
		const res = await fetch(apiBase + '?action=siswa');
		const json = await res.json();
		const students = json.data || [];

		// populate siswa select
		const select = document.getElementById('siswaSelect');
		if (select) {
			select.innerHTML = '<option value="">-- Pilih Siswa --</option>' + students.map(s => `
				<option value="${s.id_siswa}">${s.nis} - ${s.nama_siswa}</option>
			`).join('');
		}

		// populate students table (in siswa.php)
		const tbody = document.getElementById('studentsTbody');
		if (tbody) {
			tbody.innerHTML = students.map((s, i) => `
				<tr>
					<td>${i+1}</td>
					<td>${s.nis}</td>
					<td>${s.nama_siswa}</td>
					<td>${s.kelas}</td>
					<td>
						<button class="action-btn delete" data-id="${s.id_siswa}">
							<i class="bi bi-trash-fill"></i>
						</button>
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
				<td>${i+1}</td>
				<td>${a.nis || '-'}</td>
				<td>${a.nama_siswa || '-'}</td>
				<td>${a.tanggal}</td>
				<td><span class="status ${statusClass(a.status_kehadiran)}">${a.status_kehadiran || '-'}</span></td>
				<td>${a.keterangan || '-'}</td>
				<td>
					<button class="action-btn edit" data-id="${a.id_absensi}"><i class="bi bi-pencil-fill"></i></button>
					<button class="action-btn delete" data-id="${a.id_absensi}"><i class="bi bi-trash-fill"></i></button>
				</td>
			</tr>
		`).join('');

	} catch (err) {
		console.error('Gagal memuat data absensi', err);
	}
}

document.addEventListener('DOMContentLoaded', function () {
	fetchStudents();
	fetchAttendances();

	// Attendance form submit
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
				fetchAttendances();
				attendanceForm.reset();
				fetchStudents();
			} catch (err) {
				console.error('Gagal menyimpan absensi', err);
			}
		});
	}

	// Student form submit
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

	// Delegated click handlers for delete/edit buttons
	document.body.addEventListener('click', async function (e) {
		const btn = e.target.closest('button');
		if (!btn) return;

		// delete handler
		if (btn.classList.contains('delete')) {
			const id = btn.getAttribute('data-id');
			if (!id) return;

			if (!confirm('Apakah kamu yakin ingin menghapus data ini?')) return;

			// determine context: if button is inside students table, action is siswa; otherwise absensi
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

		// edit handler (simple notification; can be extended to open modal)
		if (btn.classList.contains('edit')) {
			alert('Fitur edit belum diimplementasikan.');
		}
	});

	// Search input filter
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
