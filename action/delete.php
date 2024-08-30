<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=practice', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            echo json_encode(['error' => 'Invalid ID']);
        }

        $query = $conn->prepare("DELETE FROM phonebook WHERE ID = :id");
        $query->execute(["id" => $id]);

        echo json_encode(['success' => 'Record deleted successfully']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
