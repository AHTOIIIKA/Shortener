<?php

namespace Shortener\Link;

interface LinkInterface
{
    public function getId(): string;
    public function getLongUrl(): string;
    public function getShortUrl(): string;
    public function getHost(): string;
}
