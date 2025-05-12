<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'root', '', 'dnd');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed']));
}

$id = intval($_GET['id']);

$result = $conn->query("SELECT * FROM characters WHERE id = $id");

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(['error' => 'Character not found']);
}
?>
