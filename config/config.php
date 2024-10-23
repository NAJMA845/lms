<?php
session_start();
if ($_SERVER['HTTP_HOST'] == 'localhost'){
    define("BASE_URL", "/lms/");
	define("ADMIN_BASE_URL", "/lms/admin/");
    define("DIR_URL", $_SERVER['DOCUMENT_ROOT'] . "/lms/admin/");

    define("SERVER_NAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "MEx1233roses._");
    define("DATABASE", "smartlib");
}

else{
    define("BASE_URL", "http://lms.com");
    define("DIR_URL", $_SERVER['DOCUMENT_ROOT']);

   }