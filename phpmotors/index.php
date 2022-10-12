<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/app/library/Connection.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/app/model/main-model.php");

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

$ignore_redirects_actions = ["500"];
/* Menu */
$current = strtolower($_SERVER["REQUEST_URI"]);
$homeClass = $current == "/" ? "active" : null;
$navList = "<ul>";
$navList .= "<li class='" . $homeClass . "'><a
                        href='" . '/' . "'>" . "Home" . "</a></li>";
try {
    foreach (getClassifications() as $classification) {
        $link = '/?action=' . strtolower($classification->classificationName);
        $class = $current == $link ? "active" : null;
        $navList .= "<li class='" . $class . "'><a
                        href='" . $link . "'>" . $classification->classificationName . "</a></li>";
    }
} catch (Exception $e) {
    if (!in_array($action, $ignore_redirects_actions)){
        header('Location: ' . "/?action=500&error=" . $e->getMessage());
    }
}
$navList .= "</ul>";


/*  Router */

#   POST ROUTES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($action) {
        case '':
            break;
        default:
            include 'app/view/errors/404.php';
    }
}

#   GET ROUTES
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    switch ($action) {
        case NULL:
            include 'app/view/home.php';
            break;
        case 'template':
            include 'app/view/template.php';
            break;
        case '500':
            include 'app/view/errors/500.php';
            break;
        default:
            include 'app/view/errors/404.php';
    }
}

?>