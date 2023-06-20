<?php

/**
 * PHPMaker 2021 configuration file (Development)
 */

return [
    "Databases" => [
        "DB" => ["id" => "DB", "type" => "MYSQL", "qs" => "`", "qe" => "`", "host" => "directaccess.bangsawansetia.site", "port" => "3306", "user" => "kitasehatdbuser", "password" => "kitasehatdbuserpassword", "dbname" => "kitasehatdb"]
    ],
    "SMTP" => [
        "PHPMAILER_MAILER" => "smtp", // PHPMailer mailer
        "SERVER" => "localhost", // SMTP server
        "SERVER_PORT" => 25, // SMTP server port
        "SECURE_OPTION" => "",
        "SERVER_USERNAME" => "", // SMTP server user name
        "SERVER_PASSWORD" => "", // SMTP server password
    ],
    "JWT" => [
<<<<<<< HEAD
        "SECRET_KEY" => "dFBkH3iAoYlK3AsQ", // API Secret Key
=======
        "SECRET_KEY" => "aBLa3F6efyTCES7u", // API Secret Key
>>>>>>> parent of 72b00b1 (rumah sakit views refinements)
        "ALGORITHM" => "HS512", // API Algorithm
        "AUTH_HEADER" => "X-Authorization", // API Auth Header (Note: The "Authorization" header is removed by IIS, use "X-Authorization" instead.)
        "NOT_BEFORE_TIME" => 0, // API access time before login
        "EXPIRE_TIME" => 600 // API expire time
    ]
];
