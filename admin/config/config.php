<?php

if ($_SERVER['HTTP_HOST'] == 'localhost'){
    define("BASE_URL", "http://localhost/lms/admin/");
    define("DIR_URL", $_SERVER['DOCUMENT_ROOT'] . "/lms/admin/");

    define("SERVER_NAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "smartlib");
}

else{
    define("BASE_URL", "http://lms.com");
    define("DIR_URL", $_SERVER['DOCUMENT_ROOT']);

   }