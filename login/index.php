<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
session_start();

    $users = json_decode(file_get_contents(__DIR__ .'/../db/users.json'), 1);

    foreach($users as $user) {
        if ($user['name'] == $_POST['name'] && $user['password'] == md5($_POST['password'])) {
            $_SESSION['logged'] = 1;
            $_SESSION['name'] = $user['name'];
            header('Location: http://localhost/uzduotys/u2/u2_bankas/Employees/');
            die;
        }
    }
    $_SESSION['msg'] = ['type' => 'error', 'text' => 'Login failed'];
    header('Location: http://localhost/uzduotys/u2/u2_bankas/login/');
    die;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>U2_Bankas Log In</title>
</head>
<body>
<?php 
    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);
        $color = match($msg['type']) {
            'error' => 'crimson',
            'ok' => 'green',
            default => 'grey'
        };
    }
?>

<?php if(isset($msg)) : ?>
<h2 style="color: <?= $color ?>">
    <?= $msg['text'] ?>
</h2>
<?php endif?>
    <h1>LOGIN</h1>
    <form action="" method="post">
        <div>
            <label>Name:</label>
            <input type="text" name="name">
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>