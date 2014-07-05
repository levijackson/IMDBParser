<?php

namespace IMDBParser\Models;

use SplFileObject;

class CountryParser extends Parser {

    protected $StartText = 'COUNTRIES LIST';
    protected $MatchRegExp = '^([^(]*)\(([\d{4}]*)\)\s*(\w*)';

    protected function parseMatch($match = array()) {
        return array('title' => $match[1], 'year' => $match[2], 'country' => $match[3]);
    }

}