<?php
    $users = json_decode(file_get_contents(__DIR__ . '/customer.json'), true);

    $page = (int) ($_GET['page'] ?? 1);

    $sort = $_GET['sort'] ?? '';

    if ($sort == 'surname_asc') {
        usort($users, fn($a, $b) => $a['surname'] <=> $b['surname']);
    }
    elseif ($sort == 'surname_desc') {
        usort($users, fn($a, $b) => $b['surname'] <=> $a['surname']);
    }
    elseif ($sort == 'id_asc') {
        usort($users, fn($a, $b) => $a['user_id'] <=> $b['user_id']);
    }
    elseif ($sort == 'id_desc') {
        usort($users, fn($a, $b) => $b['user_id'] <=> $a['user_id']);
    }
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
        
    <form action="" method="get">
        <fieldset>
            <legend>SORT:</legend>
            <select name="sort">
                <option value="surname_asc" <?php if ($sort == 'surname_asc') echo 'selected' ?>>Surname A-Z</option>
                <option value="surname_desc" <?php if ($sort == 'surname_desc') echo 'selected' ?>>Surname Z-A</option>
                <option value="id_asc" <?php if ($sort == 'id_asc') echo 'selected' ?>>ID 1-9</option>
                <option value="id_desc" <?php if ($sort == 'id_desc') echo 'selected' ?>>ID 9-1</option>
            </select>
            <button type="submit">Sort</button>
        </fieldset>
    </form>
    <ul>
    <?php foreach ($users as $user) : ?>
        <li>
  
            <b>Klientas:</b> <?= $user["user_id"] ?> <i><?= $user["name"] ?> <?= $user["surname"] ?> <?= $user["aKodas"] ?> <?= $user["saskaitos_nr"] ?> <?= $user["balance"] ?></i>
            <a href="http://localhost/bankai/u2/edit.php?id= <?= $user['user_id'] ?>"><button>Edit</button></a>
            <form action="http://localhost/bankai/u2/delete.php?id=<?= $user['user_id'] ?>" method="post">
                <button type="submit">Delete</button>
            </form>
        </li>
    <?php endforeach ?>
    </ul>
</body>
</html>