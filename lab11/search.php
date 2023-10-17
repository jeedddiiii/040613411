<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <input type="text" id="usernameInput" onkeyup="checkUser()">
    <div id="user-result"></div>

    <script>
        function checkUser() {
            var username = $('#usernameInput').val();
            $.ajax({
                type: 'POST',
                url: 'search.php',
                data: { username: username },
                success: function (response) {
                    $('#user-result').html(response);
                }
            });
        }
    </script>

    <?php
    if (isset($_POST['username'])) {
        require_once 'connect.php';

        $username = $_POST['username'];
    
        $sql = "SELECT * FROM member WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo "<p>User exists:</p>";
            echo "<p>Username: " . $result['username'] . "</p>";
            echo "<p>Name: " . $result['name'] . "</p>";
            echo "<p>Address: " . $result['address'] . "</p>";
            echo "<p>Mobile: " . $result['mobile'] . "</p>";
            echo "<p>Email: " . $result['email'] . "</p>";
        } else {
            echo "User not found.";
        }
    }
    ?>
</body>
</html>
