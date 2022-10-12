<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Motors</title>
    <link rel="stylesheet" href="/app/assets/css/global.css">
</head>
<body>
<main class="container">
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/app/view/shared/components/header.php') ?>
    <div class="main-content">
        <h1>Server Error</h1>
        <p>Sorry, our server seems to be experiencing some technical difficulties.</p>
        <?php
        $error = $_GET['error'] ?? "Unknown";
        $file = $_GET['file'] ?? "Undefined";
        $line = $_GET['line'] ?? "0";
        if ($_GET['error']) echo "<p style='margin-top: 15px; font-size: 9pt;'><b>Error info:</b> {$error}<br/><b>Error page:</b> {$file} <b>line</b> {$line}</p>" ?>
    </div>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/app/view/shared/components/footer.php') ?>
</main>
</body>
</html>