<?php

use App\Controllers\UserController;

require "bootstrap.php";

$user = new UserController();

$path = $_SERVER['PATH_INFO'] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

if(is_null($path)) {
    echo "PHP API CRUD";
} else {
    if($path == "/users" && $method == "GET") {
        $user->index();
        return;
    }
    if (preg_match("/\/users\/(\d+)/", $path)) {
        $id = explode("/", $path);
        $user->find(array_pop($id));
        return;
    }
    if($path == "/users/create" && $method == "POST") {
        $user->store($_POST);
        return;
    }
    if($path == "/users/update" && $method == "PUT") {
//        $user->update($_POST);
//        return;
    }
}

