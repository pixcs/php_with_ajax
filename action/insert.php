 <?php

    try {
        $conn = new PDO('mysql:host=localhost;dbname=practice', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
        exit;
    }

    try {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        $sql = $conn->prepare("INSERT INTO phonebook (name, phone, email) values(:name, :phone, :email)");
        $result = $sql->execute([
            "name" => $name,
            "phone" => $phone,
            "email" => $email
        ]);

        echo json_encode(['success' => "Successfully inserted"]);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Failed to Insert: ' . $e->getMessage()]);
    }

    ?>