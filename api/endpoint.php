<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-RequestedWith");

require_once __DIR__ . '/../apps/controllers/ControllerUtama.php';

$controller = new ControllerUtama();
$request_method = $_SERVER["REQUEST_METHOD"];
$action = isset($_GET["action"]) ? $_GET["action"] : "siswa";
$data = json_decode(file_get_contents("php://input"));

switch ($request_method) {
    case 'GET':
        if ($action === 'absensi') {
            if (isset($_GET['id'])) {
                echo $controller->getAbsensiById($_GET['id']);
            } else {
                echo $controller->getAllAbsensi();
            }
        } else {
            if (isset($_GET['id'])) {
                echo $controller->getSiswaById($_GET['id']);
            } else {
                echo $controller->getAllSiswa();
            }
        }
        break;

    case 'POST':
        if ($action === 'absensi') {
            echo $controller->storeAbsensi($data);
        } else {
            echo $controller->storeSiswa($data);
        }
        break;

    case 'PUT':
        if ($action === 'absensi') {
            echo $controller->updateAbsensi($data);
        } else {
            echo $controller->updateSiswa($data);
        }
        break;

    case 'DELETE':
        if ($action === 'absensi') {
            echo $controller->deleteAbsensi($data);
        } else {
            echo $controller->deleteSiswa($data);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Metode HTTP tidak diizinkan."));
        break;
}