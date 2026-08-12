<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Siswa</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        /* SIDEBAR */
        .sidebar {
            width: 267px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            border-right: 1px solid #e5e7eb;
            z-index: 1000;
        }

        .logo-area {
            height: 78px;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0 28px;
            color: #165dcc;
            font-size: 22px;
            font-weight: 600;
        }

        .logo-area i {
            font-size: 30px;
        }

        .menu {
            padding: 22px 12px;
        }

        .menu-item {
            height: 54px;
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 0 18px;
            margin-bottom: 8px;
            border-radius: 5px;
            color: #111827;
            text-decoration: none;
            font-size: 16px;
        }

        .menu-item i {
            width: 22px;
            font-size: 21px;
        }

        .menu-item.active {
            color: #165dcc;
            background: #eaf0ff;
            border-left: 4px solid #165dcc;
            padding-left: 14px;
        }

        .logout {
            position: absolute;
            bottom: 22px;
            left: 12px;
            right: 12px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }

        .logout a {
            color: #dc4b48;
        }

        /* MAIN */
        .main {
            margin-left: 267px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            height: 78px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px 0 36px;
        }

        .top-left {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .hamburger {
            font-size: 22px;
            cursor: pointer;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #111827;
        }

        .top-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .date {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: 20px;
        }

        .admin {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e4e7ed;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #374151;
            font-size: 22px;
        }

        /* CONTENT */
        .content {
            padding: 24px 22px 0;
        }

        /* WELCOME */
        .welcome {
            min-height: 176px;
            border-radius: 6px;
            background: linear-gradient(110deg, #3760dd, #5358e5);
            color: white;
            padding: 32px 37px;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .welcome h2 {
            font-size: 27px;
            margin: 0 0 18px;
            font-weight: 600;
        }

        .welcome p {
            font-size: 18px;
            line-height: 1.6;
            margin: 0;
            max-width: 400px;
        }

        .welcome-icon {
            position: absolute;
            right: 65px;
            top: 22px;
            font-size: 130px;
            opacity: .9;
        }

        /* CARD */
        .card-custom {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 7px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,.02);
            margin-bottom: 20px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 16px;
            color: #2563c7;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 23px;
        }

        .section-title i {
            font-size: 24px;
        }

        /* FORM */
        .form-grid {
            display: grid;
            grid-template-columns: 1.05fr 1fr .95fr 1.25fr;
            gap: 30px;
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .form-control,
        .form-select {
            height: 47px;
            border: 1px solid #d5d9df;
            border-radius: 5px;
            font-size: 15px;
            box-shadow: none !important;
        }

        textarea.form-control {
            height: 75px;
            resize: none;
            padding-top: 12px;
        }

        .save-btn {
            margin-top: 20px;
            background: #2460d6;
            border: none;
            padding: 9px 20px;
            border-radius: 4px;
            font-size: 15px;
        }

        .save-btn:hover {
            background: #174ebc;
        }

        /* TABLE HEADER */
        .table-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .search-box {
            position: relative;
            width: 305px;
        }

        .search-box input {
            height: 40px;
            padding-right: 42px;
        }

        .search-box i {
            position: absolute;
            right: 14px;
            top: 10px;
            font-size: 18px;
        }

        /* TABLE */
        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .attendance-table th {
            background: #dce6fb;
            color: #111827;
            font-weight: 600;
            height: 45px;
            text-align: center;
            border: 1px solid #cdd5e4;
        }

        .attendance-table td {
            height: 51px;
            border: 1px solid #dfe3e8;
            text-align: center;
            padding: 7px;
        }

        .attendance-table td:nth-child(2),
        .attendance-table td:nth-child(5) {
            text-align: left;
            padding-left: 30px;
        }

        /* STATUS */
        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 13px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-hadir {
            color: #26915f;
            background: #e8f7ef;
            border: 1px solid #c9ebd8;
        }

        .status-izin {
            color: #dca00b;
            background: #fff8df;
            border: 1px solid #f7e8ad;
        }

        .status-sakit {
            color: #c84b4b;
            background: #fff0f0;
            border: 1px solid #f1cccc;
        }

        .status-alpa {
            color: #4b5563;
            background: #f1f2f3;
            border: 1px solid #dddfe2;
        }

        /* ACTION */
        .action-btn {
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 4px;
            color: white;
            margin: 0 3px;
        }

        .edit {
            background: #2563d5;
        }

        .delete {
            background: #e94545;
        }

        /* FOOTER TABLE */
        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 14px;
            font-size: 14px;
        }

        .pagination-custom {
            display: flex;
            gap: 0;
        }

        .pagination-custom button {
            width: 57px;
            height: 35px;
            border: 1px solid #ddd;
            background: white;
        }

        .pagination-custom .active {
            background: #2860d4;
            color: white;
            border-color: #2860d4;
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 8px 0 12px;
            color: #555;
            font-size: 14px;
        }

        /* RESPONSIVE */
        @media(max-width: 1100px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
            }

            .form-grid {
                grid-template-columns: 1fr 1fr;
            }

            .welcome-icon {
                right: 30px;
            }
        }

        @media(max-width: 800px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
            }

            .date {
                display: none;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .table-head {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .search-box {
                width: 100%;
            }

            .card-custom {
                overflow-x: auto;
            }

            .attendance-table {
                min-width: 850px;
            }

            .welcome-icon {
                display: none;
            }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">

    <div class="logo-area">
        <i class="bi bi-calendar2-week"></i>
        <span>Absensi Siswa</span>
    </div>

    <nav class="menu">

        <a href="?page=siswa" class="menu-item">
            <i class="bi bi-person"></i>
            <span>Data Siswa</span>
        </a>

        <a href="?page=absensi" class="menu-item">
            <i class="bi bi-calendar-check"></i>
            <span>Absensi</span>
        </a>

    </nav>

</aside>


<!-- MAIN -->
<main class="main">

    <!-- TOPBAR -->
    <header class="topbar">

        <div class="top-left">
            <i class="bi bi-list hamburger"></i>
            <span class="page-title">Absensi Sekolah</span>
        </div>

        <div class="top-right">

            <div class="admin">
                <div class="avatar">
                    <i class="bi bi-person-fill"></i>
                </div>

                <span>Admin</span>
            </div>

        </div>

    </header>




<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php // include shared JS (populates absensi & siswa views, handles API calls) ?>
<script>
<?php include __DIR__ . '/../js/root.php'; ?>
</script>

</body>
</html>