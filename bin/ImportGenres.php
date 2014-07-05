<?php  

use IMDBParser\Models\GenreParser,
    IMDBParser\Models\Genre,
    IMDBParser\Models\Movie;

chdir(dirname(__FILE__) . '/../');

include_once('bootstrap.php');

$logger->write('Begin genres import.');
$file = new SplFileObject('./files/genres.list');
$parser = new GenreParser($file);
$parser->parse();
$matches = $parser->getMatches();

$logger->write(count($matches) . ' genres to import.');
foreach ($matches as $match) {
    if (empty($match['genre'])) {
        continue;
    }

    $movieAttributes = $match;
    unset($movieAttributes['genre']);

    $genre = Genre::firstByAttributes(array('name' => $match['genre']));
    if (!$genre) {
        $genre = new Genre(array('name' => $match['genre']));
        $genre->save();
    }

    $movies = Movie::allByAttributes($movieAttributes);
    if ($movies) {
        foreach ($movies as $movie) {
            if (!$movie->hasGenre($match['genre'])) {
                $movie->genres()->save($genre);
            }
        }
    }
}
$logger->write('End genres import.');