<?php

namespace Shortener\Storage;

use Shortener\Link\LinkInterface;

interface StorageInterface
{
    public function store(string $id, string $longUrl, string $host): LinkInterface;
    public function existsWithId(string $id): bool;
    public function existsWithShortUrl(string $url): bool;
    public function getByShortUrl(string $url): LinkInterface;
}