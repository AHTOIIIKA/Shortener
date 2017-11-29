<?php

namespace Shortener\Algorithm;

class Sha1Algorithm implements AlgorithmInterface
{
    public function generate(string $url, int $length): string
    {
        $hash = sha1($url . uniqid());

        if ($length > strlen($hash)) {
            throw \Exception(sprintf('key can not be longer than %d characters', strlen($hash)));
        } 

        return substr($hash, 0, $length);
    }
}
