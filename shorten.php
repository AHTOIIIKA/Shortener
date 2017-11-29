<?php

use Shortener\Service\Service;
use Shortener\Driver\Driver;
use Shortener\Storage\MysqlStorage;
use Shortener\Storage\Mysql;
use Shortener\Algorithm\Sha1Algorithm;

require 'vendor/autoload.php';

$url = $argv[1] ?? null;

if ($url === null) {
    throw new \Exception('Url did not pass');
}

$mysql = new Mysql('mysql:host=localhost;dbname=shortener', 'root', '1');
$storage = new MysqlStorage($mysql, 'link');
$driver = new Driver(new Sha1Algorithm(), $storage, 'http://mydomain.com');
$service = new Service($driver);

echo $service->shorten($url) . PHP_EOL;
