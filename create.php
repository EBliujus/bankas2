<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $users = json_decode(file_get_contents(__DIR__ . '/customer.json'), 1);

    // tikrinam
    foreach ($users as $user) {
        if ($user['user_id'] == $id) {
            $_SESSION['msg'] = ['type' => 'error', 'text' => 'ID is invalid'];
            header('Location: http://localhost/bankai/u2/create.php');
        die;
    }
}
    // tikrinam vardus ir pavardes ar nera trumpesni nei trys raides
        if (strlen($_POST['name']) < 3 || strlen($_POST['surname']) < 3) {
            $_SESSION['msg'] = ['type' => 'error', 'text' => 'Vardas ir pavarde negali buti trumpesni nei 3 raides!'];
            header('Location: http://localhost/bankai/u2/create.php');
        die;
}

    $id = json_decode(file_get_contents(__DIR__ . '/id.json'));
    $id++;
    file_put_contents(__DIR__ . '/id.json', json_encode($id));

    $user = [
        'user_id' => $id,
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'aKodas' => $_POST['aKodas'],
        'saskaitos_nr' => $_POST['saskaitos_nr'],
        'balance' => $_POST['balance'],
    ];

    $users = json_decode(file_get_contents(__DIR__ . '/customer.json'));

    $users [] = $user;

    $users = json_encode($users);
    file_put_contents(__DIR__ . '/customer.json', $users);

    $_SESSION['msg'] = ['type' => 'ok', 'text' => 'User was created'];
    header('Location: http://localhost/bankai/u2/users.php');
    die;
}
?>
<!-- sukuriam asmenks koda -->
<?php
$I_sk = rand(1,6);
$metu_sk = substr(rand(1923, 2023), -2);
$menuo_sk = str_pad(rand(1, 12), 2, 0, STR_PAD_LEFT);
$diena_sk = str_pad(rand(1, 31), 2, 0, STR_PAD_LEFT);
$rand_sk = str_pad(rand(1, 999), 3, 0, STR_PAD_LEFT);
$rand_sk2 = rand(1, 9);

$ak = "{$I_sk}{$metu_sk}{$menuo_sk}{$diena_sk}{$rand_sk}{$rand_sk2}";
?>
<!-- sukuriam saskaitos nr -->
<?php
$salis = 'LT';
$kontroliniai_sk = rand(10, 99);
$banko_kodas = 10100;
$sask_nr = rand(10000000000, 99999999999);

$saskaita = "{$salis}{$kontroliniai_sk}{$banko_kodas}{$sask_nr}";
?>
<!--  -->


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
            <input type="text" name="name" required>
            <label>Surname:</label>
            <input type="text" name="surname" required>
            <label>aKodas:</label>
            <input type="text" name="aKodas" value="<?php echo $ak ?>" readonly>
            <label>Sąskaitos Nr.:</label>
            <input type="text" name="saskaitos_nr" value="<?php echo $saskaita ?>" readonly>
            <label>Balance:</label>
            <input type="text" value="0.00" name="balance" readonly>
            <button type="submit">Add new Client</button>
        </fieldset> 
    </form> 
</body>
</html>