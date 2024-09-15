<?php

if ($_SERVER['HTTP_HOST'] == 'localhost'){
    define("BASE_URL", "http://localhost/lms/admin/");
    define("DIR_URL", $_SERVER['DOCUMENT_ROOT'] . "/lms/admin/");
}

else{
    define("BASE_URL", "http://localhost/lms/admin/");
    define("DIR_URL", $_SERVER['DOCUMENT_ROOT'] . "/lms/admin/");
}