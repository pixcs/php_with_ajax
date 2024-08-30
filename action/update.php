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
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        $query = $conn->prepare("UPDATE phonebook SET name = :name, phone = :phone, email = :email WHERE id = :id");
        $query->execute([
            "id" => $id,
            "name" => $name,
            "phone" => $phone,
            "email" => $email
        ]);

        echo json_encode(["success" => "Updated Successfully"]);
    } catch (PDOException $e) {
        echo json_encode(['error' => ' Failed to Update: ' . $e->getMessage()]);
    }
}
