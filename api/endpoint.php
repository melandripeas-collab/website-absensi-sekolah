<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once __DIR__ . '/../app/controllers/ControllerUtama.php';
$controller = new ControllerUtama();
$request_method = $_SERVER["REQUEST_METHOD"];
if ($request_method === 'OPTIONS') {
    http_response_code(200);
    exit;
}
switch ($request_method) {
 case 'GET':
     echo $controller->getAllSiswa();
     break;
 case 'POST':
     $data = json_decode(file_get_contents("php://input"));
     echo $controller->storeSiswa($data);
     break;
 case 'PUT':
     $data = json_decode(file_get_contents("php://input"));
     echo $controller->updateSiswa($data);
     break;
 case 'DELETE':
     $id = null;
     if(isset($_GET['id'])) {
         $id = $_GET['id'];
     } else {
         $data = json_decode(file_get_contents("php://input"), true);
         if(isset($data['id'])) {
             $id = $data['id'];
         }
     }
     echo $controller->deleteSiswa($id);
     break;
 default:
     http_response_code(405);
     echo json_encode(array("message" => "Metode HTTP tidak diizinkan."));
     break;
}
?>