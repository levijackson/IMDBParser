<?php

namespace IMDBParser\Models;

use InvalidArgumentException;

class Logger {

    protected $resource;

    public function __construct($resource) {
        if (!is_resource($resource)) {
            throw new InvalidArgumentException('Invalid resource handle.');
        }
        $this->resource = $resource;
    }

    public function write($message = '') {
        return fwrite($this->resource, (string) $message . PHP_EOL);
    }
}