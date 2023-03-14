<?php define('ENTER', true) ?>
<?php if(isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
    header('Location: http://localhost/bankai/u2/login/');
    die;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.scss">
    <title>U2_Bank for Employees</title>
</head>
<body>
<?php require __DIR__ . '/../menu.php'?>
    <h1>Welcome to your Work Place</h1>
</body>
</html>