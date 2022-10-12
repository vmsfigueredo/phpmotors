<?php
$conn = new Connection();
$car = [
    "name" => "DMC Delorean",
    "image" => "/app/assets/images/delorean.jpg",
    "features" => [
        "3 Cup holders",
        "Superman doors",
        "Fuzzy dice!"
    ],
    "upgrades" => [
        [
            "title" => "Flux Capacitor",
            "image" => "/app/assets/images/upgrades/flux-cap.png"
        ],
        [
            "title" => "Flame decals",
            "image" => "/app/assets/images/upgrades/flame.jpg",
        ],
        [
            "title" => "Bumper Stickers",
            "image" => "/app/assets/images/upgrades/bumper_sticker.jpg"
        ],
        [
            "title" => "Hub Caps",
            "image" => "/app/assets/images/upgrades/hub-cap.jpg"
        ]
    ],
    "reviews" => [
        [
            "content" => "So fast its almost like traveling in time.",
            "stars" => 4
        ],
        [
            "content" => "Coolest ride on the road.",
            "stars" => 4
        ],
        [
            "content" => "I'm feeling Marty McFly!",
            "stars" => 5
        ],
        [
            "content" => "The most futuristic ride of our day.",
            "stars" => 4.5
        ],
        [
            "content" => "80's livin and I love it!",
            "stars" => 5
        ]
    ]
]
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Motors</title>
    <link rel="stylesheet" href="../app/assets/css/global.css">
    <link rel="stylesheet" href="../app/assets/css/home.css">
</head>
<body>
<main class="container">
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/app/view/shared/components/header.php') ?>
    <div class="main-content">
        <h1>Welcome to PHP Motors !</h1>
        <div class="car-view">
            <div class="car-banner">
                <div class="content">
                    <h2><?php echo $car['name'] ?></h2>
                    <ul>
                        <?php foreach ($car['features'] as $feature) {
                            echo "<li>{$feature}</li>";
                        } ?>
                    </ul>
                    <button>Own Today</button>
                </div>
            </div>
            <div class="car-features">
                <div class="upgrades">
                    <h2><?php echo $car['name'] ?> Upgrades</h2>
                    <?php foreach ($car['upgrades'] as $upgrade) { ?>
                        <div class="upgrade">
                            <div class="img">
                                <img src="<?php echo $upgrade['image'] ?>" alt="<?php echo $upgrade['title'] ?>">
                            </div>
                            <p><?php echo $upgrade['title'] ?></p>
                        </div>
                    <?php } ?>
                </div>
                <div class="reviews">
                    <h2><?php echo $car['name'] ?> Reviews</h2>
                    <ul>
                        <?php foreach ($car['reviews'] as $review) { ?>
                            <li>&raquo; <?php echo $review['content'] . "({$review['stars']}/5)" ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/app/view/shared/components/footer.php') ?>
</main>
</body>
</html>