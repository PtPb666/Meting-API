<?php
/**
 * Meting API
 * https://github.com/metowolf/Meting-API
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Metowolf\Meting;

// 允许跨域
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

$server = $_GET['server'] ?? 'netease';
$type   = $_GET['type'] ?? 'song';
$id     = $_GET['id'] ?? '';

if (empty($id)) {
    echo json_encode(['error' => 'id is required']);
    exit;
}

$api = new Meting($server);
$data = $api->format(true)->$type($id);

if ($type == 'url') {
    $data = json_decode($data, true);
    $data = $data['url'] ?? $data;
    header('Content-Type: application/json');
    echo json_encode(['url' => $data]);
} else {
    header('Content-Type: application/json');
    echo $data;
}
