<?php

// $f = file_get_contents("portfolio.json");

// $json = json_decode($f);

// $photo = new Photo("photo3","new photo");

// array_push($json,$photo);
// file_put_contents("portfolio.json", json_encode($json));

require 'change.php';

$c = new changeJSON("portfolio.json");

$c->addPhoto("helloworld","new caption");


?>