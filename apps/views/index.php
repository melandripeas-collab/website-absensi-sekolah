<?php
require_once __DIR__ . '/../../config/Database.php';
include_once __DIR__ . '/modul/dashboard.php';
?>
<?php
 switch ($page) {
    case 'siswa':
        include'modul/siswa.php';
        break;

<<<<<<< HEAD
    case 'absensi':
        include'modul/absensi.php';
        break;
    
    default:
        include'modul/default.php';
        break;
 }
?>
=======

?>
>>>>>>> 5991538fec8a5e74335b3b7603fc9de2db1aaab3
