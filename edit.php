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
    <title>Edit User</title>
    <style>
    .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  .heading {
    display: flex;
    align-items:center;
    justify-content:center;
  }
  
  .label {
    display: block;
    margin-bottom: 5px;
  }
  
  .input {
    display: block;
    width: 100%;
    margin-bottom: 10px;
    padding: 5px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
  
  .button {
    display: block;
    margin-top: 10px;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    background-color: #007bff;
    border-radius: 5px;
    border: none;
    cursor: pointer;
  }
  
  .button:hover {
    background-color: #0069d9;
  }
  </style>
</head>
<body>
    <?php require __DIR__ . '/menu.php' ?>

    <div class="container">
        <h1 class="heading">Edit User</h1>
        <form action="?id= <?= $user['user_id'] ?>" method="post">
            <fieldset>
                <label class="label">Name:</label>
                <input class="input" type="text" name="name" value= "<?= $user['name'] ?>">
                <label class="label">Surname:</label>
                <input class="input" type="text" name="surname" value="<?= $user['surname'] ?>">
                <label class="label">Personal Code:</label>
                <input class="input" type="text" name="aKodas" value="<?= $user['aKodas'] ?>" readonly>
                <label class="label">Account Number:</label>
                <input class="input" type="text" name="saskaitos_nr" value="<?= $user['saskaitos_nr'] ?>" readonly>
                <label class="label">Current Balance:</label>
                <input class="input" type="text" value="<?= $user['balance'] ?>" name="balance" readonly>
                <label class="label">Add Money:</label>
                <input class="input" type="text" name="add_money" value="0.00">
                <label class="label">Take Off Money:</label>
                <input class="input" type="text" name="take_off_money" value="0.00">
                <button class="button" type="submit">Edit User</button>
            </fieldset> 
        </form> 
    </div>
</body>
</html>