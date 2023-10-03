<?php
include "connect.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM member WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
} else {
    // Handle the case when no ID parameter is provided (e.g., display an error message)
    echo "User ID not provided.";
    exit();
}
?>

<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <h2>User Information</h2>
    <div>
        ชื่อสมาชิก: <?= $row["name"] ?><br>
        ที่อยู่: <?= $row["address"] ?><br>
        อีเมล์: <?= $row["email"] ?><br>
        <img src="img/<?= $row["username"] ?>.jpg" width="100"><br>
        <hr>
    </div>
    <a href="members.php">Back to Members Page</a>
</body>

</html>
