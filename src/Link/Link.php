<?php

namespace Shortener\Link;

class Link implements LinkInterface
{
    private $id;
    private $longUrl;
    private $host;

    public function __construct(string $id, string $longUrl, string $host)
    {
        $this->id = $id;
        $this->longUrl = $longUrl;
        $this->host = $host;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLongUrl(): string
    {
        return $this->longUrl;
    }

    public function getShortUrl(): string
    {
        return $this->getHost() . '/' . $this->getId();
    }

    public function getHost(): string
    {
        return $this->host;
    }
}
