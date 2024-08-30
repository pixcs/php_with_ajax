<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=practice', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

try {
    $query = $conn->prepare("SELECT * FROM phonebook");
    $query->execute();
    $phoneList = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($phoneList); // Return the data as JSON
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
