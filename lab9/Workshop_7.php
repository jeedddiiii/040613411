<?php include "connect.php" ?>

<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
    // Display existing users
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()):
    ?>
        <div>
            ชื่อสมาชิก: <?= $row["name"] ?><br>
            ที่อยู่: <?= $row["address"] ?><br>
            อีเมล์: <?= $row["email"] ?><br>
            <img src="img/<?= $row["username"] ?>.jpg" width="100"><br>
            <hr>
        </div>
    <?php endwhile; ?>

    <!-- Add User Form -->
    <h2>Add User</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="name">ชื่อสมาชิก:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="address">ที่อยู่:</label>
        <input type="text" id="address" name="address" required><br>

        <label for="email">อีเมล์:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="user_image">รูปภาพ:</label>
        <input type="file" id="user_image" name="user_image" accept=".jpg, .jpeg, .png, .gif" required><br>

        <button type="submit" name="add_user">Add User</button>
    </form>

    <?php
    // Process the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $username = $_POST['username'];

        // Check if the username already exists
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM member WHERE username = ?");
        $checkStmt->execute([$username]);
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            echo "Error: Username already exists.";
        } else {
            // Upload the user's image
            $targetDirectory = "img/";
            $targetFile = $targetDirectory . $username . ".jpg";

            if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $targetFile)) {
                // Insert the new user with the image filename
                $insertStmt = $pdo->prepare("INSERT INTO member (name, address, email, username) VALUES (?, ?, ?, ?)");
                $insertStmt->execute([$name, $address, $email, $username]);
            } else {
                echo "Error uploading image.";
            }
        }
    }
    ?>
</body>

</html>
