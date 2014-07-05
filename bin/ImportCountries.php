<?php  

use IMDBParser\Models\CountryParser,
    IMDBParser\Models\Movie;

chdir(dirname(__FILE__) . '/../');

include_once('bootstrap.php');

$logger->write('Begin countries import.');
$file = new SplFileObject('./files/countries.list');
$parser = new CountryParser($file);
$parser->parse();
$matches = $parser->getMatches();

$logger->write(count($matches) . ' countries to import.');

foreach ($matches as $match) {
    $movieAttributes = $match;
    unset($movieAttributes['country']);

    $movies = Movie::allByAttributes($movieAttributes);
    if ($movies) {
        foreach ($movies as $movie) {
            $movie->country = $match['country'];
            $movie->save();
        }
    }
}
$logger->write('End countries import.');