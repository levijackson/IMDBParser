<?php

namespace IMDBParser\Models;

use SplFileObject;

class GenreParser extends Parser {

    protected $StartText = '8: THE GENRES LIST';
    protected $MatchRegExp = '^([^(]*)\(([\d{4}]*)\)\s*(\w*)';

    protected function parseMatch($match = array()) {
        return array('title' => $match[1], 'year' => $match[2], 'genre' => $match[3]);
    }

}