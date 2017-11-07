<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','windows@123');
define('DB_NAME','guestbook');
define('DB_TABLE_NAME','guestbook');
define('ADMIN_TABLE_NAME','user');
define('PER_PAGE_GB',5);

$debug=true;
if($debug){
    ini_set('display_errors',1);
    error_reporting(E_ALL);
}