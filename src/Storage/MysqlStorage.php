<?php

namespace Shortener\Storage;

use Shortener\Link\Link;
use Shortener\Link\LinkInterface;

class MysqlStorage implements StorageInterface
{
    private $mysql;
    private $table;

    public function __construct(Mysql $mysql, string $table)
    {
        $this->mysql = $mysql;
        $this->table = $table;
    }

    public function store(string $id, string $longUrl, string $host): LinkInterface
    {
        $link = new Link($id, $longUrl, $host);

        $data = [
            'id' => $link->getId(),
            'long_url' => $link->getLongUrl(),
            'short_url' => $link->getShortUrl(),
            'host' => $link->getHost(),
        ];
        
        $insertedRows = $this->mysql->insertOne($this->table, $data);

        if (!$insertedRows) {
            throw new \Exception('Faled to store link');
        }

        return $link;
    }

    public function existsWithId(string $id): bool
    {
        return $this->mysql->exists($this->table, ['id' => $id]);
    }

    public function existsWithShortUrl(string $url): bool
    {
        return $this->mysql->exists($this->table, ['short_url' => $url]);
    }

    public function getByShortUrl(string $url): LinkInterface
    {
        if (!$this->existsWithShortUrl($url)) {
            throw new \Exception(sprintf('Link with short url %s does not exists', $url));
        }

        $data = $this->mysql->selectOne($this->table, ['short_url' => $url]);

        return new Link($data['id'], $data['long_url'], $data['host']);
    }

}