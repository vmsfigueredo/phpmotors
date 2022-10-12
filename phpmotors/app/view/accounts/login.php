<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Motors</title>
    <link rel="stylesheet" href="/app/assets/css/global.css">
    <link rel="stylesheet" href="/app/assets/css/accounts/login.css">
    <link rel="stylesheet" href="/app/assets/css/forms.css">
</head>
<body>
<main class="container">
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/app/view/shared/components/header.php') ?>
    <div class="main-content">
        <h1>Account Login</h1>
        <form method="post" name="loginForm" id="loginForm" class="verticalForm">
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="clientEmail" id="email" class="form-item" placeholder="youremail@domain.com"
                       required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="clientPassword" id="password" class="form-item"
                       placeholder="Your password" required>
            </div>
            <div class="form-group text-right">
                <p>You don't have an account yet? <a href="/accounts/?action=register" tabindex="-1">Register now</a>
                </p>
            </div>
            <div class="form-group">
                <button class="form-submit">Login</button>
            </div>
        </form>
    </div>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/app/view/shared/components/footer.php') ?>
</main>
</body>
</html>