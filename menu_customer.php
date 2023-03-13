<?php
    $users_ = json_decode(file_get_contents(__DIR__ . '/id.json'));
    // $all = ceil(count($users_) / 10);
?>
   <?php /* foreach(range(1, $all) as $page) : */ ?>
<!-- puslapio nuoroda PABAIGA 03:58 -->
    <?php /* endforeach */ ?>


<a href="http://localhost/bankai/u2/create.php">Create New Account</a>
<a href="http://localhost/bankai/u2/users.php?page=1&sort=asc">Account List</a>