<?php

namespace IMDBParser\Models;

class AutoLoader {
    public function load ($class, $require = true) {
        $path = str_replace('\\', '/', $class);

        $parts = explode('/', ltrim($path, '/'));
        // remove IMDBParser namespace
        array_shift($parts);
        $fileName = './' . implode('/', $parts) . '.php';
        if (file_exists($fileName)) {
            require_once($fileName);
        }
    }
}