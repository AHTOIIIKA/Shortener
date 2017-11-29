<?php

namespace Shortener\Driver;

use Shortener\Algorithm\AlgorithmInterface;
use Shortener\Storage\StorageInterface;

class Driver implements DriverInterface
{
    private $algorithm;
    private $storage;
    private $host;
    private $idLength;

    public function __construct(
        AlgorithmInterface $algorithm,
        StorageInterface $storage,
        string $host,
        int $idLength = 6
    ) {
        $this->storage = $storage;
        $this->algorithm = $algorithm;
        $this->host = $host;
        $this->idLength = $idLength;
    }

    public function shorten(string $url): string
    {
        do {
            $id = $this->algorithm->generate($url, $this->idLength);
        } while($this->storage->existsWithId($id));

        $link = $this->storage->store($id, $url, $this->host);

        return $link->getShortUrl();
    }

    public function expand(string $url): string
    {
        if (!$this->storage->existsWithShortUrl($url)) {
            throw new \Exception('Url does not exits');
        }

        $link = $this->storage->getByShortUrl($url);

        return $link->getLongUrl();
    }
}
