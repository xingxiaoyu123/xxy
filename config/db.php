<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=mydatabase',
    'username' => 'root',
    'password' => 'luliyuan12',
    'charset' => 'utf8',
    // 'masters' =>[
    	// ['dsn' => 'mysql:host=10.0.3.203;dbname=learn'],
    // ],
    // 'masterConfig' => [
    // 	'username' => 'root',
    //     'password' => '912913',
    //     'attributes' => [
    //    		// use a smaller connection timeout
    //     	PDO::ATTR_TIMEOUT => 10,
    //     ],
    // ],
    // 'slaveConfig' => [
    // 	'username' => 'root',
    //     'password' => 'root',
    //     'attributes' => [
    //    		// use a smaller connection timeout
    //     	PDO::ATTR_TIMEOUT => 10,
    //     ],
    // ],
    // 'slaves' => [
    // 	['dsn' => 'mysql:host=localhost;dbname=mydatabase'],
    // 	['dsn' => 'mysql:host=localhost;dbname=mydatabases2'],
    // ],
];
