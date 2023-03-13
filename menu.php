<?php
    session_start();
// defined( 'ENTER' ) || die('You shall NOT pass');
?>
<?php
    // $users_ = json_decode(file_get_contents(__DIR__ . '/id.json'));
    // $all = ceil(count($users_) / 10);
?>
   <?php /* foreach(range(1, $all) as $page) : */ ?>
<!-- puslapio nuoroda PABAIGA 03:58 -->
    <?php /* endforeach */ ?>
    <h2 
        style="color:darkcyan;
        display: flex; 
         align-items:center; 
        justify-content:center;"
        >Menu
    </h2>
<a href="http://localhost/bankai/u2/">HOME</a>
<a href="http://localhost/bankai/u2/Employees">Work Place</a>
<a href="http://localhost/bankai/u2/login">Login</a>
<a href="http://localhost/bankai/u2/create.php">Create New Account</a>
<a href="http://localhost/bankai/u2/users.php?page=1&sort=<?= $sort ?>">Account List</a>

<?php
    if(isset($_SESSION['msg'])) {
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
<?php endif ?>