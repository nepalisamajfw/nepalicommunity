<?php
$filename = 'potluck.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add a new item
    $data = json_decode(file_get_contents('php://input'), true);
    $items = json_decode(file_get_contents($filename), true);
    $items[] = $data;
    file_put_contents($filename, json_encode($items));
    echo json_encode(['status' => 'success']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve all items
    echo file_get_contents($filename);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Clear all items (admin only)
    file_put_contents($filename, json_encode([]));
    echo json_encode(['status' => 'success']);
}
?>
