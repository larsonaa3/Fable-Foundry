<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'root', '', 'dnd');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed']));
}

$id = intval($_POST['id']);

$stmt = $conn->prepare("
    UPDATE characters SET 
        name=?, race=?, class=?, level=?, 
        strength=?, dexterity=?, constitution=?, intelligence=?, wisdom=?, charisma=?
    WHERE id=?
");

$stmt->bind_param(
    "sssiiiiiii",
    $_POST['name'],
    $_POST['race'],
    $_POST['class'],
    $_POST['level'],
    $_POST['strength'],
    $_POST['dexterity'],
    $_POST['constitution'],
    $_POST['intelligence'],
    $_POST['wisdom'],
    $_POST['charisma'],
    $id
);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Update failed']);
}
?>
