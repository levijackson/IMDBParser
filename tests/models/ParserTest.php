<?php
namespace IMDBParser\Tests\Models;

// /Users/levijackson/Dropbox/htdocs/IMDBParser/vendor/bin/phpunit Tests/GenreParserTest.php 

use PHPUnit_Framework_TestCase,
    IMDBParser\Models\Parser,
    SplFileObject;

class StubParser extends Parser {
    protected function parseMatch($match = array()) {
        return $match;
    }
}

class ParserTest extends PHPUnit_Framework_TestCase {

    public function testAddFile() {
        $file = new SplFileObject('./files/genres.list');
        $parser = new StubParser($file);
        $parserFile = $parser->getFile();

        $this->assertTrue($parserFile->getFileName() == 'genres.list');
        $this->assertTrue($parserFile->isFile());
        $this->assertGreaterThan(0, $parserFile->getSize());

        return $parser;
    }

    /** 
    * @depends testAddFile 
    */
    public function testSetStart(StubParser $parser) {
        $this->assertNull($parser->getStartText());
        $parser->setStartText('8: THE GENRES LIST');
        $this->assertTrue($parser->getStartText() == '8: THE GENRES LIST');
    }

    /** 
    * @depends testAddFile 
    */
    public function testSetRegExp(StubParser $parser) {
        $this->assertNull($parser->getMatchRegExp());
        $parser->setMatchRegExp('^([^(]*)\(([\d{4}]*)\)\s*(\w*)');
        $this->assertTrue($parser->getMatchRegExp() == '^([^(]*)\(([\d{4}]*)\)\s*(\w*)');
    }

    /** 
    * @depends testAddFile 
    */
    public function testParse(StubParser $parser) {
        $this->assertEmpty($parser->getMatches());
        $parser->parseFile();
        $matches = $parser->getMatches();
        $this->assertEquals(80, count($matches));
        $this->assertEquals(4, count($matches[0]));
    }

}