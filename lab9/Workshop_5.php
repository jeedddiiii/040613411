<?php include "connect.php" ?>

<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    ?>

    <?php while ($row = $stmt->fetch()): ?>
        ชื่อสมาชิก:
        <?= $row["name"] ?><br>        
        <a href="Workshop_5_Detail.php?username=<?= $row["username"] ?>">
            <img src="img/<?= $row["username"] ?>.jpg" width="100"><br>
        </a>
        <hr>
    <?php endwhile; ?>
</body>

</html>