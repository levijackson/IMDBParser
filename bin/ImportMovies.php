<?php  

use IMDBParser\Models\MovieParser,
    IMDBParser\Models\Movie,
    IMDBParser\Models\FileFetcher;

ini_set('memory_limit','500M');

chdir(dirname(__FILE__) . '/../');

include_once('bootstrap.php');

$fileName = './files/movies.list';
$logger->write('Fetching ' . $fileName . '.');
$fileFetcher = new FileFetcher('./movies.list.gz', $fileName);
$fileFetcher->fetch();

$logger->write('Begin movies import.');
$file = new SplFileObject($fileName);
$parser = new MovieParser($file);
foreach ($parser->parse() as $movie) { 
    $existingMovie = Movie::firstByAttributes($movie);
    if (!$existingMovie) {
        $newMovie = new Movie($movie);
        $newMovie->save();
    }
}
$logger->write('End movies import.');