<?php
namespace IMDBParser\Tests\Models;

use PHPUnit_Framework_TestCase,
    IMDBParser\Models\MovieParser,
    SplFileObject;

class MovieParserTest extends PHPUnit_Framework_TestCase {

    public function testParse() {
        $file = new SplFileObject('./files/movies.list');
        $parser = new MovieParser($file);

        $this->assertEmpty($parser->getMatches());
        $parser->parseFile();
        $matches = $parser->getMatches();
        $this->assertEquals(106, count($matches));
        $this->assertEquals(5, count($matches[0]));
    }

}