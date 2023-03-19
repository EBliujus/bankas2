<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_GET['id'])) {
    http_response_code(400);
    die;
}

session_start();
$id = (int) $_GET['id'];

$users_ = json_decode(file_get_contents(__DIR__ . '/customer.json'), 1);

$users = array_filter($users_, fn($user) => $user['user_id'] != $id);

// Check if user has zero account balance before deleting
$user_delete = array_filter($users_, fn($user) => $user['user_id'] == $id);
if ($user_delete[0]['balance'] != 0) {
    $_SESSION['msg'] = ['type' => 'error', 'text' => 'Saskaitoje yra pinigu ISTRINTI negalima'];
    header('Location: http://localhost/bankai/u2/users.php');
    exit();
}

$users= json_encode($users);
file_put_contents(__DIR__ . '/customer.json', $users);

$_SESSION['msg'] = ['type' => 'ok', 'text' => 'User was deleted'];
header('Location: http://localhost/bankai/u2/users.php');
exit();


