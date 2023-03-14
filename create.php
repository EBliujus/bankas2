<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $users = json_decode(file_get_contents(__DIR__ . '/id.json'), 1);

    // tikrinam
    foreach($users as $user) {
        if ($user['user_id'] == $id) {
            $_SESSION['msg'] = ['type' => 'error', 'text' => 'ID is invalid'];
            header('Location: http://localhost/bankai/u2/create.php');
        die;
    }
}

    $id = json_decode(file_get_contents(__DIR__ . '/id.json'));
    $id++;
    file_put_contents(__DIR__ . '/id.json', json_encode($id));

    $user = [
        'user_id' => $id,
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'a/k' => $_POST['a/k'],
        'saskaitos_nr' => $_POST['saskaitos_nr']
    ];

    $users = json_decode(file_get_contents(__DIR__ . '/id.json'));

    $users [] = $user;

    $users = json_encode($users);
    file_put_contents(__DIR__ . '/id.json', $users);

    $_SESSION['msg'] = ['type' => 'ok', 'text' => 'User was created'];
    header('Location: http://localhost/bankai/u2/users.php');
    die;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/">
    <title>Create</title>
</head>
<body>
    <?php require __DIR__ . '/menu.php' ?>


    <form action="" method="post">
        <fieldset>
            <legend> Create New:</legend>
            <label>Name:</label>
            <input type="text" name="name">
            <label>Surname:</label>
            <input type="text" name="surname">
            <label>a/k:</label>
            <input type="text" name="a/k">
            <label>Sąskaitos Nr.:</label>
            <input type="text" name="saskaitos_nr">
            <input hidden value="0.00" name="likutis">


            <button type="submit">Create</button>
        </fieldset> 
    </form> 
</body>
</html>