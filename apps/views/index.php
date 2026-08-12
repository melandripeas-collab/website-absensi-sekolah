<?php
require_once __DIR__ . '/../../config/Database.php';
include_once __DIR__ . '/modul/dashboard.php';
?>
<?php
 $page = isset($_GET['page']) ? $_GET['page'] : 'null';
 switch ($page) {
    case 'siswa':
        include'modul/siswa.php';
        break;

    case 'absensi':
        include'modul/absensi.php';
        break;
    
    default:
        include'modul/default.php';
        break;
 }
?>
