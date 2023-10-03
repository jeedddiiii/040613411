<?php include "connect.php" ?>

<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    
    <form method="GET" action="">
        <input type="text" id="search_query" name="search_query">
        <input type="submit" value="Search">
    </form>

    <?php
    // Check if the search query is provided in the URL
    if (isset($_GET['search_query'])) {
        $search_query = $_GET['search_query'];
        // Modify the SQL query to search by name or email
        $stmt = $pdo->prepare("SELECT * FROM member WHERE name LIKE :query OR email LIKE :query");
        $stmt->bindValue(':query', "%$search_query%", PDO::PARAM_STR);
        $stmt->execute();
    } else {
        // If no search query is provided, fetch all users
        $stmt = $pdo->prepare("SELECT * FROM member");
        $stmt->execute();
    }

    while ($row = $stmt->fetch()):
    ?>
        ชื่อสมาชิก:
        <?= $row["name"] ?><br>
        ที่อยู่:
        <?= $row["address"] ?><br>
        อีเมล์:
        <?= $row["email"] ?><br>
        <img src="img/<?= $row["username"] ?>.jpg" width="100"><br>
        <hr>
    <?php endwhile; ?>
</body>

</html>