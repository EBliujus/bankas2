<?php
    $users = json_decode(file_get_contents(__DIR__ . '/id.json'));

    $page = (int) ($_GET['page'] ?? 1);

    // $users = array_slice($users, ($page - 1) * 10, 10); skaldo userius po 10 puslapy.




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    <a href="http://localhost/bankai/u2/users.php?page=1&sort=asc">Page 1</a>
    <a href="http://localhost/bankai/u2/users.php?page=2">Page 2</a>
    <a href="http://localhost/bankai/u2/users.php?page=3">Page 3</a>
    <form action="" method="get">
        <fieldset>
            <legend>SORT:</legend>
            <select name="sort">
                <option value="surname_asc">Surname A-Z</option>
                <option value="surname_desc">Surname Z-A</option>
                <option value="id_asc">ID 1-9</option>
                <option value="id_desc">ID 9-1</option>
            </select>
            <button type="submit">Sort</button>
        </fieldset>
    </form>
    <ul>
    <?php foreach($users as $user) : ?>
        <li>
            <b>ID:</b> <?= $user['user_id'] ?> <i><?= $user['name'] ?> <?= $user['surname'] ?></i>
        
        </li>
    <?php endforeach ?>
    </ul>
</body>
</html>