<?php
namespace IMDBParser\Tests\Models;

use PHPUnit_Framework_TestCase,
    IMDBParser\Models\GenreParser,
    SplFileObject;

class GenreParserTest extends PHPUnit_Framework_TestCase {

    public function testParse() {
        $file = new SplFileObject('./files/genres.list');
        $parser = new GenreParser($file);

        $this->assertEmpty($parser->getMatches());
        $parser->parseFile();
        $matches = $parser->getMatches();
        $this->assertEquals(80, count($matches));
        $this->assertEquals(3, count($matches[0]));
    }

}