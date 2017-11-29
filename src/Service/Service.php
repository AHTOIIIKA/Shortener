<?php

namespace Shortener\Service;

use Shortener\Driver\DriverInterface;

class Service implements ServiceInterface
{
    private $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function shorten(string $url): string
    {
        return $this->driver->shorten($url);
    }

    public function expand(string $url): string
    {
        return $this->driver->expand($url);
    }
}