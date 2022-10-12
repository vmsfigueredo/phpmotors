<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Motors</title>
    <link rel="stylesheet" href="/app/assets/css/global.css">
</head>
<body>
<main class="container">
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/app/view/shared/components/header.php') ?>
    <div class="main-content">
        <h1>Content Title Here</h1>
        <ul>
            <?php
            /*
            $arr = [
                $conn->insert("clients", [
                    "clientFirstname" => "Tony",
                    "clientLastname" => "Stark",
                    "clientEmail" => "tony@starkent.com",
                    "clientPassword" => "Iam1ronM@an", # I would encrypt this..
                    "comment" => "I am the real Ironman"
                ])->getSql(),
                $conn->update("clients", [
                    "clientLevel" => 3
                ])->where(["clientId" => 1])->getSql(),
                $conn->update("inventory", [
                    "invDescription" => "REPLACE(invDescription, 'small interior', 'spacious interior')"
                ], false)->where(["invId" => 12])->getSql(),
                $conn->select("inventory", ["invModel"])
                    ->innerJoin("carclassification", "inventory.classificationId = carclassification.classificationId")
                    ->where(["carclassification.classificationName" => "SUV"])
                    ->getSql(),
                $conn->delete("inventory")->where(["invId" => 1])->getSql(),
                $conn->update("inventory", [
                    "invImage" => "concat('/phpmotors', invImage)",
                    "invThumbnail" => "concat('/phpmotors', invThumbnail)"
                ], false)->getSql()
            ];
            foreach ($arr as $a) {
                echo "<li style='margin-top: 30px;'>{$a}</li>";
            }*/
            ?>
        </ul>
    </div>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/app/view/shared/components/footer.php') ?>
</main>
</body>
</html>