<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'root', '', 'dnd');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed']));
}

$stmt = $conn->prepare("
    INSERT INTO characters (name, race, class, level, strength, dexterity, constitution, intelligence, wisdom, charisma) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
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
    $_POST['charisma']
);

$stmt->execute();

echo json_encode(['id' => $conn->insert_id]);
?>
