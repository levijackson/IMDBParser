<?php  
namespace IMDBParser\Models;

class FileFetcher {
    protected $SourceBasePath = 'ftp://ftp.fu-berlin.de/pub/misc/movies/database/';
    protected $SourceFile;
    protected $DestFile;

    public function __construct($sourceFile, $destFile) {
        if (empty($sourceFile) or empty($destFile)) {
            return false;
        }

        $this->SourceFile = $sourceFile;
        $this->DestFile = $destFile;
    }

    public function fetch() {
        $sourceFH = gzopen($this->SourceBasePath . $this->SourceFile, 'rb');
        $destFH = fopen($this->DestFile, 'w+');

        if (!$sourceFH or !$destFH) {
            return false;
        }

        while (!gzeof($sourceFH)) {
            $string = gzread($sourceFH, 4096);
            fwrite($destFH, $string, strlen($string));
        }
        gzclose($sourceFH);
        fclose($destFH);
    }

    public function setSourceBasePath($path = '') {
        $this->SourceBasePath = $path;
    }
}