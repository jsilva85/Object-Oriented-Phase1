
<?php
require_once(dirname(__DIR__) . "/vendor/autoload.php");
require_once(dirname(__DIR__) . "/classes/autoload.php");
use jsilva85\ObjectOrientedphase1;
$authorId = new Author("c486424b-e4b2-4655-8237-8b2ffc5803d3", 'books.com', '75192419-cebe-42f7-a38b-22cee81638f0', 'jdub@cnm.edu', '$argon2i$v=19$m=1024,t=384,p=2$T1B6Ymdqa3FJdmZqaDdqYg$hhyC1jf2WjbgfD8Jp6GZE9Tg3IpsYpXKm2VWYOJq8LA', 'username;');
var_dump($authorId);