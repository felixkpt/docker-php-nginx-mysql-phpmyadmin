<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 20px;
    }

    h3 {
        color: #333;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background-color: #fff;
        margin: 5px 0;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .success {
        color: green;
        font-weight: bold;
    }

    .error {
        color: red;
        font-weight: bold;
    }

    p {
        font-size: 16px;
    }

    p.success {
        color: #28a745;
    }

    p.error {
        color: #dc3545;
    }
</style>
<?php
$servername = "mysql"; // Use service name from docker-compose
$username = "root";
$password = "demo_password";
$dbname = "demo_db";

try {
    // Create a connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table `users`
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    echo "<p class='success'>Table `users` created successfully.</p>";

    // Insert sample data only if email doesn't exist
    // For John
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $stmt->execute(['email' => 'john@example.com']);
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $sql = "INSERT INTO users (name, email) VALUES 
                ('John Doe', 'john@example.com')";
        $conn->exec($sql);
        echo "<p class='success'>John's data inserted successfully.</p>";
    } else {
        echo "<p class='error'>Email 'john@example.com' already exists.</p>";
    }

    // For Jane
    $stmt->execute(['email' => 'jane@example.com']);
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $sql = "INSERT INTO users (name, email) VALUES 
                ('Jane Smith', 'jane@example.com')";
        $conn->exec($sql);
        echo "<p class='success'>Jane's data inserted successfully.</p>";
    } else {
        echo "<p class='error'>Email 'jane@example.com' already exists.</p>";
    }

    // Retrieve and display the data
    $stmt = $conn->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3>Users in database:</h3><ul>";
    foreach ($users as $user) {
        echo "<li>ID: {$user['id']}, Name: {$user['name']}, Email: {$user['email']}, Created At: {$user['created_at']}</li>";
    }
    echo "</ul>";

} catch (PDOException $e) {
    echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
}

// Close connection
$conn = null;
?>
