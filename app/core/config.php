<?php

//app info
const APP_NAME = 'NurtureLife';
const APP_DESC = 'Sustaining Life Through Empowering Motherhood';

//database config
if($_SERVER['SERVER_NAME'] == 'localhost'){
    //database config for local server
    define('DBHOST', 'localhost');
    define('DBNAME', 'NurtureLife_db');
    define('DBUSER', 'root');
    define('DBPASS', 'root');
    define('DBDRIVER', 'mysql');
    //root path e.g localhost/
    define('ROOT', 'http://localhost/mvc/public');
}else{
    //database config for live server
    define('DBHOST', 'localhost');
    define('DBNAME', 'NurtureLife_db');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', 'mysql');
    //root path e.g https://www.yourwebsite.com
    define('ROOT', 'https://');
}