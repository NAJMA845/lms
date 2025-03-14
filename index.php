<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = md5($password);

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_type'] = $user['is_admin'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['active_status'] = $user['is_blocked'];
        if( $_SESSION['user_type']=="1")
            header('Location: dashboard.php');
        else
            header('Location: user-dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = "Invalid email or password.";
        header('Location: index.php'); // Redirect to show error
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css"/>
    <script src="./assets/js/a0c7076c1c.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <title>Login | Online Library Management System</title>
</head>
<link rel="stylesheet" href="./assets/css/style.css"/>
<body style="background:#212529">
<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="row">
        <div class="col-md-12 login-form">
            <div class="card mb-3" style="max-width: 900px;">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="./assets/images/login-bg.jpeg" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h1 class="card-title text-uppercase fw-bold">Smartlib</h1>
                            <p class="card-text">Enter email and password to login</p>

                            <form action="index.php" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Login Now</button>
                            </form>

                            <hr/>
                            <a href="./forgot-password.php" class="card-link link-underline-light text-center">Forgot Password?</a>

                            <!-- Show error message if login fails -->
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    <?php
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']); // Clear error after displaying
                                    ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
