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
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #eee;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        button {
            padding: 6px 10px;
            border: none;
            background-color: #008CBA;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #00698C;
        }
    </style>
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
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Personal code</th>
            <th>Account number</th>
            <th>Balance</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($users as $user) : ?>
        <tr>
            <td><?= $user["user_id"] ?></td>
            <td><?= $user["name"] ?></td>
            <td><?= $user["surname"] ?></td>
            <td><?= $user["aKodas"] ?></td>
            <td><?= $user["saskaitos_nr"] ?></td>
            <td><?= $user["balance"] ?></td>
            <td><a href="http://localhost/bankai/u2/edit.php?id=<?= $user['user_id'] ?>"><button>Edit</button></a></td>
            <td><form action="http://localhost/bankai/u2/delete.php?id=<?= $user['user_id'] ?>" method="post">
                <button type="submit">Delete</button>
            </form></td>
        </tr>
        <?php endforeach ?>
    </table>
</body>
</html>