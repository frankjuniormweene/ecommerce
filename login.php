<?php

$host = 'localhost'; 
$db = 'e_commerce'; 
$user = 'root'; 
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];
        header("Location: admin_dashboard.php"); 
        exit;
    } else {
        $login_error = "Invalid username or password.";
    }
}

// Handle signup
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'signup') {
    $signupUsername = $_POST['signupUsername'];
    $signupPassword = password_hash($_POST['signupPassword'], PASSWORD_BCRYPT);
    $userType = $_POST['userType'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, user_type) VALUES (:username, :password, :user_type)");
    $stmt->execute(['username' => $signupUsername, 'password' => $signupPassword, 'user_type' => $userType]);

    header("Location: homepage.php"); // Redirect to a homepage after signup
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Sign In/Sign Up</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .form-container {
            width: 400px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .toggle-btn {
            cursor: pointer;
            color: #007bff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <div id="signInForm">
        <h3 class="text-center">Sign In</h3>
        <?php if (!empty($login_error)) : ?>
            <div class="alert alert-danger"><?= $login_error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <input type="hidden" name="action" value="login">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            <p class="text-center">Don't have an account? <span class="toggle-btn" onclick="toggleForms()">Sign Up</span></p>
        </form>
    </div>

    <div id="signUpForm" style="display: none;">
        <h3 class="text-center">Sign Up</h3>
        <form method="POST">
            <div class="form-group">
                <label for="signupUsername">Username</label>
                <input type="text" class="form-control" name="signupUsername" required>
            </div>
            <div class="form-group">
                <label for="signupPassword">Password</label>
                <input type="password" class="form-control" name="signupPassword" required>
            </div>
            <div class="form-group">
                <label for="userType">I am a:</label>
                <select class="form-control" name="userType">
                    <option value="customer">Customer</option>
                    <option value="vendor">Vendor</option>
                </select>
            </div>
            <input type="hidden" name="action" value="signup">
            <button type="submit" class="btn btn-success btn-block">Sign Up</button>
            <p class="text-center">Already have an account? <span class="toggle-btn" onclick="toggleForms()">Sign In</span></p>
        </form>
    </div>
</div>

<script>
    function toggleForms() {
        const signInForm = document.getElementById('signInForm');
        const signUpForm = document.getElementById('signUpForm');
        if (signInForm.style.display === 'none') {
            signInForm.style.display = 'block';
            signUpForm.style.display = 'none';
        } else {
            signInForm.style.display = 'none';
            signUpForm.style.display = 'block';
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>