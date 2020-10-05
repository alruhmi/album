<?php
/**
 * Created by PhpStorm.
 * User: fahmi
 * Date: 04.10.2020
 * Time: 13:25
 */

return [
    'database' => [
        'name' => 'album',
        'username' => 'root',
        'password' => 'root',
        'connection' => 'mysql:host=percona',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
