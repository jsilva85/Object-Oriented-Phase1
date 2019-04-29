
<?php

require_once(dirname(__DIR__, 1) . "/Classes/Author.php");
require_once(dirname(__DIR__, 1) . "/vendor/autoload.php");

use jsilva85\ObjectOrientedphase1\Author;

$authorId = new Author("c486424b-e4b2-4655-8237-8b2ffc5803d3", "http://books.com", "75192419cebe42f7a38b22cee81638f0", "jdub@cnm.edu", '$argon2i$v=19$m=1024,t=384,p=2$T1B6Ymdqa3FJdmZqaDdqYg$hhyC1jf2WjbgfD8Jp6GZE9Tg3IpsYpXKm2VWYOJq8LA', "username;");

var_dump($authorId);








