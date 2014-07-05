<?php
namespace IMDBParser\Tests\Models;

use PHPUnit_Framework_TestCase,
    IMDBParser\Models\CountryParser,
    SplFileObject;

class CountryParserTest extends PHPUnit_Framework_TestCase {

    public function testParse() {
        $file = new SplFileObject('./files/countries.list');
        $parser = new CountryParser($file);

        $this->assertEmpty($parser->getMatches());
        $parser->parseFile();
        $matches = $parser->getMatches();
        $this->assertEquals(38, count($matches));
        $this->assertEquals(3, count($matches[0]));
    }

}