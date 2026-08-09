<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Metowolf\Meting;
header('Access-Control-Allow-Origin: *');
$server = $_GET['server'] ?? 'netease';
$type   = $_GET['type'] ?? 'song';
$id     = $_GET['id'] ?? '';
if (empty($id)) {
    echo json_encode(['error' => 'id is required']);
    exit;
}
$api = new Meting($server);
$data = $api->format(true)->$type($id);
header('Content-Type: application/json');
echo $data;
