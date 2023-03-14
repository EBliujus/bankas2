<style> 
    h3, form {
        display: inline-block;
        margin-left: 20px
    }
    button {
        background: transparent;
        border: none;
        outline: none;
        cursor: pointer;
        color: red;
    }
</style>

<?php
// defined( 'ENTER' ) || die('You shall NOT pass');
session_start();
?>
<?php
/*     $users_ = json_decode(file_get_contents(__DIR__ . '/customer.json'));
    $all = ceil(count($users_) / 10); */
?>
   <?php /* foreach(range(1, $all) as $page) : */  ?>
<!-- puslapio nuoroda PABAIGA 03:58 -->
    <?php  /* endforeach  */ ?>
    <h2 
        style="color:darkcyan;
        display: flex; 
         align-items:center; 
        justify-content:center;"
        >Menu
    </h2>
<a href="http://localhost/bankai/u2/">HOME</a>
<a href="http://localhost/bankai/u2/index.php">Work Place</a>
<a href="http://localhost/bankai/u2/create.php">Create New Account</a>
<a href="http://localhost/bankai/u2/users.php?page=1&sort=asc">Account List</a>

<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) : ?>
    <h3><?= $_SESSION['name']?></h3>
<form action="http://localhost/bankai/u2/login/?logout" method="post">
    <button type="submit">Log Out</button>
</form>
<?php else : ?>
<a href="http://localhost/bankai/u2/login">Login</a>
<?php endif ?>



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