<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Motors</title>
    <link rel="stylesheet" href="/app/assets/css/global.css">
    <link rel="stylesheet" href="/app/assets/css/accounts/register.css">
    <link rel="stylesheet" href="/app/assets/css/forms.css">
</head>
<body>
<main class="container">
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/app/view/shared/components/header.php') ?>
    <div class="main-content">
        <h1>Register an account</h1>
        <form method="post" name="registerForm" id="registerForm"
              class="verticalForm">
            <div class="form-group">
                <label for="firstName">First Name: </label>
                <input name="clientFirstname" id="firstName" class="form-item" placeholder="John"
                       required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name: </label>
                <input name="clientLastname" id="lastName" class="form-item" placeholder="Doe"
                       required>
            </div>
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
            <div class="form-group">
                <label for="passwordConfirm">Confirm Password:</label>
                <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-item"
                       placeholder="Confirm your password" required>
            </div>
            <div class="form-group text-right">
                <p>You already have an account? <a href="/accounts/?action=login" tabindex="-1">Login</a></p>
            </div>
            <div class="form-group">
                <button class="form-submit">Register</button>
            </div>
        </form>
    </div>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/app/view/shared/components/footer.php') ?>
</main>
</body>
</html>