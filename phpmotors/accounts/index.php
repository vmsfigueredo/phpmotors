<?php

#   Accounts Controller

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/library/Connection.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/app/model/main-model.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/app/helpers/helpers.php");


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
        case 'login':
            $input = [
                "clientEmail" => filter_input(INPUT_POST, "clientEmail"),
                "clientPassword" => filter_input(INPUT_POST, "clientPassword"),
            ];
            $validations = [
                "clientEmailValidation" => validate("email", $input['clientEmail']),
                "clientPasswordValidation" => validate("password", $input['clientEmail']),
            ];
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(array_merge($input, $validations));
            break;
        case 'register':
            $input = [
                "clientFirstname" => filter_input(INPUT_POST, 'clientFirstname'),
                "clientLastname" => filter_input(INPUT_POST, 'clientLastname'),
                "clientEmail" => filter_input(INPUT_POST, "clientEmail"),
                "clientPassword" => filter_input(INPUT_POST, "clientPassword"),
                "passwordConfirm" => filter_input(INPUT_POST, "passwordConfirm")
            ];
            $validations = [
                "clientFirstnameValidation" => validate(['minSize' => 3, 'maxSize' => 30], $input['clientFirstname']),
                "clientLastnameValidation" => validate(['minSize' => 1, 'maxSize' => 30], $input['clientFirstname']),
                "clientEmailValidation" => validate('email', $input['clientEmail']),
                "clientPasswordValidation" => validate('password', $input['clientPassword']),
                "passwordConfirmValidation" => validate(['match' => $input['clientPassword']], $input['passwordConfirm'])
            ];
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(array_merge($input, $validations));
            break;
        default:
            include($_SERVER['DOCUMENT_ROOT'] . "/app/view/errors/404.php");
            break;
    }
}

#   GET ROUTES
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    switch ($action) {
        case 'login':
            include($_SERVER['DOCUMENT_ROOT'] . "/app/view/accounts/login.php");
            break;
        case 'register':
            include($_SERVER['DOCUMENT_ROOT'] . "/app/view/accounts/register.php");
            break;
        default:
            include($_SERVER['DOCUMENT_ROOT'] . "/app/view/errors/404.php");
            break;
    }
}


?>