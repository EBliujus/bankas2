<?php 

$users = [
    ['name' => 'one@one.lt', 'password' => md5('122333')],
    ['name' => 'two@one.lt', 'password' => md5('122333')],
    ['name' => 'three@one.lt', 'password' => md5('122333')]
];

file_put_contents (__DIR__ .'/users.json', json_encode($users));

echo 'All is GOOD';
