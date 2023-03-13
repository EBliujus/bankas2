<?php

    if($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_GET['id'])) {
        http_response_code(400);
        die;
    }

    $id = (int) $_GET['id'];

    $users_ = json_decode(file_get_contents(__DIR__ . '/id.json'));

    $users = array_filter($users, fn($users) => $users['user_id'] != $id);

    $users= json_encode($users);
    file_put_contents(__DIR__ . '/id.json', $users);

    header('Location: http://localhost/bankai/u2/users.php');



