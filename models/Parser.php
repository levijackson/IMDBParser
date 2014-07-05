<?php

namespace IMDBParser\Models;

use SplFileObject,
    ArrayIterator;

abstract class Parser {
    protected $File;
    // the text that precedes the list of items. Often times the heading of the text file will contain examples that should not be parsed.
    protected $StartText;
    protected $MatchRegExp;

    public function __construct(SplFileObject $file) {
        $this->File = $file;
    }

    public function setFile(SplFileObject $file) {
        $this->File = $file;
    }

    public function setStartText($text = '') {
        $this->StartText = $text;
    }

    public function setMatchRegExp($regExp = '') {
        $this->MatchRegExp = $regExp;
    }

    public function getFile() {
        return $this->File;
    }

    public function getStartText() {
        return $this->StartText;
    }

    public function getMatchRegExp() {
        return $this->MatchRegExp;
    }

    public function parse() {
        $parse = false;
        foreach ($this->File as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            if ($parse === true) {
                $line = utf8_encode($line);
                $match = array();
                // i - case insensitive, u-matches utf-8 characters
                preg_match('/' . $this->MatchRegExp . '/iu', $line, $match);
                if (!empty($match[0]) and !empty($match[1])) {
                    // $this->parseMatch($match);
                    yield $this->parseMatch($match);
                }
            }

            if (strpos($line, $this->StartText) !== false) {
                $parse = true;
            }
        }
    }

    abstract protected function parseMatch($match = array());
}