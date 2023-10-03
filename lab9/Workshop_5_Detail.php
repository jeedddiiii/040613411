<?php include "connect.php" ?>

<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ?");
    $stmt->execute([$_GET["username"]]);
    $row = $stmt->fetch();
    ?>

    <div style="display:flex">
        <div>
        <img src="img/<?= $row["username"] ?>.jpg" width="100"><br>
        </div>
        <div style="padding:15px">
            ชื่อสมาชิก:
            <?= $row["name"] ?><br>
            ที่อยู่:
            <?= $row["address"] ?><br>
            อีเมล์:
            <?= $row["email"] ?><br>
        </div>
    </div>
</body>

</html>