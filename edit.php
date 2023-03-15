<?php
// POST'o Scenarijus
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

$id = (int)$_GET['id'];

$users = json_decode(file_get_contents(__DIR__ . '/customer.json'));

// tikrinam
foreach($users as $user) {
    if ($user['user_id'] == $id) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'ID is invalid'];
        header('Location: http://localhost/bankai/u2/edit.php?id=' . $id);
    die;
    }
}

foreach($users as $user) {
    if ($user['user_id'] == $id) {
       
        $user['name'] = $_POST['name'];
        $user['surname'] = $_POST['surname'];

        $users = json_encode($users);
        file_put_contents(__DIR__ . '/customer.json', $users);

        break;
    }
}
    $_SESSION['msg'] = ['type' => 'ok', 'text' => 'User was edited'];
    header('Location: http://localhost/bankai/u2/users.php');
    die;
}
// GET Scenarijus

$users = json_decode(file_get_contents(__DIR__ . '/customer.json'), 1);

$id = (int)$_GET['id'];

$find = false;
foreach($users as $user) {
    if ($user['user_id'] == $id) {
        $find = true;
        break;
    }
}

if (!$find) {
    die('User not found');
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/">
    <title>Edit</title>
</head>
<body>
    <?php require __DIR__ . '/menu.php' ?>


    <form action="?id= <?= $user['user_id'] ?>" method="post">
        <fieldset>
            <legend> Edit:</legend>
            <label>Name:</label>
            <input type="text" name="name" value= "<?= $user['name'] ?>">
            <label> Surname: </label>
            <input type="text" name="surname" value="<?= $user['surname'] ?>">
            <label>aKodas</label>
            <input type="text" name="aKodas">
            <label>Sąskaitos Nr.:</label>
            <input type="text" name="saskaitos_nr">
            <input  value="0.00" name="likutis">

            <button type="submit">Edit</button>
        </fieldset> 
    </form> 
</body>
</html>