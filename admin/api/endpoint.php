<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-RequestedWith");
require_once __DIR__ . '/../apps/controllers/ControllerUtama.php';
$controller = new ControllerUtama();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
 case 'GET':
 echo $controller->getAllSiswa();
 break;
 case 'POST':
 $data = json_decode(file_get_contents("php://input"));
 echo $controller->storeSiswa($data);
 break;
 default:
 http_response_code(405);
 echo json_encode(array("message" => "Metode HTTP tidak diizinkan."));
 break;
}