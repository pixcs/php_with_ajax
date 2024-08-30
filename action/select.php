<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=practice', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        $query = $conn->prepare("SELECT * FROM phonebook WHERE id = :id");
        $query->execute(["id" => $id]);
        $contactInfo = $query->fetch(PDO::FETCH_ASSOC);

        if (!$id) {
            echo json_encode(['error' => 'Invalid ID']);
        }

        echo json_encode($contactInfo);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
    }
}
