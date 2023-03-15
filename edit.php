<?php
// POST Scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $id = (int)$_GET['id'];

    $users = json_decode(file_get_contents(__DIR__ . '/customer.json'), 1);

    // patikrinam ar  ID yra validus
    $valid_id = false;
    foreach ($users as $user) {
        if ($user['user_id'] == $id) {
            $valid_id = true;
            break;
        }
    }

    if (!$valid_id) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'ID is invalid'];
        header('Location: http://localhost/bankai/u2/edit.php?id=' . $id);
        die;
    }

    // atnaujinti userio info varda/pavarde/balansa
    foreach ($users as &$user) {
        if ($user['user_id'] == $id) {
            $user['name'] = $_POST['name'];
            $user['surname'] = $_POST['surname'];

            // prideti pinigu
            $add_money = (float)$_POST['add_money'];
            if ($add_money > 0) {
                $user['balance'] += $add_money;
                $_SESSION['msg'] = ['type' => 'ok', 'text' => 'Money added'];
            }

            // atimti pinigu
            $take_off_money = (float)$_POST['take_off_money'];
            if ($take_off_money > 0 && $take_off_money <= $user['balance']) {
                $user['balance'] -= $take_off_money;
                $_SESSION['msg'] = ['type' => 'ok', 'text' => 'Money was taken '];
            } elseif ($take_off_money > 0) {
                $_SESSION['msg'] = ['type' => 'error', 'text' => 'Not enough money'];
                header('Location: http://localhost/bankai/u2/edit.php?id=' . $id);
                die;
            }

            break;
        }
    }

    // issaugoti userio info JSON file
    $users = json_encode($users);
    file_put_contents(__DIR__ . '/customer.json', $users);

    // pranesimas
    $_SESSION['msg'] = ['type' => 'ok', 'text' => 'User was edited'];
    header('Location: http://localhost/bankai/u2/users.php');
    die;
}

// GET Scenarijus

$users = json_decode(file_get_contents(__DIR__ . '/customer.json'), 1);

$id = (int)$_GET['id'];

$find = false;
foreach ($users as $user) {
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
            <input type="text" name="aKodas" value="<?= $user['aKodas'] ?>" readonly>
            <label>Sąskaitos Nr.:</label>
            <input type="text" name="saskaitos_nr" value="<?= $user['saskaitos_nr'] ?>" readonly>
            <label>Balance:</label>
            <input type="text" value="<?= $user['balance'] ?>" name="balance" readonly>
            <label>Add money:</label>
            <input type="text" name="add_money" value="0.00">
            <label>Take off money:</label>
            <input type="text" name="take_off_money" value="0.00">

            <button type="submit">Edit</button>
        </fieldset> 
    </form> 
</body>
</html>