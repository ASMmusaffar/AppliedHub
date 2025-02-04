<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css?v=1.32">
    <!-- i am Using BoxIcons for get icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>AppliedHub | Login</title>
</head>
<body>

    <div class="loginCon">
        <form action="engine.php" method="post" class="b-l-primary">
            <h2 style="text-align: center;">Welcome to AppliedHub</h2>
            <div>
                <label for="id" class="id">Your Id: <span></span></label>
                <input type="text" name="id" id="id" required>
            </div>
            <div>
                <label for="pass" class="pass">Your Password: <span></span></label>
                <input type="password" name="pass" id="pass" required>
            </div>
            <div class="">
                <!-- <button type="button" class="bg-primary" onclick="loginUser()">Login</button> -->
                <button type="submit" name="login" class="bg-primary">Login</button>
            </div>
        </form>
    </div>

    <div class="notificationCon"></div>

    <script src="scripts/form.js?v=1.3"></script>
    <script src="scripts/main.js"></script>
</body>
</html>